<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Pót
 *
 * @author JTec
 */
class Category extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        //save url hien tai
        //$url_save = array('url' => current_url());
        //$this->session->set_userdata('url_save', $url_save);
        $this->check_data_login();        
        $this->lang->load('content_back');
    }

    public function index()
    {
        $data = array();

        $this->load->model('Category_model');
        $data_session = $this->session->userdata('data_login');
        $data_index = $this->Category_model->index($data_session['id']);
        $data['ketqua'] = $data_index;
        
        $this->breadcrumbs->push($this->lang->line('home'),'/account/home');
        $this->breadcrumbs->push($this->lang->line(''),'/admin/category/index');
        
        $data['content'] = 'back_end/category_manager_view';
        $this->load->view('layout_back_end_view', $data);
    }

    public function manager()
    {
        $this->index();
    }

    public function new_category()
    {

        $data = array();
        if ($this->input->post() != NULL) {
            if ($this->input->post('title') != NULL && $this->input->post('description') != NULL) {

                //var_dump($this->input->post());
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = date('Y-m-d H:i:s');

                if ($this->input->post('alias') == NULL) {
                    $string = convert_accented_characters($this->input->post('title'));
                    $alias_to = url_title($string, '-', true);
                } else {
                    $alias_to = $this->input->post('alias');
                }

                $data_user_login = $this->session->userdata('data_login');
                //kiem tra du lieu nhap vao 'category' +alias 
                $in_data = array(
                    'title' => $this->input->post('title'),
                    'alias' => $alias_to,
                    'description' => $this->input->post('description'),
                    'create_time' => $date,
                    'account_id' => $data_user_login['id'],
                    'modify_time' => $date,
                );
                $this->load->model('Category_model');
                $ketqua = $this->Category_model->new_post($in_data);

                if ($ketqua == TRUE) {
                    redirect('admin/category/index');
                    return;
                } else {
                    $data['message']['error'] = 'Error-database: Can not save post ';
                }
                //var_dump($this->input->post());
            } else {
                $data['message']['error'] = 'Error-Input: No have Title or Description';
            }
        }
        
        $this->breadcrumbs->push('Home','/account/home');
        $this->breadcrumbs->push('New Category','/admin/category/new_category');
        
        $data['content'] = 'back_end/category_new_view';
        $this->load->view('layout_back_end_view', $data);
    }

    public function edit_category($id=NULL)
    {
        $data = array();

        if ($id != NULL) {
            $data = array();
            //kiem tra xem co id khong neu khong thi out
            //neu co id kiem tra xem co phai la method post khong thi show ra du lieu id do

            if ($this->input->post() != NULL) {
                if ($this->input->post('title') != NULL && $this->input->post('description') != NULL) {

                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $date = date('Y-m-d H:i:s');

                    if ($this->input->post('alias') == NULL) {
                        $string = convert_accented_characters($this->input->post('title'));
                        $alias_to = url_title($string, '-', true);
                    } else {
                        $alias_to = $this->input->post('alias');
                    }

                    //kiem tra du lieu nhap vao 'category' +alias 
                    $data_user_login = $this->session->userdata('data_login');
                    $in_data = array(
                        'title' => $this->input->post('title'),
                        'alias' => $alias_to,
                        'description' => $this->input->post('description'),
                        'account_id' => $data_user_login['id'],
                        'modify_time' => $date,
                    );
                    $this->load->model('Category_model');
                    $ketqua = $this->Category_model->update_post($id, $in_data,$data_user_login['id']);
                    if ($ketqua == TRUE) {
                        redirect('admin/category/index');
                        return;
                    } else {
                        $data['message']['error'] = 'Error-database: Can not Update category ';
                    }
                } else {
                    $data['message']['error'] = 'Error-Input: No have Title or Description';
                }
            } else {
                //load du lieu id
                $this->load->model('Category_model');
                $data_session_user= $this->session->userdata('data_login');
                //var_dump($data_session_user);exit();
                $data['result_id'] = $this->Category_model->Result_id($id, $data_session_user['id']);
                if ($data['result_id'] == NULL) {
                    $data['message']['error'] = 'No have ID or have role edit category';
                    //can render di noi khac
                }
//                var_dump($data['result_id']);                
//                exit();
            }
        } else {
            $data['message']['error'] = 'Error-Input: No id for edit';           
        }
        
        $this->breadcrumbs->push('Home','/account/home');
        $this->breadcrumbs->push('Edit Category','/admin/category/edit_category');

        $data['content'] = 'back_end/category_edit_view';
        $this->load->view('layout_back_end_view', $data);
    }
    
    public function delete($id = NULL)
    {
        if ($id != NULL) {
            $this->load->model('Category_model');
            $data_session = $this->session->userdata('data_login');
            $result = $this->Category_model->delete($id, $data_session['id']);
            if ($result) {
                // echo 'da xoa';
                redirect('admin/category/index');
            } else {
                echo 'Have error when delete database';
            }
        } else {
            echo 'No have id for delete input';
        }
    }

}
