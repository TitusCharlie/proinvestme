<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Referrals (Referrals Controller)
 * Referrals Class
 * @author : Axis96
 * @version : 3.2
 * @since : 25 February 2020
 */

class Referrals extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();  
        $this->isVerified();   
    }

    public function referrals(){
        if($this->role == ROLE_CLIENT)
        { 
            $searchText = $this->input->post('searchText' ,TRUE);
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->referrals_model->referralsListingCount($this->vendorId, $searchText);
            $returns = $this->paginationCompress ( "referrals/", $count, 10 ); 

            $data['referrals'] = $this->referrals_model->referrals($this->vendorId, $searchText, $returns["page"], $returns["segment"]);
            $data['total_referrals'] = $this->referrals_model->referralsListingCount($this->vendorId, $searchText);
            $data['referrals_this_week'] = $this->referrals_model->total_referrals_per_period($this->vendorId, date("Y-m-d H:i:s", strtotime('monday this week')), date("Y-m-d", strtotime('sunday this week')));

            $this->global['pageTitle'] = 'My Referrals';
            $this->global['displayBreadcrumbs'] = false;
            $this->loadViews("referrals/table", $this->global, $data, NULL);
        } else {
            $this->loadThis();
        }
    }

    function adminreferrals($id = NULL){
        if($this->role == ROLE_CLIENT)
        { 
            $this->loadThis();
        } else {
            $userId = ($id == NULL ? 0 : $id);

            $searchText = $this->input->post('searchText' ,TRUE);
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->referrals_model->referralsListingCount($userId, $searchText);
            $returns = $this->paginationCompress ( "referrals/".$userId."/", $count, 10, 3 ); 

            $data['referrals'] = $this->referrals_model->referrals($userId, $searchText, $returns["page"], $returns["segment"]);
            $data['total_referrals'] = $this->referrals_model->referralsListingCount($userId, $searchText);
            $data['referrals_this_week'] = $this->referrals_model->total_referrals_per_period($userId, date("Y-m-d H:i:s", strtotime('monday this week')), date("Y-m-d", strtotime('sunday this week')));
            
            $this->global['pageTitle'] = 'My Referrals';
            $this->global['displayBreadcrumbs'] = false;
            $this->loadViews("referrals/table", $this->global, $data, NULL);
        }
    }

    /**
     * This function used to send an invite link to new users
     */
    public function invite()
    {
        $csrfTokenName = $this->security->get_csrf_token_name();
        $csrfHash = $this->security->get_csrf_hash();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','required|valid_email', array(
            'required' => lang('this_field_is_required'),
            'valid_email' => lang('this_email_is_invalid')
        ));

        if($this->form_validation->run() == FALSE)
        {
            $array = array(
                'success' => false,
                'msg' => html_escape(lang('please_enter_email_of_person_you_want_to_refer_us_to')),
                "csrfTokenName" => $csrfTokenName,
                "csrfHash" => $csrfHash
            );

            echo json_encode($array);
        }
        else
        { 
            $data = $this->user_model->getUserInfo($this->vendorId);
            $name = $data->firstName;
            $refcode = $data->refCode;
            $joinLink = base_url()."signup/".$data->refCode;

            //Send Mail
            $conditionUserMail = array('tbl_email_templates.type'=>'Referral Invitation');
            $resultEmail = $this->email_model->getEmailSettings($conditionUserMail);

            $companyInfo = $this->settings_model->getsettingsInfo();
        
            if($resultEmail->num_rows() > 0)
            {
                $rowUserMailContent = $resultEmail->row();
                $splVars = array(
                    "!referrerName" => $name,
                    "!referralLink" => $joinLink,
                    "!companyName" => $companyInfo['name'],
                    "!address" => $companyInfo['address'],
                    "!siteurl" => base_url()
                );

            $mailSubject = strtr($rowUserMailContent->mail_subject, $splVars);
            $mailContent = strtr($rowUserMailContent->mail_body, $splVars); 	

            $toEmail = $this->security->xss_clean($this->input->post('email'));
            $fromEmail = $companyInfo['SMTPUser'];

            $name = 'Support';

            $header = "From: ". $name . " <" . $fromEmail . ">\r\n"; //optional headerfields

            $send = $this->sendEmail($toEmail,$mailSubject,$mailContent);

            if($send == true) {
                $array = array(
                    'success' => true,
                    'msg' => html_escape(lang('your_invitation_has_been_sent_successfully')),
                    "csrfTokenName" => $csrfTokenName,
                    "csrfHash" => $csrfHash
                );

                echo json_encode($array);
            } else {
                $array = array(
                    'success' => false,
                    'msg' => html_escape(lang('there_is_an_error_in_sending_your_invite_try_again_later')),
                    "csrfTokenName" => $csrfTokenName,
                    "csrfHash" => $csrfHash
                );

                echo json_encode($array);
            }
            }           
        }
    }

}