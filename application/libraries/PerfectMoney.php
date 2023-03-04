<?php


/**
 * Perfect Money Payment Library
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is available through the world-wide-web at this URL:
 * https://choosealicense.com/licenses/gpl-3.0/
 *
 * @category        Perfect Money
 * @package         codeigniter/libraries
 * @version         1.0
 * @author          Axis96 <support@axis96.co>
 * @copyright       Copyright (c) 2020 Axis96
 * @license         https://choosealicense.com/licenses/gpl-3.0/
 *
 * EXTENSION INFORMATION
 *
 * PERFECT MONEY       https://perfectmoney.com
 *
 */

class PerfectMoney
{
    private $payee_account = '';                                      
    private $payee_name = '';                                   
    private $payment_id = '';                                    
    private $payment_amount = '';                                    
    private $payment_units = '';                                       
    private $status_url = '';  
    private $payment_url = '';                                         
    private $url = 'https://perfectmoney.com/api/step1.asp';        
    private $payment_url_method = 'POST';
    private $no_payment_url = '';  
    private $no_payment_url_method = 'POST';
    private $suggested_memo = '';
    private $baggage_fields = ''; 
    protected $AccountID = '';           //@var integer AccountID: the username of your PM account.
    protected $PassPhrase = '';          //@var string PassPhrase: the password of your PM account.       


    /**
     * Constructor
     *
     */
    public function __construct($config = false)
    {
        if (isset($config['payee_account'])) $this->payee_account = $config['payee_account'];
        if (isset($config['payee_name'])) $this->payee_name = $config['payee_name'];
        if (isset($config['payment_id'])) $this->payment_id = $config['payment_id'];
        if (isset($config['payment_amount'])) $this->payment_amount = $config['payment_amount'];
        if (isset($config['payment_units'])) $this->payment_units = $config['payment_units'];
        if (isset($config['status_url'])) $this->status_url = $config['status_url'];
        if (isset($config['payment_url'])) $this->payment_url = $config['payment_url'];
        if (isset($config['url'])) $this->url = $config['url'];
        if (isset($config['payment_url_method'])) $this->payment_url_method = $config['payment_url_method'];
        if (isset($config['no_payment_url'])) $this->no_payment_url = $config['no_payment_url'];
        if (isset($config['no_payment_url_method'])) $this->no_payment_url_method = $config['no_payment_url_method'];
        if (isset($config['suggested_memo'])) $this->suggested_memo = $config['suggested_memo'];
        if (isset($config['baggage_fields'])) $this->baggage_fields = $config['baggage_fields'];
    }


    /**
     * Fetch the public name of another existing PerfectMoney account
     *
     */
    public function getAccountName($account)
    {
        // trying to open URL to process PerfectMoney getAccountName request
        $data = file_get_contents("https://perfectmoney.is/acct/acc_name.asp?AccountID={$this->AccountID}&PassPhrase={$this->PassPhrase}&Account={$account}");

        if($data == 'ERROR: Can not login with passed AccountID and PassPhrase'){

            throw new Exception('Invalid PerfectMoney Username or Password.', 500);

        }elseif($data == 'ERROR: Invalid Account'){

            throw new Exception('Invalid PerfectMoney Account specified.', 500);

        }

        return $data;
    }


    /**
     * get the balance for the wallet or a specific account inside a wallet
     *
     */
    public function getBalance($account = null)
    {
        // trying to open URL to process PerfectMoney Balance request
        $data = file_get_contents("https://perfectmoney.is/acct/balance.asp?AccountID={$this->AccountID}&PassPhrase={$this->PassPhrase}");

        // searching for hidden fields
        if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $data, $result, PREG_SET_ORDER)) {
            return false;
        }

        // putting data to array
        $array = [];

        foreach ($result as $item) {
            $array[$item[1]] = $item[2];
        }

        if ($account == null) {
            return $array;
        }

        return $array[$account] ?? false;
    }


    /**
     * Transfer funds(currency) to another existing PerfectMoney account
     *
     */
    public function transferFund($fromAccount, $toAccount, $amount, $paymentID = null, $memo = null)
    {
        $urlString = "https://perfectmoney.is/acct/confirm.asp?AccountID={$this->AccountID}&PassPhrase={$this->PassPhrase}&Payer_Account={$fromAccount}&Payee_Account={$toAccount}&Amount={$amount}&PAY_IN=1";

        $urlString .= ($paymentID != null) ? "&PAYMENT_ID={$paymentID}" : "";

        $urlString .= ($paymentID != null) ? "&Memo={$memo}" : "";

        // trying to open URL to process PerfectMoney Balance request
        $data = file_get_contents($urlString);

        // searching for hidden fields
        if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $data, $result, PREG_SET_ORDER)) {
            return false;
        }

        // putting data to array
        $array = [];

        foreach ($result as $item) {
            $array[$item[1]] = $item[2];
        }

        return $array;
    }


    /**
     * Create new E-Voucher with your PerfectMoney account
     *
     */
    public function createEV($payerAccount, $amount)
    {
        // trying to open URL to process PerfectMoney Balance request
        $data = file_get_contents("https://perfectmoney.is/acct/ev_create.asp?AccountID={$this->AccountID}&PassPhrase={$this->PassPhrase}&Payer_Account={$payerAccount}&Amount={$amount}");

        // searching for hidden fields
        if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $data, $result, PREG_SET_ORDER)) {
            return false;
        }

        // putting data to array
        $array = [];

        foreach ($result as $item) {
            $array[$item[1]] = $item[2];
        }

        return $array;
    }

    public function transferEV($toAccount, $EVnumber, $EVactivationCode)
    {
        // trying to open URL to process PerfectMoney Balance request
        $data = file_get_contents("https://perfectmoney.is/acct/ev_activate.asp?AccountID={$this->AccountID}&PassPhrase={$this->PassPhrase}&Payee_Account={$toAccount}&ev_number={$EVnumber}&ev_code={$EVactivationCode}");

        // searching for hidden fields
        if (!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $data, $result, PREG_SET_ORDER)) {
            return false;
        }

        // putting data to array
        $array = [];

        foreach ($result as $item) {
            $array[$item[1]] = $item[2];
        }

        return $array;
    }

    public function submitForm()
    {
        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <script type="text/javascript">
                function closethisasap() {
                    document.forms["redirectpost"].submit();
                }
            </script>
        </head>
        <body onload="closethisasap();">
            <form name="redirectpost" method="post" action="<?php echo $this->url; ?>">
                <?php
                echo '<input type="hidden" name="PAYEE_ACCOUNT" value="' . $this->payee_account . '"> ';
                echo '<input type="hidden" name="PAYEE_NAME" value="' . $this->payee_name . '"> ';
                echo '<input type="hidden" name="PAYMENT_ID" value="' . $this->payment_id . '"> ';
                echo '<input type="hidden" name="PAYMENT_AMOUNT" value="' . $this->payment_amount . '"> ';
                echo '<input type="hidden" name="PAYMENT_UNITS" value="' . $this->payment_units . '"> ';
                echo '<input type="hidden" name="STATUS_URL" value="' . $this->status_url . '"> ';
                echo '<input type="hidden" name="PAYMENT_URL" value="' . $this->payment_url . '"> ';
                echo '<input type="hidden" name="PAYMENT_URL_METHOD" value="' . $this->payment_url_method . '"> ';
                echo '<input type="hidden" name="NOPAYMENT_URL" value="' . $this->no_payment_url . '"> ';
                echo '<input type="hidden" name="NOPAYMENT_URL_METHOD" value="' . $this->no_payment_url_method . '"> ';
                echo '<input type="hidden" name="SUGGESTED_MEMO" value="' . $this->suggested_memo . '"> ';
                echo '<input type="hidden" name="BAGGAGE_FIELDS" value="' . $this->baggage_fields . '"> ';
                ?>
            </form>
        </body>
        </html>
        <?php
        exit;
    } 

    /*
    public function formSubmit()
    {
        //create array of data to be posted
        $post_data['PAYEE_ACCOUNT'] = 'U24976189';
        $post_data['PAYEE_NAME'] = 'ProInvest';
        $post_data['PAYMENT_ID'] = '12345678';
        $post_data['PAYMENT_AMOUNT'] = '2';
        $post_data['PAYMENT_UNITS'] = 'USD';
        $post_data['STATUS_URL'] = 'https://axis96.co/coding/success';
        $post_data['PAYMENT_URL'] = 'https://axis96.co/coding/success';
        $post_data['PAYMENT_URL_METHOD'] = 'POST';
        $post_data['NOPAYMENT_URL'] = 'https://axis96.co/coding/failed';
        $post_data['NOPAYMENT_URL_METHOD'] = 'POST';
        $post_data['SUGGESTED_MEMO'] = '';
        $post_data['BAGGAGE_FIELDS'] = '';

        //traverse array and prepare data for posting (key1=value1)
        foreach ( $post_data as $key => $value) {
            $post_items[] = $key . '=' . $value;
        }

        //create the final string to be posted using implode()
        $post_string = implode ('&', $post_items);

        //create cURL connection
        $urltopost = 'https://perfectmoney.com/api/step1.asp';
        $curl_connection = curl_init();

        //set options
        curl_setopt($curl_connection, CURLOPT_URL, $urltopost);
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl_connection, CURLOPT_USERAGENT, 
        "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl_connection, CURLOPT_MAXREDIRS, 1);
        curl_setopt($curl_connection, CURLOPT_POST, true);
        curl_setopt($curl_connection, CURLOPT_AUTOREFERER, TRUE);

        //header('Content-Type: text/html');

        //set data to be posted
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

        //perform our request
        $result = curl_exec($curl_connection);

        echo $result;

        //show information regarding the request
        //print_r(curl_getinfo($curl_connection));
        //echo curl_errno($curl_connection) . '-' . 
        curl_error($curl_connection);
        
        //close the connection
        curl_close($curl_connection);
    }*/
}

