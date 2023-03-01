<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
   
class coinpayments extends BaseController {

    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->isLoggedIn(); 
        $this->isVerified(); 

       if(!$_SESSION['DepositAmount'])
       {
            redirect('deposits/new');
        } else
        {
            $this->load->helper('string');
            $companyInfo = $this->settings_model->getsettingsInfo();
            //Check if there is a pending request in the database that has not expired
            //and is for the same amount.
            //Define the currencies and amount first
            
            $amount = $companyInfo['currency'] == 'USD' ? $_SESSION['DepositAmount'] : $_SESSION['DepositAmount']/$companyInfo['currency_exchange_rate'];
            $currency1 = 'USD';
            $currency2 = $_SESSION['method'];
            $email = $this->user_model->getUserInfo($this->vendorId)->email;
            $currentTime = date('Y-m-d H:i:s');
            $status = 0;

            /** Status codes for coinpayments transactions
             * 0 - Transaction has been initiated but not yet processed
             * 1 - Transaction has been processed succesfully
             * 2 - Transaction has not been processed and timeout has reached
             */

            $cpURL = $this->payments_model->getInfo('tbl_addons_api', 'CoinPayments')->base_url;

            $invoice = 'NJ'.random_string('alnum',8);
            //Create a transaction
            $array = array(
                'amount' => $amount,
                'currency1' => $currency1,
                'currency2' => $currency2,
                'invoice' => $invoice,
                'buyer_email' => $email,
                'ipn_url' => base_url().'ipncp/'.$cpURL
            );
            $res = $this->coinaddons_api_call('create_transaction', $array);

            //print_r($res);

            /**Sample response array
             * Array ( 
             * [error] => ok 
             * [result] => Array ( 
             *      [amount] => 0.00648335 
                    [txn_id] => CPDK4HIQGZXLJUTOXGPSHVZMNU 
                    [address] => 0xb7a9af55964c7154a636bd010be57b6d9ef37d68 
                    [confirms_needed] => 3 
                    [timeout] => 86400 
                    [checkout_url] => https://www.coinpayments.net/index.php?cmd=checkout&id=CPDK4HIQGZXLJUTOXGPSHVZMNU&key=c210a3e86268852e55f319a58f68485a 
                    [status_url] => https://www.coinpayments.net/index.php?cmd=status&id=CPDK4HIQGZXLJUTOXGPSHVZMNU&key=c210a3e86268852e55f319a58f68485a 
                    [qrcode_url] => https://www.coinpayments.net/qrgen.php?id=CPDK4HIQGZXLJUTOXGPSHVZMNU&key=c210a3e86268852e55f319a58f68485a 
                ) 
            )
            */

            $address = $res['result']['address'];
            $amount2 = $res['result']['amount'];
            $txnCode = $res['result']['txn_id'];
            $timeout = $res['result']['timeout'];

            //Save the transaction to DB
            $info = array(
                'invoice'=>$invoice,
                'txnCode'=>$txnCode, 
                'userid' => $this->vendorId,
                'plan'=> $_SESSION['planId'],
                'address'=> $address,
                'method'=> $currency2,
                'amount1'=> $amount, 
                'amount2'=> $amount2,
                'status'=> '0', 
                'expiry'=> date('Y-m-d H:i:s', strtotime("+$timeout seconds")), 
                'createdDtm'=>date('Y-m-d H:i:s')
            );
                
            $this->payments_model->addCoinPayment($info);
            
            //Pass the Data variables to view
            $data['QR'] = '<img src="'.base_url().'tes.png" />';
            $data['address'] = $address;
            $data['amount2'] = $amount2;
            $data['currency2'] = $currency2;
            $data['email'] = $email;
            $data['invoice'] = $invoice;

            $this->global['pageTitle'] = 'Coin Payment';
            $this->global['displayBreadcrumbs'] = true; 
            $this->global['breadcrumbs'] = lang('deposits').' <span class="breadcrumb-arrow-right"></span> '.'Crypto';
            $data['payment'] = $companyInfo['currency'] == 'USD' ? $amount : $amount * $companyInfo['currency_exchange_rate'];
            $this->loadViews("payments/coinpayments", $this->global, $data, NULL);
        }
    }

    function checkCoinPayments($invoice)
    {
        $this->isLoggedIn(); 

        $paymentInfo = $this->payments_model->getCoinPayment($invoice);
        if(!$paymentInfo)
        {
            $this->loadThis();
        }
        else
        {
            $status = $paymentInfo->status;
            if($status == '0')
            {
                $array = array(
                    'success' => false,
                    'msg' => html_escape(lang('pending_payment'))
                );

                $data = json_encode($array);

                $output="data: {$data}\n\n";
                $this->output->set_content_type('text/event-stream')->_display($output);
                $this->output->set_header('Cache-Control: no-cache');
                flush();
            }
            else if($status == '1')
            {
                $array = array(
                    'success' => true,
                    'msg' => html_escape(lang('your_payment_is_successful'))
                );

                $data = json_encode($array);

                $output="data: {$data}\n\n";
                $this->output->set_content_type('text/event-stream')->_display($output);
                $this->output->set_header('Cache-Control: no-cache');
                flush();
                sleep(1);
            }
        }
    }

    public function IPN_Response($url)
    {
        $this->load->helper('string');
        //Find out if this route is the correct one
        $cpURL = $this->payments_model->getInfo('tbl_addons_api', 'CoinPayments')->base_url;

        if($cpURL == $url) {
            $companyInfo = $this->settings_model->getsettingsInfo();
            // Fill these in with the information from your CoinPayments.net account.
            $cp_merchant_id = $this->payments_model->getInfo('tbl_addons_api', 'coinpayments')->merchantID;
            $cp_ipn_secret = $this->payments_model->getInfo('tbl_addons_api', 'coinpayments')->IPN_secret;
            $cp_debug_email = '';

            //Get invoice ID and query DB for the transaction
            $invoice = $_POST['invoice'];
            $paymentData = $this->payments_model->getCoinPayment($invoice);

            if($paymentData) {
                //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.
                $order_currency = 'USD';
                $order_total = $paymentData->amount1;
                $userId = $paymentData->userid;
                $method = $paymentData->method;
                $planId = $paymentData->plan;
                $coinTxnId = $paymentData->id;

                function errorAndDie($error_msg) {
                    global $cp_debug_email;
                    if (!empty($cp_debug_email)) {
                        $report = 'Error: '.$error_msg."\n\n";
                        $report .= "POST Data\n\n";
                        foreach ($_POST as $k => $v) {
                            $report .= "|$k| = |$v|\n";
                        }
                        mail($cp_debug_email, 'CoinPayments IPN Error', $report);
                    }
                    die('IPN Error: '.$error_msg);
                }

                if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
                    errorAndDie('IPN Mode is not HMAC');
                }

                if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
                    errorAndDie('No HMAC signature sent.');
                }

                $request = file_get_contents('php://input');
                if ($request === FALSE || empty($request)) {
                    errorAndDie('Error reading POST data');
                }
                
                if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
                    errorAndDie('No or incorrect Merchant ID passed');
                }

                $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
                if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
                //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
                    errorAndDie('HMAC signature does not match');
                }
                
                // HMAC Signature verified at this point, load some variables.

                $txn_id = $_POST['txn_id'];
                $item_name = $_POST['item_name'];
                $item_number = $_POST['item_number'];
                $amount1 = floatval($_POST['amount1']);
                $amount2 = floatval($_POST['amount2']);
                $currency1 = $_POST['currency1'];
                $currency2 = $_POST['currency2'];
                $status = intval($_POST['status']);
                $status_text = $_POST['status_text'];

                //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

                // Check the original currency to make sure the buyer didn't change it.
                if ($currency1 != $order_currency) {
                    errorAndDie('Original currency mismatch!');
                }    
                
                // Check amount against order total
                if ($amount1 < $order_total) {
                    errorAndDie('Amount is less than order total!');
                }
            
                if ($status >= 100 || $status == 2) {
                    // payment is complete or queued for nightly payout, success
                    //Check if the status != 1 if no stop there
                    if($paymentData->status != 1){
                        $date = date('Y-m-d H:i:s');
                        $localizedAmount = $companyInfo['currency'] == 'USD' ? $order_total : $order_total * $companyInfo['currency_exchange_rate'];
                        $maturityPeriod = $this->plans_model->getMaturity($planId)->period_hrs;
                        $payoutsInterval = $this->plans_model->getPeriod($planId)->period_hrs;

                        //change the status code for the transaction
                        $coinInfo = array(
                            'status'=>'1'
                        );

                        $coinPaymentEdit = $this->payments_model->editInfo('tbl_coinpayments', $coinInfo, $coinTxnId);
                        $plan = $this->plans_model->getPlanById($planId);

                        //Deposit Array
                        $depositInfo = array(
                            'userId'=>$userId, 
                            'txnCode'=>$invoice,
                            'amount'=>$localizedAmount, 
                            'paymentMethod'=> $method, 
                            'planId' => $planId,
                            'status' => $plan->principalReturn == 1 ? '0' : '3',
                            'maturityDtm'=> date('Y-m-d H:i:s', strtotime($date."+$maturityPeriod hours")),
                            'createdBy'=>$userId, 
                            'createdDtm'=>$date
                        );

                        $dAmount = $localizedAmount;
                        $profitPercent = $plan->profit/100;

                        $earningsAmount = $profitPercent*$dAmount;
                        $earningsType = 'interest';
                        $startDate = date('Y-m-d H:i:s', strtotime($date."+$payoutsInterval hours"));
                        $endDate = date('Y-m-d H:i:s', strtotime($date."+$maturityPeriod hours"));
                        $businessDays = $plan->businessDays;

                        //Add the deposit and earnings
                        $result = $this->transactions_model->addNewDeposit($userId, $depositInfo, $earningsAmount, $startDate, $endDate, $payoutsInterval, $maturityPeriod, $businessDays, $plan->principalReturn);

                        //Send email       
                        if($result)
                        {
                            //Process the referal credits
                            $this->referralEarnings($userId, $localizedAmount, $result);

                            //Send Mail
                            $conditionUserMail = array('tbl_email_templates.type'=>'Deposit');
                            $resultEmail = $this->email_model->getEmailSettings($conditionUserMail);

                            $companyInfo = $this->settings_model->getsettingsInfo();
                        
                            if($resultEmail->num_rows() > 0)
                            {
                                $userInfo = $this->user_model->getUserInfo($userId);

                                $rowUserMailContent = $resultEmail->row();
                                $splVars = array(
                                    "!plan" => $plan->name,
                                    "!interest" => $plan->profit.'%',
                                    "!period"=> $this->plans_model->getPeriod($planId)->maturity_desc,
                                    '!payout'=> to_currency($this->transactions_model->totalPayoutValue($result, $userId)),
                                    "!clientName" => $userInfo->firstName,
                                    "!depositAmount" => to_currency($localizedAmount),
                                    "!companyName" => $companyInfo['name'],
                                    "!address" => $companyInfo['address'],
                                    "!siteurl" => base_url()
                                );

                                $mailSubject = strtr($rowUserMailContent->mail_subject, $splVars);
                                $mailContent = strtr($rowUserMailContent->mail_body, $splVars); 
                                
                                $toEmail = $userInfo->email;
                                $fromEmail = $companyInfo['SMTPUser'];

                                $name = 'Support';

                                $header = "From: ". $name . " <" . $fromEmail . ">\r\n"; //optional headerfields

                                $this->sendEmail($toEmail,$mailSubject,$mailContent);

                                //Send SMS
                                $phone = $userInfo->mobile;
                                if($phone){
                                    $body = strtr($rowUserMailContent->sms_body, $splVars);

                                    $this->twilio_model->send_sms($phone, $body);
                                }
                            }
                        }
                    }
                    
                } else if ($status < 0) {
                    //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
                    if($paymentData->status != 5){
                        //change the status code for the transaction
                        $coinInfo = array(
                            'status'=>'5'
                        );
                    
                        $coinPaymentEdit = $this->payments_model->editInfo('tbl_coinpayments', $coinInfo, $coinTxnId);
                    }
                } else {
                    //payment is pending, you can optionally add a note to the order page
                }
                die('IPN OK');
            }
        } else {
            redirect('404_override');
        }
    }

    public function coinaddons_api_call($cmd, $req = array()) {
        // Fill these in from your API Keys page
        $public_key = $this->payments_model->getInfo('tbl_addons_api', 'coinpayments')->public_key;
        $private_key = $this->payments_model->getInfo('tbl_addons_api', 'coinpayments')->secret_key;
        
        // Set the API command and required fields
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml
        
        // Generate the query string
        $post_data = http_build_query($req, '', '&');
        
        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $private_key);
        
        // Create cURL handle and initialize (if needed)
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        
        // Execute the call and close cURL handle     
        $data = curl_exec($ch);                
        // Parse and return data if successful.
        if ($data !== FALSE) {
            if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
                // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
                $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
            } else {
                $dec = json_decode($data, TRUE);
            }
            if ($dec !== NULL && count($dec)) {
                return $dec;
            } else {
                // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
            }
        } else {
            return array('error' => 'cURL error: '.curl_error($ch));
        }
    }

    function getDatesFromRange($start, $end, $payoutsInterval, $format = 'Y-m-d H:i:s') {
        $array = array();
        $interval = 'PT'.$payoutsInterval.'H';
        $interval = new DateInterval($interval);
    
        $realEnd = new DateTime($end);
        //$realEnd->add($interval);
    
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    
        foreach($period as $date) { 
            $array[] = $date->format($format); 
        }
    
        return $array;
    }

    function referralEarnings($userID = NULL, $amount = NULL, $depositID = NULL)
    {
        //Run a check to confirm if referral earningsa has been activated
        $refactive = $this->settings_model->getSettingsInfo()['refactive'];

        if($refactive == 1){ //Earnings has been disabled
            return false;
        } else {
            //Check frequency of earnings
            /**
             * 1 - Only once
             * 0 - All deposits
             */
            $reffreq = $this->settings_model->getSettingsInfo()['reffrequency']; 
            if($reffreq == 1){
                //Run a check to confirm if the user has more than 1 deposit
                $numberofdeposits = $this->transactions_model->depositsListingCount(NULL, $userID);
                if($numberofdeposits > 1){
                    return false;
                } else {
                    if($userID == Null || $amount == Null || $depositID == Null)
                    {
                        return false;
                        //print_r('Either the user Id, amount or depositid is not available');
                    }
                    else 
                    {
                        //Get the referrer ID
                        $referrerID = $this->referrals_model->getReferrerID($userID);
        
                        //First Let's check whether this user has been referred by anyone
                        if($referrerID != null) {
                            //Check the referral method & interest
                            $refMethod = $this->settings_model->getSettingsInfo()['refType'];
                            $refInterest = $this->settings_model->getSettingsInfo(1)['refInterest'];
                            $deposit_only_payouts = $this->settings_model->getSettingsInfo(1)['disableRefPayouts'];
        
                            if($refMethod == 'simple')
                            {
                                $number_of_deposits = $this->transactions_model->depositsListingCount('', $referrerID);
        
                                //Calculate the referrer's earnings
                                $earnings = $amount * ($refInterest/100);
        
                                //for generating the txn code
                                $this->load->helper('string');
        
                                //Insert earnings into the earnings table
                                $array = array(
                                    'type' => 'referral',
                                    'userId'=> $referrerID,
                                    'depositId' => $depositID,
                                    'txnCode' => 'PO'.random_string('alnum',8),
                                    'amount' => $earnings,
                                    'createdDtm'=> date("Y-m-d H:i:s")
                                );
        
                                if($deposit_only_payouts == 1 && $number_of_deposits > 0) {
                                    $result = $this->transactions_model->addNewEarning($array);
                                } else if($deposit_only_payouts == 0) {
                                    $result = $this->transactions_model->addNewEarning($array);
                                } else {
                                    $result = 0;
                                }
        
                                if($result > 0)
                                {
                                    return true;
                                    //print_r('New simple earning added');
                                } else 
                                {
                                    return false;
                                    //print_r('New simple earning not added');
                                }
        
                            } else if($refMethod == 'multiple')
                            {
                                //Find the referral levels
                                $levels_array = explode(',', $refInterest);
                                $levelsCount = count($levels_array);
        
                                //Get an array that looks like this [{id: 1, amount: 10}, {id: 2, amount: 15}]
                                for ($i=0; $i<$levelsCount; $i++) {
                                    // Here we get the first referredID whose making the deposit
                                    $referrerId_[0] = $userID;
                                    //We then get multiple referrerIds based on the number of levels
                                    $referrerId_[$i + 1] = $this->referrals_model->getReferrerID($referrerId_[$i]);
                                    //We then procced to put it in an array with referrerId_[1] as the first Id
                                    $earningsData[] = (object) [
                                        "id" => $referrerId_[$i + 1],
                                        "interest" => $levels_array[$i],
                                        "amount" => $amount * $levels_array[$i]/100
                                    ];
                                }
        
                                //for generating the txn code
                                $this->load->helper('string');
        
                                //We then take the earnings data and remove all null Ids in the array to get the users
                                //that we should put soe earnings for
                                foreach($earningsData as $data) {
                                    if($data->id != null) {
                                        $array[] = array(
                                            'type' => 'referral',
                                            'userId'=> $data->id,
                                            'depositId' => $depositID,
                                            'txnCode' => 'PO'.random_string('alnum',8),
                                            'amount' => $data->amount,
                                            'createdDtm'=>date("Y-m-d H:i:s")
                                        );
                                    }
                                };
        
                                //Insert the data
                                $result = $this->transactions_model->addNewEarnings($array);
        
                                if($result > 0)
                                {
                                    return true;
                                } else 
                                {
                                    return false;
                                }
                            }
                        } else 
                        {
                            return false;
                        }   
                    }
                }
            } else {
                if($userID == Null || $amount == Null || $depositID == Null)
                {
                    return false;
                    //print_r('Either the user Id, amount or depositid is not available');
                }
                else 
                {
                    //Get the referrer ID
                    $referrerID = $this->referrals_model->getReferrerID($userID);

                    //First Let's check whether this user has been referred by anyone
                    if($referrerID != null) {
                        //Check the referral method & interest
                        $refMethod = $this->settings_model->getSettingsInfo()['refType'];
                        $refInterest = $this->settings_model->getSettingsInfo(1)['refInterest'];
                        $deposit_only_payouts = $this->settings_model->getSettingsInfo(1)['disableRefPayouts'];

                        if($refMethod == 'simple')
                        {
                            $number_of_deposits = $this->transactions_model->depositsListingCount('', $referrerID);

                            //Calculate the referrer's earnings
                            $earnings = $amount * ($refInterest/100);

                            //for generating the txn code
                            $this->load->helper('string');

                            //Insert earnings into the earnings table
                            $array = array(
                                'type' => 'referral',
                                'userId'=> $referrerID,
                                'depositId' => $depositID,
                                'txnCode' => 'PO'.random_string('alnum',8),
                                'amount' => $earnings,
                                'createdDtm'=> date("Y-m-d H:i:s")
                            );

                            if($deposit_only_payouts == 1 && $number_of_deposits > 0) {
                                $result = $this->transactions_model->addNewEarning($array);
                            } else if($deposit_only_payouts == 0) {
                                $result = $this->transactions_model->addNewEarning($array);
                            } else {
                                $result = 0;
                            }

                            if($result > 0)
                            {
                                return true;
                                //print_r('New simple earning added');
                            } else 
                            {
                                return false;
                                //print_r('New simple earning not added');
                            }

                        } else if($refMethod == 'multiple')
                        {
                            //Find the referral levels
                            $levels_array = explode(',', $refInterest);
                            $levelsCount = count($levels_array);

                            //Get an array that looks like this [{id: 1, amount: 10}, {id: 2, amount: 15}]
                            for ($i=0; $i<$levelsCount; $i++) {
                                // Here we get the first referredID whose making the deposit
                                $referrerId_[0] = $userID;
                                //We then get multiple referrerIds based on the number of levels
                                $referrerId_[$i + 1] = $this->referrals_model->getReferrerID($referrerId_[$i]);
                                //We then procced to put it in an array with referrerId_[1] as the first Id
                                $earningsData[] = (object) [
                                    "id" => $referrerId_[$i + 1],
                                    "interest" => $levels_array[$i],
                                    "amount" => $amount * $levels_array[$i]/100
                                ];
                            }

                            //for generating the txn code
                            $this->load->helper('string');

                            //We then take the earnings data and remove all null Ids in the array to get the users
                            //that we should put soe earnings for
                            foreach($earningsData as $data) {
                                if($data->id != null) {
                                    $array[] = array(
                                        'type' => 'referral',
                                        'userId'=> $data->id,
                                        'depositId' => $depositID,
                                        'txnCode' => 'PO'.random_string('alnum',8),
                                        'amount' => $data->amount,
                                        'createdDtm'=>date("Y-m-d H:i:s")
                                    );
                                }
                            };

                            //Insert the data
                            $result = $this->transactions_model->addNewEarnings($array);

                            if($result > 0)
                            {
                                return true;
                            } else 
                            {
                                return false;
                            }
                        }
                    } else 
                    {
                        return false;
                    }   
                }
            }
        }
    } 
}
?>