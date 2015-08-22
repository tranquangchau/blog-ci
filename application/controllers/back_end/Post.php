<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Pót
 *
 * @author JTec
 */
class Post extends My_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        //save url hien tai
        //$url_save = array('url' => current_url());
        //$this->session->set_userdata('url_save', $url_save);
        $this->check_data_login();

        $this->lang->load('content_back');
        $data_session_user_login = $this->session->userdata('id');
    }

    public function index()
    {
//        $data=array();
//        $data['content']='back_end/post_manager_view';
//        $this->load->view('layout_back_end_view',$data);

        $data = array();
        $data['content'] = 'back_end/post_manager_view';
        $isValid = TRUE;

        //check quyen
        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for /post/index';
            $isValid = FALSE;
        }
        if ($isValid) {
            $data_user = $this->session->userdata('data_login');

            $this->load->model('Post_model');
            $data['ketqua'] = $this->Post_model->manager($data_user['id']);

            //var_dump($data['ketqua']);
            $this->breadcrumbs->push($this->lang->line('home'), '/account/home');
            $this->breadcrumbs->push($this->lang->line('post_m_breadcrum'), '/admin/post/index');
        }

        $this->load->view('layout_back_end_view', $data);
    }

    public function manager()
    {
        $this->index();
    }

    public function new_post()
    {

        $data = array();
        $data['content'] = 'back_end/post_new_view';
        $isValid = TRUE;

        //check quyen
        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for new post';
            $isValid = FALSE;
        }

        if ($this->input->post() != NULL && $isValid) {

            $data_user = $this->session->userdata('data_login');
            $url_save = array('url_' . $data_user['id'] => current_url());
            $this->session->set_userdata('url_save', $url_save);

            if ($this->input->post('title') != NULL && $this->input->post('category') !=NULL) {

                //var_dump($this->input->post()); exit();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = date('Y-m-d H:i:s');
                //upload file if have
                $link_file = '';
                if ($_FILES['userfile']['size'] > 0) { //neu co file up len
                    $config = $this->config->item('image_upload');
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('userfile')) {
                        $data['message']['error_upload'] = $this->upload->display_errors();
                        var_dump($data['message']);
                        exit();
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        $link_file = $data_upload['upload_data']['file_name'];
                        //var_dump($data_upload);exit();
                    }
                }
                if ($this->input->post('alias') == NULL) {
                    $string = convert_accented_characters($this->input->post('title'));
                    $alias_to = url_title($string, '-', true);
                } else {
                    $alias_to = $this->input->post('alias');
                }
                //kiem tra du lieu nhap vao 'category' +alias 
                $data_user_login = $this->session->userdata('data_login');
                //
                $in_data = array(
                    'title' => $this->input->post('title'),
                    'alias' => $alias_to,
                    'hinh_anh' => $link_file,
                    'category_id' => $this->input->post('category'),
                    'mieu_ta' => $this->input->post('mieu_ta'),
                    'content' => $this->input->post('content'),
                    'create_time' => $date,
                    'account_id' => $data_user_login['id'],
                    'modify_time' => $date,
                );
                $this->load->model('Post_model');
                $ketqua = $this->Post_model->new_post($in_data);

                if ($ketqua == TRUE) {
                    redirect('admin/post/index');
                    return;
                } else {
                    $data['message']['error'] = 'Error-database: Can not save post ';
                }
                //var_dump($this->input->post());
            } else {
                $data['message']['error'] = 'Error-Input: No have Title or category';
            }
        }

        $data_session = $this->session->userdata('data_login');
        $this->load->model('Category_model');
        $data['result_id']['category_info'] = $this->Category_model->show_category($data_session['id']);

        $this->breadcrumbs->push($this->lang->line('home'), '/admin/home');
        $this->breadcrumbs->push($this->lang->line('post_n_breadcrum'), '/admin/post/new_post');


        $this->load->view('layout_back_end_view', $data);
    }

    public function upload_file_photo($userfile)
    {
        $config['upload_path'] = UPLOAD_PATH;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '20000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($userfile)) {
            $data['message']['error_upload'] = $this->upload->display_errors();
            var_dump($data['message']);
            exit();
        } else {
            $data_upload = array('upload_data' => $this->upload->data());
            return $data_upload['upload_data']['filename'];
            //var_dump($data_upload);exit();
        }
    }

    public function edit_post($id = NULL)
    {


        $isValid = TRUE;
        $data = array();

        $data['content'] = 'back_end/post_edit_view';

        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for edit_post';
            $isValid = FALSE;
        }
        if ($isValid && $id == NULL) {
            $data['message']['error'] = 'No id for edit ';
            $isValid = FALSE;
        }
        if ($isValid) {

            $isValid_Post = FALSE;
            if ($this->input->post() != NULL) {
                //var_dump($this->input->post()); exit();
                if ($this->input->post('title') == NULL || $this->input->post('category') == NULL) {
                    $isValid = false;
                    $data['message']['error'] = 'Error-Input: No have Title or Category';
                }

                $isNewHinh = FALSE;
                //kieu tra upfile kog
                if ($_FILES['userfile']['size'] > 0) {
                    $config = $this->config->item('image_upload');
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('userfile')) {
                        $data['message']['error_upload'] = $this->upload->display_errors();
                        $data['message']['error'] = 'Error-Input: File Error ' . $data['message']['error_upload'];
                        //var_dump($data['message']['error_upload']); exit();
                        $isValid = FALSE;
                    } else {
                        $data_upload = array('upload_data' => $this->upload->data());
                        $hinh_anh_new = $data_upload['upload_data']['file_name'];
                        $isNewHinh = TRUE;
                    }
                }
                $isValid_Post = TRUE;
            }

            if ($isValid && $isValid_Post) {
                //make time edit
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = date('Y-m-d H:i:s');

                //xu ly alias
                $alias_to = $this->input->post('alias');
                $string = convert_accented_characters($this->input->post('alias'));
                $alias_to = url_title($string, '-', true);
                if ($alias_to == NULL) {
                    $string = convert_accented_characters($this->input->post('title'));
                    $alias_to = url_title($string, '-', true);
                }

                //load hinh vs id ra
                $this->load->model('Post_model');
                $ketqua_hinh = $this->Post_model->result_hinhanh($id);
                $hinh_anh = $ketqua_hinh['0']['hinh_anh']; //ten file or ''

                $delete_hinh = $this->input->post('delete_hinhanh');
                if ($delete_hinh == 'true' || ($_FILES['userfile']['size'] > 0)) {
                    if ($hinh_anh != '') {
                        $hinh_anh = UPLOAD_PATH . $hinh_anh;
                        //xoa hinh
                        if (file_exists($hinh_anh)) {
                            unlink($hinh_anh);
                            // echo 'OK' .$hinh_anh;exit();
                        }
                        $hinh_anh = ''; //xoa khong duoc cung cho link bang rong
                    }
                }
                if ($isNewHinh) {
                    $hinh_anh = $hinh_anh_new;
                }

                $data_user_login = $this->session->userdata('data_login');
                $in_data = array(
                    'title' => $this->input->post('title'),
                    'account_id' => $data_user_login['id'],
                    'alias' => $alias_to,
                    'hinh_anh' => $hinh_anh,
                    'category_id' => $this->input->post('category'),
                    'mieu_ta' => $this->input->post('mieu_ta'),
                    'content' => $this->input->post('content'),
                    'modify_time' => $date,
                );
                $this->load->model('Post_model');

                $this->Post_model->update_post($id, $in_data, $data_user_login['id']); //update database
                redirect('admin/post/index');
                return;
            }
            //load du lieu id
            $this->load->model('Post_model');
            $data_session = $this->session->userdata('data_login');
            $data['result_id'] = $this->Post_model->Result_id($id, $data_session['id']);
            if ($data['result_id'] == NULL) {
                $data['message']['error'] = 'No have ID or no role for edit';
            }
            //set url hinh_anh
            if ($data['result_id']['0']['hinh_anh'] != '') {
                $data['result_id']['0']['hinh_anh'] = base_url('upload') . '/' . $data['result_id']['0']['hinh_anh'];
            }

            $this->load->model('Category_model');
            $data['result_id']['category_info'] = $this->Category_model->show_category($data_session['id']);

            //var_dump($data['result_id']);exit();
        }


        $this->breadcrumbs->push($this->lang->line('home'), '/account/home');
        $this->breadcrumbs->push($this->lang->line('post_edit_breadcrum'), '/admin/post/edit_post');


        $this->load->view('layout_back_end_view', $data);
    }

    public function edit_post_back($id = NULL)
    {

        $isValid = TRUE;
        $data = array();

        $data['content'] = 'back_end/post_edit_view';

        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for edit_post';
            $isValid = FALSE;
        }
        if ($isValid) {
            if ($id != NULL) {

                if ($this->input->post() != NULL) {

                    //var_dump($this->input->post()); exit();
                    if ($this->input->post('title') == NULL || $this->input->post('category') == NULL) {
                        $isValid = false;
                        $data['message']['error'] = 'Error-Input: No have Title or Category';
                    }
                    if ($isValid) {
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $date = date('Y-m-d H:i:s');

                        //xu ly alias
                        $alias_to = $this->input->post('alias');
                        $string = convert_accented_characters($this->input->post('alias'));
                        $alias_to = url_title($string, '-', true);
                        if ($alias_to == NULL) {
                            $string = convert_accented_characters($this->input->post('title'));
                            $alias_to = url_title($string, '-', true);
                        }

                        //load hinh vs id ra
                        $this->load->model('Post_model');
                        $ketqua_hinh = $this->Post_model->result_hinhanh($id);
                        $hinh_anh = $ketqua_hinh['0']['hinh_anh']; //ten file or ''

                        $delete_hinh = $this->input->post('delete_hinhanh');
                        if ($delete_hinh == 'true' || ($_FILES['userfile']['size'] > 0)) {
                            if ($hinh_anh != '') {
                                $hinh_anh = UPLOAD_PATH . $hinh_anh;
                                //xoa hinh
                                if (file_exists($hinh_anh)) {
                                    unlink($hinh_anh);
                                    // echo 'OK' .$hinh_anh;exit();
                                }
                                $hinh_anh = ''; //xoa khong duoc cung cho link bang rong
                            }
                        }

                        //kieu tra upfile kog
                        if ($_FILES['userfile']['size'] > 0) {

                            $config['upload_path'] = UPLOAD_PATH;
                            $config['allowed_types'] = 'gif|jpg|jpeg|png';
                            $config['max_size'] = '20000';
                            $config['max_width'] = '2000';
                            $config['max_height'] = '1000';
                            $config['encrypt_name'] = true;

                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('userfile')) {
                                $data['message']['error_upload'] = $this->upload->display_errors();
                                var_dump($data['message']);
                                exit();
                            } else {
                                $data_upload = array('upload_data' => $this->upload->data());
                                $hinh_anh = $data_upload['upload_data']['file_name'];
                                //var_dump($data_upload);exit();
                            }
                        }

                        $data_user_login = $this->session->userdata('data_login');
                        $in_data = array(
                            'title' => $this->input->post('title'),
                            'account_id' => $data_user_login['id'],
                            'alias' => $alias_to,
                            'hinh_anh' => $hinh_anh,
                            'category_id' => $this->input->post('category'),
                            'mieu_ta' => $this->input->post('mieu_ta'),
                            'content' => $this->input->post('content'),
                            'modify_time' => $date,
                        );
                        $this->load->model('Post_model');
                        $this->Post_model->update_post($id, $in_data); //update database
                        redirect('admin/post/index');
                    }
                } else {
                    //load du lieu id
                    $this->load->model('Post_model');
                    $data['result_id'] = $this->Post_model->Result_id($id);
                    if ($data['result_id'] == NULL) {
                        $data['message']['error'] = 'No have ID ';
                    }
                    //set url hinh_anh
                    if ($data['result_id']['0']['hinh_anh'] != '') {
                        $data['result_id']['0']['hinh_anh'] = base_url('upload') . '/' . $data['result_id']['0']['hinh_anh'];
                    }

                    $this->load->model('Category_model');
                    $data_session = $this->session->userdata('id');
                    $data['result_id']['category_info'] = $this->Category_model->show_category($data_session['id']);

                    //var_dump($data['result_id']);exit();
                }
            } else {
                $data['message']['error'] = 'No id for edit ';
            }
        }


        $this->breadcrumbs->push($this->lang->line('home'), '/account/home');
        $this->breadcrumbs->push($this->lang->line('post_edit_breadcrum'), '/admin/post/edit_post');


        $this->load->view('layout_back_end_view', $data);
    }

    public function delete($id = NULL)
    {
        $data = array();
        $isValid = TRUE;

        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for /post/index';
            $isValid = FALSE;
        }
        if ($id != NULL && $isValid) {
            $data_session = $this->session->userdata('data_login');
            $this->load->model('Post_model');
            $result = $this->Post_model->delete($id, $data_session['id']);
            if ($result) {
                // echo 'da xoa';
                redirect('admin/post/index');
            } else {
                echo 'Have error when delete database';
            }
        } else {
            echo 'No have id for delete input';
        }
    }

    public function post_by_category($category_id = NULL)
    {
        $data = array();
        $data['content'] = 'back_end/post_manager_view';
        $isValid = TRUE;

        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for post by category';
            $isValid = FALSE;
        }
        if ($isValid) {
            $this->load->model('Post_model');
            $data_session = $this->session->userdata('data_login');
            $data['ketqua'] = $this->Post_model->get_from_category($category_id, $data_session['id']);
            $data['ketqua']['category_search'] = $category_id;
        }

        $this->load->view('layout_back_end_view', $data);
    }

    public function search_post()
    {
        $data = array();
        $data['content'] = 'back_end/post_manager_view';
        $isValid = TRUE;

        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
            $data['message'] = 'No have permission for post by category';
            $isValid = FALSE;
        }
        if ($isValid) {
            
            $keysearch = $this->input->post('keysearch');
            $category_id = $this->input->post('category_id');
            //exe\
            $data_session = $this->session->userdata('data_login');
            $this->load->model('Post_model');
            $data['ketqua'] = $this->Post_model->search_posts($keysearch, $category_id,$data_session['id']);
            $data['ketqua']['category_search'] = $category_id;
            $data['ketqua']['keysearch'] = $keysearch;
        }

        $this->load->view('layout_back_end_view', $data);
    }

}
