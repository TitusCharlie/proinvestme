<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Axis96
 * @version : 1.0
 * @since : 07 December 2019
 */
class Webcontrol extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();   
    }

    public function templates(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Templates';   
            $this->global['displayBreadcrumbs'] = true;
            $this->global['breadcrumbs'] = lang('templates').' <span class="breadcrumb-arrow-right"></span> '.lang('settings');

            //Count
            $count = $this->web_model->templatesListingCount();
            $returns = $this->paginationCompress ( "webcontrol/templates", $count, 10 );
            
            $data['templates'] = $this->web_model->allTemplates($returns["page"], $returns["segment"]);

            $this->loadViews("web/templates", $this->global, $data, NULL);
        }
    }

    public function templateBuilder($id){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Template Builder';   
            $this->global['displayBreadcrumbs'] = true;
            $this->global['breadcrumbs'] = 'Templates'.' <span class="breadcrumb-arrow-right"></span> '.'Settings';

            $this->global["companyInfo"] = $this->settings_model->getSettingsInfo();

            $this->global['templateInfo'] = $this->web_model->getAllContent($id);

            $this->load->view("backend/web/builder", $this->global);
        }
    }

    public function FAQs(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'Templates';   
            $this->global['displayBreadcrumbs'] = false;

            //Search Data
            $searchText = $this->input->post('searchText', TRUE);
            $data['searchText'] = $searchText;
            $this->global['searchText'] = $this->input->post('searchText', TRUE);

            //Count
            $count = $this->web_model->faqListingCount($searchText);
            $returns = $this->paginationCompress ( "webcontrol/faq", $count, 10 );
            
            $data['faqs'] = $this->web_model->allFaqs($searchText, $returns["page"], $returns["segment"]);

            $this->loadViews("web/faqs", $this->global, $data, NULL);
        }
    }

    public function createFaq(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('question','Answer','required', array(
                'required' => lang('this_field_is_required')
            ));
            $this->form_validation->set_rules('answer','Answer','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $question = $this->input->post('question', TRUE);
                $answer = $this->input->post('answer', TRUE);

                $array = array(
                    'question' => $question,
                    'answer' => $answer
                );

                if($this->isDemo() == false){
                    $result = $this->web_model->createFaq($array);

                    if($result > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Faq created successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
    
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'Faq creation failed',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
    
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
            }
        }
    }

    public function editFaq($id){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('question','Answer','required', array(
                'required' => lang('this_field_is_required')
            ));
            $this->form_validation->set_rules('answer','Answer','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $question = $this->input->post('question', TRUE);
                $answer = $this->input->post('answer', TRUE);

                $array = array(
                    'question' => $question,
                    'answer' => $answer
                );

                if($this->isDemo() == false){
                    $result = $this->web_model->editFaq($id, $array);

                    if($result > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Faq edited successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
    
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'There was nothing to edit',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
    
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
                
            }
        }
    }

    public function deleteFaq($id){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            if($this->isDemo() == false){
                $res = $this->web_model->deleteFaq($id);

                if($res){
                    $res = array(
                        'success'=>true,
                        'msg'=>'Faq deleted successfully',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );
    
                    echo json_encode($res);
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'An error occurred. Please refresh page and try again.',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );
    
                    echo json_encode($res);
                }
            } else {
                $res = array(
                    'success'=>false,
                    'msg'=>'This feature is not allowed in demo',
                    "csrfTokenName" => $csrfTokenName,
                    "csrfHash" => $csrfHash
                );

                echo json_encode($res);
            }
            
        }
    }

    public function terms(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $data['terms'] = $this->web_model->getContent('terms')->value;
            $this->global['pageTitle'] = 'T&Cs Settings';
            $this->global['displayBreadcrumbs'] = true; 
            $this->global['breadcrumbs'] = 'Terms & Conditions'.' <span class="breadcrumb-arrow-right"></span> '.'Settings';
            $this->loadViews("web/terms", $this->global, $data); 
        } 
    }
    public function about(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        }else{
            $data['about'] = $this->web_model->getContent('about')->value;
            $this->global['pageTitle'] = 'About us';
            $this->global['displayBreadcrumbs'] = true;
            $this->global['breadcrumbs'] = 'About'.' <span class="breadcrumbs-arrow-right"></span> '.'settings';
            $this->loadViews("web/about", $this->global, $data);
        }
    }
    public function cookies(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $data['cookies'] = $this->web_model->getContent('cookies')->value;
            $this->global['pageTitle'] = 'cookies';
            $this->global['displayBreadcrumbs'] = true; 
            $this->global['breadcrumbs'] = 'cookies'.' <span class="breadcrumb-arrow-right"></span> '.'Settings';
            $this->loadViews("web/cookies", $this->global, $data); 
        } 
    }
    public function policy(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $data['policy'] = $this->web_model->getContent('policy')->value;
            $this->global['pageTitle'] = 'Policy Settings';
            $this->global['displayBreadcrumbs'] = true; 
            $this->global['breadcrumbs'] = 'Policy'.' <span class="breadcrumb-arrow-right"></span> '.'Settings';
            $this->loadViews("web/policy", $this->global, $data);  
        }
    }

    public function editPolicy(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('policycontent','Content','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $content = $this->input->post('policycontent', TRUE);

                $array = array(
                    'value'=>$content,
                );

                if($this->isDemo() == false){
                    $res = $this->web_model->editContent($array, 'policy');

                    if($res > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Content edited successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'An error occurred. Please refresh page and try again.',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }

            }
        }
    }

    public function editAbout(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('content','Content','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $content = $this->input->post('content', TRUE);

                $array = array(
                    'value'=>$content,
                );

                if($this->isDemo() == false){
                    $res = $this->web_model->editContent($array, 'about');

                    if($res > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Content edited successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'An error occurred. Please refresh page and try again.',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
                
            }
        }
    }

    public function editCookies(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('content','Content','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $content = $this->input->post('content', TRUE);

                $array = array(
                    'value'=>$content,
                );

                if($this->isDemo() == false){
                    $res = $this->web_model->editContent($array, 'cookies');

                    if($res > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Content edited successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'An error occurred. Please refresh page and try again.',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
                
            }
        }
    }


    public function editTerms(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('content','Content','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $content = $this->input->post('content', TRUE);

                $array = array(
                    'value'=>$content,
                );

                if($this->isDemo() == false){
                    $res = $this->web_model->editContent($array, 'terms');

                    if($res > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Content edited successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'An error occurred. Please refresh page and try again.',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
                
            }
        }
    }

    public function footer(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $data['content'] = $this->web_model->getContent('footer')->value;
            $this->global['pageTitle'] = 'Footer Note';
            $this->global['displayBreadcrumbs'] = true; 
            $this->global['breadcrumbs'] = 'Footer Note'.' <span class="breadcrumb-arrow-right"></span> '.'Settings';
            $this->loadViews("web/footer", $this->global, $data);  
        }
    }

    public function editFooter(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('content','Content','required', array(
                'required' => lang('this_field_is_required')
            ));

            if($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('errors', validation_errors());
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
                $content = $this->input->post('content', TRUE);

                $array = array(
                    'value'=>$content,
                );

                if($this->isDemo() == false){
                    $res = $this->web_model->editContent($array, 'footer');

                    if($res > 0){
                        $res = array(
                            'success'=>true,
                            'msg'=>'Content edited successfully',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    } else {
                        $res = array(
                            'success'=>false,
                            'msg'=>'An error occurred. Please refresh page and try again.',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );
        
                        echo json_encode($res);
                    }
                } else {
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                }
                
            }
        }
    }

    function editBuilder(){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $template = $this->input->post('template', TRUE);

            foreach($_POST as $key => $value) {
                $templateInfo[] = array(
                    'name' => $key,
                    'value' => $value
                );
            }

            if($this->isDemo() == false){
                $this->db->where('template', $template);
                $this->db->update_batch('tbl_content', $templateInfo, 'name');

                $array = array(
                    'success' => true,
                    'msg' => html_escape(lang('successfully_updated_your_info')),
                    "csrfTokenName" => $csrfTokenName,
                    "csrfHash" => $csrfHash
                );

                echo json_encode($array);
            } else {
                $res = array(
                    'success'=>false,
                    'msg'=>'This feature is not allowed in demo',
                    "csrfTokenName" => $csrfTokenName,
                    "csrfHash" => $csrfHash
                );

                echo json_encode($res);
            }
        }
    }

    function defaultTemplate($id){
        if($this->role == ROLE_CLIENT)
        {
            $this->loadThis();
        } else {
            $config = array(
                array(
                    'type' => 'frontend_template',
                    'value' => $id
                )
            );

            if($this->isDemo() == false){
                $this->db->update_batch('tbl_settings', $config, 'type');

                $array = array(
                    'success' => true,
                    'msg' => html_escape(lang('successfully_updated_your_info'))
                );

                echo json_encode($array);
            } else {
                $res = array(
                    'success'=>false,
                    'msg'=>'This feature is not allowed in demo'
                );

                echo json_encode($res);
            }
        }
    }
}