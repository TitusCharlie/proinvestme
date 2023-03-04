<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Axis96
 * @version : 3.2
 * @since : 18 February 2021
 */

class BaseController extends CI_Controller
{
	protected $role = '';
	protected $vendorId = '';
	protected $firstName = '';
	protected $lastName = '';
	protected $roleText = '';
	protected $global = array();
	protected $lastLogin = '';

	public function __construct()
	{

		parent::__construct();

		//Load libaries
		$this->load->library('session');

		//Load all model classes
		$this->load->model('addons_model');
		$this->load->model('btcpay_model');
		$this->load->model('coinbase_model');
		$this->load->model('email_model');

		$this->load->model('languages_model');

		$this->load->model('login_model');
		$this->load->model('payeer_model');
		$this->load->model('payments_model');
		$this->load->model('paystack_model');
		$this->load->model('perfectmoney_model');
		$this->load->model('plans_model');
		$this->load->model('referrals_model');
		$this->load->model('settings_model');
		$this->load->model('ticket_model');
		$this->load->model('transactions_model');
		$this->load->model('twilio_model');
		$this->load->model('user_model');
		$this->load->model('verification_model');
		$this->load->model('web_model');

		$this->SiteData();

		$timezone = $this->settings_model->getSettingsInfo()['timezone'];
		$tz = !$timezone ? 'UTC' : $timezone;
		date_default_timezone_set($tz);

		$companyInfo = $this->settings_model->getSettingsInfo();
		$userLang = $this->session->userdata('site_lang') == '' ?  $companyInfo['default_language'] : $this->session->userdata('site_lang');


		$this->load->helper('language');


		$this->lang->load('common', $userLang);
		$this->lang->load('login', $userLang);
		$this->lang->load('registration', $userLang);
		$this->lang->load('dashboard', $userLang);
		$this->lang->load('transactions', $userLang);
		$this->lang->load('users', $userLang);
		$this->lang->load('plans', $userLang);
		$this->lang->load('email_templates', $userLang);
		$this->lang->load('settings', $userLang);
		$this->lang->load('payment_methods', $userLang);
		$this->lang->load('languages', $userLang);
		$this->lang->load('validation', $userLang);
		$this->lang->load('tickets', $userLang);

		$this->lang->load('kyc', $userLang);
		$this->lang->load('web_control', $userLang);
	}

	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	public function response($data = NULL)
	{
		$this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
		exit();
	}

	/**
	 * Base information for all pages
	 */
	public function companyInfo()
	{
		//Site Info
		$this->companyInfo = $this->settings_model->getSettingsInfo();
		$this->global['companyInfo'] = $this->companyInfo;

		//Recaptcha info
		$recaptchaInfo = $this->addons_model->get_addon_info('Google Recaptcha');
		$this->global['recaptchaInfo'] = $recaptchaInfo;
	}

	/**
	 * This function used to get the site's Site Data fro the database
	 */
	public function SiteData()
	{
		$companyInfo = $this->settings_model->getSettingsInfo();
		$this->companyName = $companyInfo['name'];
		//Logos
		if (!empty($companyInfo['whiteLogo'])) {
			$this->logoWhite = base_url() . 'uploads/' . $companyInfo['whiteLogo'];
		} else {
			$this->logoWhite = base_url() . 'assets/dist/img/logo-white.png';
		}
		if (!empty($companyInfo['darkLogo'])) {
			$this->logoDark = base_url() . 'uploads/' . $companyInfo['darkLogo'];
		} else {
			$this->logoDark = base_url() . 'assets/dist/img/logo.png';
		}
		if (!empty($companyInfo['favicon'])) {
			$this->favicon = base_url() . 'uploads/' . $companyInfo['favicon'];
		} else {
			$this->favicon = base_url() . 'assets/dist/img/favicon.png';
		}
		$language = $this->session->userdata('site_lang') == '' ?  $companyInfo['default_language'] : $this->session->userdata('site_lang');
		$langLogo = $this->languages_model->getLangByName($language);
		$languages = $this->languages_model->all_Languages(0);
		$this->site_lang = $langLogo;
		$this->site_languages = $languages;
		$this->siteTitle = $companyInfo['title'];
		$this->siteDescription = $companyInfo['description'];
		$this->siteKeywords = $companyInfo['keywords'];
		$this->chatWidget = $companyInfo['chatWidget'];
		$this->currency = $companyInfo['currency'];
		$this->chatPluginActive = $companyInfo['chat_plugin_active'];
		$this->chatPlugin = $companyInfo['chat_plugin'];
		$this->tawkpropertyid = $this->addons_model->get_addon_info('Tawk.To')->public_key;
	}

	/**
	 * Checks if ProInvest is running the demo environment
	 */
	function isDemo()
	{
		if (base_url() == 'https://proinvest.axis96.co/') {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Checks if request is GET or POST
	 */
	function isGet()
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			//its a get
			return true;
		} elseif ($this->input->server('REQUEST_METHOD') === 'POST') {
			//its a post
			return false;
		}
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn()
	{

		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('login');
		} else {


			$this->role = $this->session->userdata('role');
			$this->vendorId = $this->session->userdata('userId');
			$this->firstName = $this->session->userdata('firstName');
			$this->lastName = $this->session->userdata('lastName');
			$this->roleText = $this->session->userdata('roleText');
			$this->lastLogin = $this->session->userdata('lastLogin');

			$this->userLang = $this->languages_model->getLangByName($this->session->userdata('site_lang') == '' ?  $this->settings_model->getSettingsInfo()['default_language'] : $this->session->userdata('site_lang'));
			$this->languages = $this->languages_model->all_Languages(0);
			$this->companyInfo = $this->settings_model->getSettingsInfo();

			if (!empty($this->session->userdata('ppic'))) {
				$this->ppic = base_url() . 'uploads/' . $this->session->userdata('ppic');
			} else {
				$this->ppic = base_url() . 'assets/dist/img/avatar.png';
			}

			$this->global['firstName'] = $this->security->xss_clean($this->firstName);
			$this->global['userId'] = $this->vendorId;
			$this->global['lastName'] = $this->security->xss_clean($this->lastName);
			$this->global['companyName'] = $this->security->xss_clean($this->companyName);
			$this->global['role'] = $this->security->xss_clean($this->role);
			$this->global['role_text'] = $this->security->xss_clean($this->roleText);
			$this->global['last_login'] = $this->security->xss_clean($this->lastLogin);
			$this->global['ppic'] = $this->security->xss_clean($this->ppic);
			$this->global['userLang'] = $this->userLang;

			$this->global['languages'] = $this->languages;
			$this->global['companyInfo'] = $this->companyInfo;

			$this->global['ticketnotify'] = $this->ticket_model->pendingtickets();
			// Check this latter
			// $this->global['kycnotify'] = $this->verification_model->pendingkyc();
			$this->global['isDemo'] = $this->isDemo();
		}
	}

	/**
	 * This function is used to check the access
	 */
	function isAdmin($module_id, $action_id)
	{
		if ($this->role == ROLE_CLIENT) {
			return false;
		} else {
			if ($this->role == ROLE_ADMIN) {
				return true;
			} else if ($this->role == ROLE_MANAGER) {
				if (!$this->user_model->getPermissions($module_id, $action_id, $this->vendorId)) {
					return false;
				} else {
					return true;
				}
			}
		}
	}


	/**
	 * This function is used to load the set of views
	 */
	function loadThis()
	{
		$this->global['pageTitle'] = 'Access Denied';

		$this->load->view('access');
	}

	/**
	 * This function is used to logged out user from system
	 */
	function logout()
	{
		$sess_array = $this->session->all_userdata();

		foreach ($sess_array as $key => $val) {
			if ($key != 'site_lang') {
				$this->session->unset_userdata($key);
			}
		}

		redirect('login');
	}

	function kycIsActive()
	{
		//First check if KYC has been activated
		$companyInfo = $this->settings_model->getSettingsInfo();
		$kyc_status = $companyInfo['kyc_status'];

		if ($kyc_status == 0) {
			//Not activated
			return false;
		} else {
			// Activated
			return true;
		}
	}

	function isVerified()
	{
		//Check if KYC is on or off
		$kyc_status = $this->kycIsActive();

		if ($this->role != ROLE_CLIENT) {
			//Admin level access does not need to be bothered by KYC verification
			$this->global['isVerified'] = 'Verified';
			return true;
		} else {
			if ($kyc_status == false) {
				//The user can access all components since KYC has not been turned on
				$this->global['isVerified'] = 'Verified';
				return true;
			} else {
				//Run a check to see if the user has been verified
				$isVerified = $this->verification_model->isVerified($this->vendorId);

				if ($isVerified == false) {
					//No record exists
					$this->global['isVerified'] = 'Verify Your Account';
					return false;
				} else {
					//Check the status of the current application
					$status = $isVerified->overall_status;

					if ($status == 0) {
						//Approved
						$this->global['isVerified'] = 'Pending Verification';
						return false;
					} else if ($status == 1) {
						//Not approved yet
						$this->global['isVerified'] = 'Verified';
						return true;
					} else if ($status == 2) {
						//Not approved yet
						$this->global['isVerified'] = 'Pending Resubmission';
						return false;
					} else if ($status == 3) {
						//Not approved yet
						$this->global['isVerified'] = 'Pending Verification';
						return false;
					} else if ($status == 4) {
						//Not approved yet
						$this->global['isVerified'] = 'Rejected';
						return false;
					}
				}
			}
		}
	}

	//http://stackoverflow.com/questions/1727077/generating-a-drop-down-list-of-timezones-with-php
	function _get_timezones()
	{
		$timezones = DateTimeZone::listIdentifiers();
		$timezone_offsets = array();

		foreach ($timezones as $timezone) {
			$tz = new DateTimeZone($timezone);
			$timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
		}

		// sort timezone by offset
		asort($timezone_offsets);

		$timezone_list = array();
		foreach ($timezone_offsets as $timezone => $offset) {
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate('H:i', abs($offset));
			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";


			$current_time = '';
			$date = new DateTime();
			$date->setTimezone(new DateTimeZone($timezone));
			if (method_exists($date, 'setTimestamp')) {
				$date->setTimestamp(time());
				$current_time = $date->format('h:i a');
			}
			$timezone_list[$timezone] = "(${pretty_offset}) $timezone $current_time";
		}

		return $timezone_list;
	}

	/**
	 * This function used to load views
	 * @param {string} $viewName : This is view name
	 * @param {mixed} $headerInfo : This is array of header information
	 * @param {mixed} $pageInfo : This is array of page information
	 * @param {mixed} $footerInfo : This is array of footer information
	 * @return {null} $result : null
	 */
	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
	{
		$companyInfo = $this->settings_model->getsettingsInfo();
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		$this->load->view('backend/partials/header', $headerInfo);
		$this->load->view('backend/' . $viewName, $pageInfo);
		$this->load->view('backend/partials/footer', $footerInfo);
	}

	function sendEmail($recipient, $subject, $content)
	{
		//load PHPMailer library
		$this->load->library('phpmailer_lib');

		//Email settings
		$companyInfo = $this->settings_model->getSettingsInfo();

		//PhpMailer object
		$mail = $this->phpmailer_lib->load();

		//SMTP configuration
		if ($companyInfo['SMTPProtocol'] == 'smtp') {
			$mail->isSMTP();
		} else if ($companyInfo['SMTPProtocol'] == 'sendmail') {
			$mail->isSendmail();
		} else if ($companyInfo['SMTPProtocol'] == 'mail') {
			$mail->isMail();
		}
		$mail->Host = $companyInfo['SMTPHost'];
		$mail->SMTPAuth = true;
		$mail->Username = $companyInfo['SMTPUser'];
		$mail->Password = $companyInfo['SMTPPass'];
		$mail->SMTPSecure = 'tls';
		$mail->Port = $companyInfo['SMTPPort'];

		$mail->setFrom($companyInfo['SMTPUser'], $companyInfo['name']);
		$mail->addReplyTo($companyInfo['SMTPUser'], 'Support');

		//Add Recipient
		$mail->addAddress($recipient);


		//Email subject
		$mail->Subject = $subject;

		//Set email format to HTML
		$mail->isHTML(true);

		//Email body content
		$mailContent = $content;

		$mail->Body = $mailContent;

		//Send email
		if (!$mail->send()) {
			//echo 'Message Could not be sent.';
			//echo 'Mailer error: '. $mail->ErrorInfo;
			return FALSE;
		} else {
			//echo 'Message has been sent';
			return TRUE;
		}
	}

	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url() . $link;
		$config['data_page_attr'] = 'class="page-link"';
		$config['total_rows'] = $count;
		$config['uri_segment'] = $segment;
		$config['per_page'] = $perPage;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_tag_open'] = '<li class="arrow">';
		$config['first_link'] = 'First';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="paginate_button page-item previous" id="data-table_previous">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="paginate_button page-item next" id="data-table_next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" aria-controls="data-table" data-dt-idx="1" tabindex="0" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="paginate_button page-item ">';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="arrow">';
		$config['last_link'] = 'Last';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = $config['per_page'];
		$segment = $this->uri->segment($segment);

		return array(
			"page" => $page,
			"segment" => $segment
		);
	}


	/**
	 * Callback Functions
	 */

	public function _recaptcha($str)
	{
		$companyInfo = $this->settings_model->getsettingsInfo();
		$recaptchaInfo = $this->addons_model->get_addon_info('Google Recaptcha');
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = $recaptchaInfo->secret_key;
		$recaptcha_response = $str;

		if ($companyInfo['recaptcha_version'] == 'v2') {
			$ip = $_SERVER['REMOTE_ADDR'];
			$url = $recaptcha_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response . "&remoteip=" . $ip;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
			$res = curl_exec($curl);
			curl_close($curl);
			$res = json_decode($res, true);
			//reCaptcha success check
			if ($res['success']) {
				return TRUE;
			} else {
				$this->form_validation->set_message('_recaptcha', lang('recaptcha_error_please_refresh_page_and_try_again'));
				return FALSE;
			}
		} else if ($companyInfo['recaptcha_version'] == 'v3') {
			// Make and decode POST request:
			$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
			$res = json_decode($recaptcha);

			//print_r($res);
			if ($res->success == 1) {
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

	//Check if select field has a value or not
	function _check_default_select($post_string)
	{
		if ($post_string == '0') {
			$this->form_validation->set_message('_check_default_select', lang('this_field_is_required'));
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
