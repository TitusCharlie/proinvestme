<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Axis96
 * @version : 1.0
 * @since : 07 December 2019
 */
class Kyc extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            //Pagination lib
            $this->load->library('pagination');

            //Page Data
            $this->global['pageTitle'] = 'KYC Portal';   
            $this->global['displayBreadcrumbs'] = false;  

            //Search Data
            $searchText = $this->input->post('searchText', TRUE);
            $data['searchText'] = $searchText;
            $this->global['searchText'] = $this->input->post('searchText', TRUE);

            //Status
            if(isset($_SESSION['newsubmission']) && $_SESSION['newsubmission'] == 'true' || isset($_SESSION['resubmitted']) && $_SESSION['resubmitted'] == 'true' || isset($_SESSION['pendingresubmission']) && $_SESSION['pendingresubmission'] == 'true' || isset($_SESSION['approved']) && $_SESSION['approved'] == 'true' || isset($_SESSION['rejected']) && $_SESSION['rejected'] == 'true')
            {
                $status = true;
            } else {
                $status = NULL;
            }

            //Count
            $count = $this->verification_model->verification_list_count($searchText, $status, NULL, NULL);
            $returns = $this->paginationCompress ( "kyc-portal/", $count, 10 );

            //Verification data
            $data['verifications'] = $this->verification_model->verification_list($searchText, $status, $returns["page"], $returns["segment"]);

            $this->loadViews("kyc/table", $this->global, $data, NULL);
        }
    }

    function all_applications(){
        $_SESSION['newsubmission'] = false;
        $_SESSION['resubmitted'] = false;
        $_SESSION['pendingresubmission'] = false;
        $_SESSION['approved'] = false;
        $_SESSION['rejected'] = false;

        redirect('kyc-portal');
    }

    function filter(){
        $csrfTokenName = $this->security->get_csrf_token_name();
        $csrfHash = $this->security->get_csrf_hash();

        $newsubmission = $this->input->post('newsubmission', true);
        $resubmitted = $this->input->post('resubmitted', true);
        $pendingresubmission = $this->input->post('pendingresubmission', true);
        $approved = $this->input->post('approved', true);
        $rejected = $this->input->post('rejected', true);

        $_SESSION['newsubmission'] = $newsubmission;
        $_SESSION['resubmitted'] = $resubmitted;
        $_SESSION['pendingresubmission'] = $pendingresubmission;
        $_SESSION['approved'] = $approved;
        $_SESSION['rejected'] = $rejected;

        $res = array(
            'success'=>true,
            "csrfTokenName" => $csrfTokenName,
            "csrfHash" => $csrfHash
        );

        echo json_encode($res);
    }

    function verification_info($id){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $data = $this->verification_model->getVerificationInfoById($id);

            /**
             * Application status
             * 0 - Not vetted/New
             * 1 - Approved
             * 2 - Sent back for resubmission
             * 3 - Resubmitted
             * 4 - Rejected  
             */
            if($data->overall_status == 0){
                $status = 'New Application';
            } else if($data->overall_status == 1){
                $status = 'Approved';
            } else if($data->overall_status == 2){
                $status = 'Pending Resubmission';
            } else if($data->overall_status == 3){
                $status = 'Resubmitted';
            } else if($data->overall_status == 4){
                $status = 'Rejected';
            }

            $info = array(
                'success' =>true,
                'static_info' => array(
                    'name'             => $data->firstName.'&nbsp'.$data->lastName,
                    'email'            => $this->isDemo() == true ? '[Email is protected in demo]' : $data->email,
                    'id_type'          => $data->id_type,
                    'address_type'     => $data->address_type,
                    'submittedid'      => $data->identification_document == NULL ? NULL : base_url('uploads/'.$data->identification_document),
                    'rejectedid'       => $data->rejected_identification_document == NULL ? NULL : base_url('uploads/'.$data->rejected_identification_document),
                    'submittedaddress' => $data->address_document == NULL ? NULL : base_url('uploads/'.$data->address_document),
                    'rejectedaddress'  => $data->rejected_address_document == NULL ? NULL : base_url('uploads/'.$data->rejected_address_document),  
                    'status'           => $status    
                ),
                'form_variables' => array(
                    'id_rejection_status'      => $data->status1,
                    'id_rejection_reason'      => $data->rejection_reason_id,
                    'address_rejection_status' => $data->status2,
                    'address_rejection_reason' => $data->rejection_reason_address,
                ),
            );

            echo json_encode($info);
        }
    }

    function submitDetails(){
        if($this->role != ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('upload');
            $this->load->library('form_validation');

            $info = $this->verification_model->getVerificationInfo($this->vendorId);
                    
            if($info == false){
            $this->form_validation->set_rules('identification_doc','Identification Document','required');
            $this->form_validation->set_rules('idimg','ID Image','callback_id_check');
            $this->form_validation->set_rules('address_doc','Address Document','required');
            $this->form_validation->set_rules('addressimg','Address Image','callback_address_check');
            } else {
                if($info->status1 == 2){
                    $this->form_validation->set_rules('identification_doc','Identification Document','required');
                    $this->form_validation->set_rules('idimg','ID Image','callback_id_check');
                }
                if($info->status2 == 2){
                    $this->form_validation->set_rules('address_doc','Address Document','required');
                    $this->form_validation->set_rules('addressimg','Address Image','callback_address_check');
                }
            }

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
                $response['msg'] = html_escape('Please correct the errors and try again.');

                echo json_encode($response); 
            }
            else
            {
                $iddoc = $this->input->post('identification_doc', TRUE);
                $addoc = $this->input->post('address_doc', TRUE);

                //Upload the documents First
                if(isset($_FILES["idimg"]["name"])){
                    if ($this->security->xss_clean($this->input->post('idimg'), TRUE) === TRUE)
                    {
                        $config["upload_path"] = './uploads';
                        $config['allowed_types'] = '*';
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('idimg')){
                            $data = ($this->upload->data());
                            $nameID = $data["file_name"];
                        }else{
                            $errors = $this->upload->display_errors();
                            $nameID = '';
                        }; 
                    }
                } 

                if(isset($_FILES["addressimg"]["name"])){
                    if ($this->security->xss_clean($this->input->post('addressimg'), TRUE) === TRUE)
                    {
                        $config["upload_path"] = './uploads';
                        $config['allowed_types'] = '*';
                        $this->upload->initialize($config);

                        if ($this->upload->do_upload('addressimg')){
                            $data = ($this->upload->data());
                            $nameAddress = $data["file_name"];
                        }else{
                            $errors = $this->upload->display_errors();
                            $nameAddress = '';
                        }; 
                    }
                } 

                if($info == false){
                    $array = array(
                        'userId' => $this->vendorId,
                        'id_type' => $iddoc,
                        'identification_document' => $nameID,
                        'address_type' => $addoc,
                        'address_document' => $nameAddress,
                        'createdDtm' => date('Y-m-d H:i:s')
                    );
                    $result = $this->verification_model->addKycInfo($array);
                } else {
                    if($info->status1 == 2){
                        $array = array(
                            'id_type' => $iddoc,
                            'identification_document' => $nameID,
                            'status1' => 3,
                            'overall_status' => 3
                        );
                        $result = $this->verification_model->updateInfo($array, $this->vendorId);
                    } 
                    
                    if($info->status2 == 2){
                        $array = array(
                            'address_type' => $addoc,
                            'address_document' => $nameAddress,
                            'status2' => 3,
                            'overall_status' => 3
                        );
                        $result = $this->verification_model->updateInfo($array, $this->vendorId);
                    }
                }

                if($result > 0){
                    $res = array(
                        'success'=>true,
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=> 'Please try again',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
            }
        }
    }

    public function id_check($str){
        $allowed_mime_type_arr = array('application/pdf','application/x-download','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['idimg']['name']);
        if(isset($_FILES['idimg']['name']) && $_FILES['idimg']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    public function address_check($str){
        $allowed_mime_type_arr = array('application/pdf','application/x-download','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['addressimg']['name']);
        if(isset($_FILES['addressimg']['name']) && $_FILES['addressimg']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    function verify($taskId){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
                    
            $this->form_validation->set_rules('idverificationstatus','ID Approval Status','required');
            $this->form_validation->set_rules('approveaddressverification','Address Approval Status','required');

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
                $response['msg'] = html_escape('Please correct the errors and try again.');

                echo json_encode($response); 
            }
            else
            {
                $idverificationstatus = $this->input->post('idverificationstatus', TRUE);
                $approveaddressverification = $this->input->post('approveaddressverification', TRUE);
                $rejectionreasonid = $this->input->post('rejectionreason1', TRUE);
                $rejectionreasonaddress = $this->input->post('rejectionreason2', TRUE);

                $taskInfo = $this->verification_model->getVerificationInfoById($taskId);
                $userId = $taskInfo->userId;

                if($idverificationstatus == 2 && $rejectionreasonid == ''){
                    $res = array(
                        'success'=>false,
                        'msg'=> 'Please add a reason when rejecting a field',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                } 
                
                if($approveaddressverification == 2 && $rejectionreasonaddress == ''){
                    $res = array(
                        'success'=>false,
                        'msg'=> 'Please add a reason when rejecting a field',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                } 
                
                if($idverificationstatus == 1 && $approveaddressverification == 1){
                    $data = array(
                        'rejection_reason_id'=>NULL,
                        'status1'=>1,
                        'rejection_reason_address'=>NULL,
                        'status2'=>1,
                        'overall_status'=>1,
                        'assignedTo'=>$this->vendorId
                    );

                    $save = $this->verification_model->updateInfo($data, $userId);

                    if($save == true){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Form submitted succesfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );

                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'There is an issue in saving your form. Please reload the page and try again',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );

                        echo json_encode($res);
                    }

                } 
                
                if($idverificationstatus == 2 || $approveaddressverification == 2){
                    $data = array(
                        'status1'=>$idverificationstatus,
                        'rejection_reason_id'=> $idverificationstatus == 1 ? NULL : $rejectionreasonid,
                        'rejected_identification_document'=> $idverificationstatus == 2 ? $taskInfo->identification_document == NULL ? $taskInfo->rejected_identification_document : $taskInfo->identification_document : NULL,
                        'identification_document'=> $idverificationstatus == 2 ? NULL : NULL,
                        'status2'=> $approveaddressverification,
                        'overall_status'=>2,
                        'address_document'=> $approveaddressverification == 2 ? NULL : NULL,
                        'rejection_reason_address'=>$approveaddressverification == 1 ? NULL : $rejectionreasonaddress,
                        'rejected_address_document'=>$approveaddressverification == 2 ? $taskInfo->address_document == NULL ? $taskInfo->rejected_address_document : $taskInfo->address_document : NULL,
                        'assignedTo'=>$this->vendorId
                    );

                    $save = $this->verification_model->updateInfo($data, $userId);

                    if($save == true){
                        $res = array(
                            'success'=>true,
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );

                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );

                        echo json_encode($res);
                    }
                }
            }
        }
    }

    function apply_for_verification(){
        if($this->role != ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $data['companyInfo'] = $this->settings_model->getsettingsInfo();
            $data['info'] = $this->verification_model->getVerificationInfo($this->vendorId);
            $this->load->view('backend/kyc/verify', $data);
        }
    }
}