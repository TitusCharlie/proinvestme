<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Languages (Languages Controller)
 * Languages Class
 * @author : Axis96
 * @version : 1.0
 * @since : 02 February 2019
 */
class Languages extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn(); 
    }

    function addLanguage(){
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();

            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('lname','Language Name','required', array(
                'required' => lang('this_field_is_required')
            ));
            $this->form_validation->set_rules('lcode','Language Code','required', array(
                'required' => lang('this_field_is_required')
            ));
            if (empty($_FILES['logo']['name']))
            {
                $this->form_validation->set_rules('logoUpload', 'Logo', 'required', array(
                    'required' => lang('this_field_is_required')
                ));
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
                $response['msg'] = html_escape(lang('please_correct_errors_and_try_again'));

                echo json_encode($response); 
            }
            else
            {
                $name = $this->input->post('lname', TRUE);
                $code = $this->input->post('lcode', TRUE);

                //Upload the logos First
                if(isset($_FILES["logo"]["name"])){
                    if ($this->security->xss_clean($this->input->post('logo'), TRUE) === TRUE)
                    {
                        $config["upload_path"] = './uploads';
                        $config['allowed_types'] = 'jpg|png';
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('logo')){
                            $data = ($this->upload->data());
                            $logo = $data["file_name"];
                        }else{
                            $errors = $this->upload->display_errors();
                            $logo = '';
                        }; 
                    }
                } 
                
                $array = array(
                    'name'=>$name, 
                    'code'=>$code, 
                    'logo'=>$logo
                );
                $defaultLang = $this->settings_model->getSettingsInfo()['default_language'];
                $langid = $this->languages_model->getLangByName($defaultLang)->id;
                $result = $this->languages_model->addLanguage($array, $langid);

                if($result == true)
                {
                    $array = array(
                        'success' => true,
                        'msg' => html_escape(lang('successfully_added_new_language')),
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash,
                        "logo"=>$logo,
                        "name"=>$name,
                        "code"=>$code,
                        "id"=>$result
                    );

                    echo json_encode($array);
                }
                else
                {
                    $array = array(
                        'success' => false,
                        'msg' => html_escape(lang('failed_to_add_new_language')),
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($array);
                }
            }
        }
    }

    function editLanguage(){
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();
            
            $this->load->library('upload');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('lname','Language Name','required', array(
                'required' => lang('this_field_is_required')
            ));
            $this->form_validation->set_rules('lcode','Language Code','required', array(
                'required' => lang('this_field_is_required')
            ));
            //$this->form_validation->set_rules('logo','Logo','required');

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
                if($this->isDemo()){
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                } else {
                    $id   = $this->input->post('lid', TRUE);
                    $name = $this->input->post('lname', TRUE);
                    $code = $this->input->post('lcode', TRUE);

                    //Upload the logos
                    if(isset($_FILES["logo"]["name"])){
                        if ($this->security->xss_clean($this->input->post('logo'), TRUE) === TRUE)
                        {
                            $config["upload_path"] = './uploads';
                            $config['allowed_types'] = 'jpg|png';
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('logo')){
                                $data = ($this->upload->data());
                                $logo = $data["file_name"];
                            }else{
                                $errors = $this->upload->display_errors();
                                $getLangLogo = $this->languages_model->getLang($id);
                                $logo = $getLangLogo->logo;
                            }; 
                        }
                    } 

                    if (empty($_FILES['logo']['name']))
                    {
                        $array = array(
                            'name'=>$name, 
                            'code'=>$code 
                        );
                    } else
                    {
                        $array = array(
                            'name'=>$name, 
                            'code'=>$code, 
                            'logo'=>$logo
                        );
                    } 
                    
                    //First check if this is the default lang
                    $defaultLang = $this->settings_model->getSettingsInfo()['default_language'];
                    $thisLang = $this->languages_model->getLang($id)->name;

                    if($defaultLang == $thisLang){
                        //We need to change the default lang as well
                        $companyInfo = array(
                            array(
                                'type' => 'default_language',
                                'value' => $name
                            ),
                        );

                        $this->db->update_batch('tbl_settings', $companyInfo, 'type');

                        $result = $this->languages_model->editLanguage($array, $id);
                        
                    } else {
                        //Proceed to edit
                        $result = $this->languages_model->editLanguage($array, $id);
                    }

                    if($result == true)
                    {
                        $array = array(
                            'success' => true,
                            'msg' => html_escape(lang('successfully_changed_language')),
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash,
                            "logo"=>$logo,
                            "name"=>$name,
                            "code"=>$code
                        );

                        echo json_encode($array);
                    }
                    else
                    {
                        $array = array(
                            'success' => false,
                            'msg' => html_escape(lang('failed_to_edit_language')),
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );

                        echo json_encode($array);
                    }
                }
            }
        }
    }

    function deleteLanguage(){
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('lid','ID','required', array(
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
                if($this->isDemo()){
                    $res = array(
                        'success'=>false,
                        'msg'=>'This feature is not allowed in demo',
                        "csrfTokenName" => $csrfTokenName,
                        "csrfHash" => $csrfHash
                    );

                    echo json_encode($res);
                } else {
                    $id   = $this->input->post('lid', TRUE);

                    //First check how many languages are currently available
                    $numlang = $this->languages_model->getNumLanguages();

                    if($numlang == 1){
                        //Stop here, we can't delete this language as it is being used
                        $array = array(
                            'success' => false,
                            'msg' => 'You can\'t delete this language as it is being used.',
                            "csrfTokenName" => $csrfTokenName,
                            "csrfHash" => $csrfHash
                        );

                        echo json_encode($array);
                    } else if($numlang > 1){
                        //We can delete an extra language as long as it is not the only language in the system
                        //Check if the language being deleted is the same as the currentLang
                        $defaultLang = $this->settings_model->getSettingsInfo()['default_language'];
                        $thisLang = $this->languages_model->getLang($id)->name;

                        if($defaultLang == $thisLang){
                            //Go to language db and get another language replacement for default language
                            $res = $this->languages_model->deleteLang($id);

                            if($res){
                                $newLang = $this->languages_model->firstLangRow()->name;
                                $companyInfo = array(
                                    array(
                                        'type' => 'default_language',
                                        'value' => $newLang
                                    ),
                                );
                                $this->db->update_batch('tbl_settings', $companyInfo, 'type');
                                
    
                                $array = array(
                                    'success' => true,
                                    'msg' => 'Language deleted succesfully!',
                                    "csrfTokenName" => $csrfTokenName,
                                    "csrfHash" => $csrfHash
                                );
        
                                echo json_encode($array);
                            } else {
                                $array = array(
                                    'success' => false,
                                    'msg' => 'Something happened! Please reload and try again.',
                                    "csrfTokenName" => $csrfTokenName,
                                    "csrfHash" => $csrfHash
                                );
        
                                echo json_encode($array);
                            }
                        } else {
                            //Just proceed and delete the language
                            $this->languages_model->deleteLang($id);

                            $array = array(
                                'success' => true,
                                'msg' => 'Language deleted succesfully!',
                                "csrfTokenName" => $csrfTokenName,
                                "csrfHash" => $csrfHash
                            );
    
                            echo json_encode($array);
                        }
                    }
                }
            }
        }
    }

    function editTranslation(){
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $csrfTokenName = $this->security->get_csrf_token_name();
            $csrfHash = $this->security->get_csrf_hash();
            $langid = $this->input->post('langId', TRUE);

            //$allvalues = $this->input->post(NULL, TRUE);

            $data = array();
            foreach($_POST as $key => $value){ 
                $data[] = array(
                    'key' => $key,
                    'translation' => $this->input->post($key)
                );
            };

            $result = $this->languages_model->editTranslation($langid, $data);
            if($result == TRUE){
                $array = array(
                    'success' => true,
                    'msg'=>lang('updated_successfully'),
                    "csrfTokenName" => $csrfTokenName,
                    "csrfHash" => $csrfHash,
                    "id"=> $data
                );

                echo json_encode($array);
            }
        }
    }

    function change_language($id){
        $newLangId = $id;
        $userId = $this->vendorId;

        $langArray = array(
            'lang_id'=>$id
        );

        $result = $this->languages_model->changeLang($userId, $langArray);

        if($result == true){
            $result_array = array(
                'success' => true,
                'msg'=> lang('updated_successfully')
            );

            echo json_encode($result_array);
        } else {
            $result_array = array(
                'success' => false,
                'msg'=> lang('update_failed')
            );

            echo json_encode($result_array);
        }
    }

    function languages(){
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $this->global['pageTitle'] = 'Language Settings';
            $this->global['displayBreadcrumbs'] = true; 
            $this->global['breadcrumbs'] = lang('settings').' <span class="breadcrumb-arrow-right"></span> '.lang('languages');

            $this->load->library('pagination');
            $count = $this->languages_model->getNumLanguages();
            $returns = $this->paginationCompress ( "settings/languages/", $count, 10 );

            $data['languages'] = $this->languages_model->getLanguages($returns["page"], $returns["segment"]);
            //Let us load the first language
            $data['langID'] = $this->languages_model->firstLangRow()->id;
            $data['langName'] = $this->languages_model->firstLangRow()->name;
            $data['langCode'] = $this->languages_model->firstLangRow()->code;
            $data['langLogo'] = $this->languages_model->firstLangRow()->logo;
            $data['langModules'] = $this->languages_model->getLangModules();

            $data['languageNow'] = $this->languages_model->userLang($this->vendorId);
            
            $this->loadViews("settings/languages", $this->global, $data, NULL);
        }
    }

    function getLangSettings($langId, $module)
    {
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $result = $this->languages_model->getLangSettings($langId, $module);
            $module = $this->languages_model->getLangModule($module);
            $lang = $this->languages_model->getLang($langId);
            if($result)
            {
                $array = array(
                    'success' => true,
                    'msg' => html_escape(lang('success')),
                    'lang'=> $lang->name.' '.lang('settings'),
                    'module_code'=>$module->lang_name,
                    "list" => $result
                );

                echo json_encode($array);
            }
            else
            {
                $array = array(
                    'success' => false,
                    'module_name'=>$module->name,
                    'module_code'=>$module->lang_name,
                    'msg' => html_escape(lang('an_error_occurred'))
                );

                echo json_encode($array);
            }
        }
    }

    function getLang($id)
    {
        $module_id = 'languages';
        $module_action = 'languages';
        if($this->isAdmin($module_id, $module_action) == FALSE)
        {
            $this->loadThis();
        } 
        else
        {
            $result = $this->languages_model->getLang($id);
            if($result)
            {
                $array = array(
                    'success' => true,
                    'msg' => html_escape(lang('success')),
                    'logo'=> $result->logo,
                    'name'=> $result->name,
                    'code'=> $result->code
                );

                echo json_encode($array);
            }
            else
            {
                $array = array(
                    'success' => false,
                    'msg' => html_escape(lang('an_error_occurred'))
                );

                echo json_encode($array);
            }
        }
    }
}