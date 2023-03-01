<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Home (HomeController)
 * Home class to display the main site
 * @author : Axis96
 * @version : 1.0
 * @since : 07 December 2019
 */
class Home extends BaseController {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		if($this->isDemo() == false){
			$this->load->model('plans_model');
			$companyInfo = $this->settings_model->getsettingsInfo();
			$data['companyInfo'] = $companyInfo;
			$data['recaptchaInfo'] = $this->addons_model->get_addon_info('Google Recaptcha');
			$data["pageTitle"] = $companyInfo['name'];
			$data["plans"] = $this->plans_model->getPlans(1);
			$data["isDemo"] = $this->isDemo();

			if($companyInfo['disable_frontend'] == '0'){
				$template = $companyInfo['frontend_template'];
				$data['template'] = $template;
		
				$header = '/frontend/template'.$template.'/partials/header';
				$view = '/frontend/template'.$template.'/home';
				$footer = '/frontend/template'.$template.'/partials/footer';
		
				$this->load->view($header, $data);
				$this->load->view($view, $data);
				$this->load->view($footer, $data);
			} else {
				$this->global['pageTitle'] = 'Login';

				$this->global['recaptchaInfo'] = $this->addons_model->get_addon_info('Google Recaptcha');
				$this->global['companyInfo'] = $this->settings_model->getsettingsInfo();
				
				$this->loadViews('auth/login', $this->global, $data, NULL);
			}
		} else {
			$this->load->model('plans_model');
			$companyInfo = $this->settings_model->getsettingsInfo();
			$data['recaptchaInfo'] = $this->addons_model->get_addon_info('Google Recaptcha');
			$data['companyInfo'] = $companyInfo;
			$data["pageTitle"] = $companyInfo['name'];
	
			$this->load->view('showcase', $data);
		}
	}

	public function homepage()
	{
		$this->load->model('plans_model');
		$companyInfo = $this->settings_model->getsettingsInfo();
		$data['recaptchaInfo'] = $this->addons_model->get_addon_info('Google Recaptcha');
		$data['companyInfo'] = $companyInfo;
		$data["pageTitle"] = $companyInfo['name'];
		$data["plans"] = $this->plans_model->getPlans(1);
		$data["isDemo"] = $this->isDemo();

		if($this->isDemo() == false){
			$template = $companyInfo['frontend_template'];
		} else {
			$template = $this->session->userdata('template') == '' ?  $companyInfo['frontend_template'] : $this->session->userdata('template');
		}

		$data['template'] = $template;

		$header = '/frontend/template'.$template.'/partials/header';
		$view = '/frontend/template'.$template.'/home';
		$footer = '/frontend/template'.$template.'/partials/footer';

		$this->load->view($header, $data);
		$this->load->view($view, $data);
		$this->load->view($footer, $data);
	}

	function calculator()
	{
		$csrfTokenName = $this->security->get_csrf_token_name();
		$csrfHash = $this->security->get_csrf_hash();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<small>', '</small>');

		$this->form_validation->set_rules('amount','Amount','required', array(
			'required' => lang('this_field_is_required')
		));
		$this->form_validation->set_rules('plan','Plan','required', array(
			'required' => lang('this_field_is_required')
		));

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			$errors = array();
			// Loop through $_POST and get the keys
			foreach ($this->input->post() as $key => $value)
			{
				// Add the error message for this field
				$errors[$key] = form_error($key);
			}
			$response['errors'] = array_filter($errors); // Some might be empty
			$response['success'] = false;
			$response["csrfTokenName"] = $csrfTokenName;
			$response["csrfHash"] = $csrfHash;
			$response['msg'] = html_escape(lang('please_correct_errors_and_try_again'));

			echo json_encode($response); 
		} 
		else
		{
			$amount = $this->input->post('amount', TRUE);
			$plan = $this->input->post('plan', TRUE);

			$planInfo = $this->plans_model->getPlanById($plan);

			if($amount < $planInfo->minInvestment){
				$res = array(
					'success' => false,
					'errors' => array(
						'amount' => 'This amount is less than the minimum investment amount'
					)
				);

				echo json_encode($res);
			} else if($amount > $planInfo->maxInvestment){
				$res = array(
					'success' => false,
					'errors' => array(
						'amount' => 'This amount is more than the maximum investment amount'
					)
				);

				echo json_encode($res);
			} else {
				$date = date('Y-m-d H:i:s');

				//Get Plan Details
				$maturityPeriod = $this->plans_model->getMaturity($plan)->period_hrs;
				$payoutsInterval = $this->plans_model->getPeriod($plan)->period_hrs;
				$start = date('Y-m-d H:i:s', strtotime($date."+$payoutsInterval hours"));
				$end = date('Y-m-d H:i:s', strtotime($date."+$maturityPeriod hours"));
				$businessDays = $planInfo->businessDays;
				$profitPercent = $planInfo->profit/100;
				$earningsAmount = $profitPercent*$amount;
				

				$earnings= $this->getDatesFromRange($start, $end, $payoutsInterval, $businessDays, $format = 'Y-m-d H:i:s');

				$total_roi = 0;

				foreach($earnings as $earning) {
					$total_roi += $earningsAmount;
                };

				if($planInfo->principalReturn == 0){
					$principal = 0;
				} else {
					$principal = $amount;
				}

				$res = array(
					'success' => true,
					'plan_info' => array(
						'plan_name' => $planInfo->name,
						'amount' => to_currency($amount),
						'payout_period' => $this->plans_model->getPeriod($plan)->periodName,
						'maturity' => $this->plans_model->getMaturity($plan)->maturity_desc,
						'return' => to_currency($total_roi + $principal)
					)
				);

				echo json_encode($res);
			}
		}
	}

	function switchLang($language = "") {
		$language = ($language != "") ? $language : "english";
		$this->session->set_userdata('site_lang', urldecode($language));
		$array = array(
			"success"=>true
		);

		echo json_encode($array);
	}

	function switchTemplate($template = "") {
		if($this->isDemo() == true){
			$this->session->set_userdata('template', $template);
			$array = array(
				"success"=>true
			);

			echo json_encode($array);
		}
	}

	public function error_404()
	{
		$data['pageTitle'] = 'Error 404';
		$this->load->model('settings_model');
		$this->load->view('404', $data);
	}

	public function faqs()
	{
		$data['pageTitle'] = 'FAQs';
		$companyInfo = $this->settings_model->getsettingsInfo();
		$data['companyInfo'] = $this->settings_model->getsettingsInfo();

		$data['faqs'] = $this->web_model->listFaqs();
		$data["isDemo"] = $this->isDemo();

		if($this->isDemo() == false){
			$template = $companyInfo['frontend_template'];
		} else {
			$template = $this->session->userdata('template') == '' ?  $companyInfo['frontend_template'] : $this->session->userdata('template');
		}

		$data['template'] = $template;

		$header = '/frontend/template'.$template.'/partials/header';
		$view = '/frontend/template'.$template.'/faq';
		$footer = '/frontend/template'.$template.'/partials/footer';

		$this->load->view($header, $data);
		$this->load->view($view, $data, NULL);
		$this->load->view($footer, $data);
	}

	public function terms()
	{
		$data['pageTitle'] = 'Terms';
		$companyInfo = $this->settings_model->getsettingsInfo();
		$data['companyInfo'] = $this->settings_model->getsettingsInfo();

		$data['content'] = $this->web_model->getTemplateContent('terms', $data['companyInfo']['frontend_template']);
		$data["isDemo"] = $this->isDemo();

		if($this->isDemo() == false){
			$template = $companyInfo['frontend_template'];
		} else {
			$template = $this->session->userdata('template') == '' ?  $companyInfo['frontend_template'] : $this->session->userdata('template');
		}

		$data['template'] = $template;

		$header = '/frontend/template'.$template.'/partials/header';
		$view = '/frontend/template'.$template.'/terms';
		$footer = '/frontend/template'.$template.'/partials/footer';

		$this->load->view($header, $data);
		$this->load->view($view, $data, NULL);
		$this->load->view($footer, $data);
	}

	public function privacy()
	{
		$data['pageTitle'] = 'Privacy';
		$companyInfo = $this->settings_model->getsettingsInfo();
		$data['companyInfo'] = $this->settings_model->getsettingsInfo();

		$data['content'] = $this->web_model->getTemplateContent('policy', $data['companyInfo']['frontend_template']);
		$data["isDemo"] = $this->isDemo();

		if($this->isDemo() == false){
			$template = $companyInfo['frontend_template'];
		} else {
			$template = $this->session->userdata('template') == '' ?  $companyInfo['frontend_template'] : $this->session->userdata('template');
		}

		$data['template'] = $template;

		$header = '/frontend/template'.$template.'/partials/header';
		$view = '/frontend/template'.$template.'/privacy';
		$footer = '/frontend/template'.$template.'/partials/footer';

		$this->load->view($header, $data);
		$this->load->view($view, $data, NULL);
		$this->load->view($footer, $data);
	}

	public function contact()
	{
		$data['pageTitle'] = 'Privacy';
		$companyInfo = $this->settings_model->getsettingsInfo();
		$data['companyInfo'] = $this->settings_model->getsettingsInfo();

		$data['content'] = $this->web_model->getTemplateContent('policy', $data['companyInfo']['frontendtemplate']);
		$data["isDemo"] = $this->isDemo();

		if($this->isDemo() == false){
			$template = $companyInfo['frontend_template'];
		} else {
			$template = $this->session->userdata('template') == '' ?  $companyInfo['frontend_template'] : $this->session->userdata('template');
		}

		$data['template'] = $template;

		$header = '/frontend/template'.$template.'/partials/header';
		$view = '/frontend/template'.$template.'/contact';
		$footer = '/frontend/template'.$template.'/partials/footer';

		$this->load->view($header, $data);
		$this->load->view($view, $data, NULL);
		$this->load->view($footer, $data);
	}

	public function contact_us()
	{
		$companyInfo = $this->settings_model->getsettingsInfo();
		
		$csrfTokenName = $this->security->get_csrf_token_name();
		$csrfHash = $this->security->get_csrf_hash();

		$this->load->helper(array('form', 'url'));

		//Validation
		$this->load->library('form_validation'); 
		  
        $this->form_validation->set_rules('name','First Name','trim|required', array(
            'required' => lang('this_field_is_required')
        ));
        $this->form_validation->set_rules('email','Email','trim|required|valid_email', array(
            'required' => lang('this_field_is_required'),
            'valid_email' => lang('this_email_is_invalid')
        ));
        $this->form_validation->set_rules('subject','subject','required', array(
            'required' => lang('this_field_is_required')
        ));
		$this->form_validation->set_rules('comment','comment','required', array(
            'required' => lang('this_field_is_required')
		));
		
		if($companyInfo['google_recaptcha'] != 0){
            if($companyInfo['recaptcha_version'] == 'v2'){
                $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback__recaptcha');
            } else if($companyInfo['recaptcha_version'] == 'v3') {
                $this->form_validation->set_rules('recaptcha_response','Captcha','callback__recaptcha');
            }
        }

		if($this->form_validation->run() == FALSE)
        {
			$this->session->set_flashdata('errors', validation_errors());

            //Ajax Request
            if ($this->input->is_ajax_request()) {
                $errors = array();
                // Loop through $_POST and get the keys
                foreach ($this->input->post() as $key => $value)
                {
                    // Add the error message for this field
                    $errors[$key] = form_error($key);
                }

                $response['errors'] = array_filter($errors); // Some might be empty
				$response['success'] = false;
				$response["csrfTokenName"] = $csrfTokenName;
                $response["csrfHash"] = $csrfHash;
                $response['msg'] = html_escape(lang('please_correct_errors_and_try_again'));

                echo json_encode($response); 
			}
        }
		else
		{
			$name = $this->input->post('name', TRUE);
			$email = $this->input->post('email', true);
			$subject = $this->input->post('subject', TRUE);
			$message = $this->input->post('comment', TRUE);

			$recaptchaInfo = $this->addons_model->get_addon_info('Google Recaptcha');

			$mailSubject = 'New Enquiry About ' . $companyInfo['name'];
			$mailContent = 'Full Name: '.$name.'<br>'.'Email Address: '.$email.'<br>'.'Subject: '.$subject.'<br>'.'Message: '.$message; 	

			$toEmail = $companyInfo['email'];
			$fromEmail = $companyInfo['email'];

			$name = 'Support';

			$header = "From: ". $name . " <" . $fromEmail . ">\r\n"; //optional headerfields

			$send = $this->sendEmail($toEmail,$mailSubject,$mailContent);

			if($send == true) {
				$this->session->set_flashdata('success', lang('your_message_has_been_sent_successfully'));
				$array = array(
					'success' => true,
					'msg' => html_escape(lang('your_message_has_been_sent_successfully')),
					"csrfTokenName" => $csrfTokenName,
					"csrfHash" => $csrfHash,
					'v'=>$companyInfo['recaptcha_version'],
					'key'=>$recaptchaInfo->public_key,
				);
	
				echo json_encode($array);
			} else {
				$this->session->set_flashdata('error', lang('your_message_has_not_been_sent_successfully'));
				$array = array(
					'success' => true,
					'msg' => html_escape(lang('your_message_has_not_been_sent_successfully')),
					"csrfTokenName" => $csrfTokenName,
					"csrfHash" => $csrfHash,
					'v'=>$companyInfo['recaptcha_version'],
					'key'=>$recaptchaInfo->public_key,
				);
	
				echo json_encode($array);
			}
		}
		if (!$this->input->is_ajax_request()) {
		redirect('/#contact');
		}
	}
	
	function earningsEmails(){
        //Get earnings where emails have not been sent
        $type = 0; //Type 0 are unsent emails 1 are sent email
        $pendingEmails = $this->transactions_model->getEarningsEmails($type);
        foreach($pendingEmails as $client){
            //Send Mail
            $conditionUserMail = array('tbl_email_templates.type'=>'Earnings Email');
            $resultEmail = $this->email_model->getEmailSettings($conditionUserMail);
            $companyInfo = $this->settings_model->getsettingsInfo();
        
            if($resultEmail->num_rows() > 0)
            {
                $rowUserMailContent = $resultEmail->row();
                $splVars = array(
                    "!clientName" => $client->firstName,
                    "!amount" => to_currency($client->amount),
                    "!ref" => $client->txnCode,
                    "!companyName" => $companyInfo['name'],
                    "!address" => $companyInfo['address'],
                    "!siteurl" => base_url()
                );

                $mailSubject = strtr($rowUserMailContent->mail_subject, $splVars);
                $mailContent = strtr($rowUserMailContent->mail_body, $splVars); 	

                $toEmail = $client->email;
                $fromEmail = $companyInfo['SMTPUser'];

                $name = 'Support';

                $header = "From: ". $name . " <" . $fromEmail . ">\r\n"; //optional headerfields

                $send = $this->sendEmail($toEmail,$mailSubject,$mailContent);

				$array = array(
					'email_sent' => '1',
				);
				
				$resultEarnings =$this->transactions_model->editEarning($client->txnCode, $array);
            }
		}
		$array = array(
			'success' => true,
			'msg' => html_escape("Cronjob succesful"),
		);

		echo json_encode($array);
	}

	public function _recaptcha($str)
    {
        $companyInfo = $this->settings_model->getsettingsInfo();
        $recaptchaInfo = $this->addons_model->get_addon_info('Google Recaptcha');
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = $recaptchaInfo->secret_key;
        $recaptcha_response = $str;

        if($companyInfo['recaptcha_version'] == 'v2'){
            $ip=$_SERVER['REMOTE_ADDR'];
            $url=$recaptcha_url."?secret=".$recaptcha_secret."&response=".$recaptcha_response."&remoteip=".$ip;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
            $res = curl_exec($curl);
            curl_close($curl);
            $res= json_decode($res, true);
            //reCaptcha success check
            if($res['success'])
            {
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('_recaptcha', lang('recaptcha_error_please_refresh_page_and_try_again'));
                return FALSE;
            }
        } else if($companyInfo['recaptcha_version'] == 'v3'){
            // Make and decode POST request:
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $res = json_decode($recaptcha);
            
            //print_r($res);
            if($res->success == 1)
            {
                // Take action based on the score returned:
                if ($res->score >= 0.5) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('_recaptcha', lang('recaptcha_error_please_refresh_page_and_try_again'));
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('_recaptcha', lang('recaptcha_error_please_refresh_page_and_try_again'));
                return FALSE;
            }
        }
    }

	function getDatesFromRange($start, $end, $payoutsInterval, $businessDays, $format = 'Y-m-d H:i:s') {
        $array = array();
        $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
        //$holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays
        $interval = 'PT'.$payoutsInterval.'H';
        $interval = new DateInterval($interval);
    
        $startDate = new DateTime($start);
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
    
        $periods = new DatePeriod($startDate, $interval, $realEnd);

        if($businessDays == 1){
            foreach($periods as $period) { 
                if (!in_array($period->format('N'), $workingDays)) continue;
                //if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
                //if (in_array($period->format('*-m-d'), $holidayDays)) continue;
                $array[] = $period->format($format); 
            }
        } else {
            foreach($periods as $period) { 
                $array[] = $period->format($format); 
            }
        }
    
        return $array;
    }
}