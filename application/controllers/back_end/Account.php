<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author JTec
 */
class Account extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('content_back');
        $this->check_data_login();
    }

    /**
     * Show view for user login -no post,new,edit can commemt + 
     * menu no have user for edit,create post,category
     */
    public function home()
    {
        $data = array();
        $data['content'] = 'back_end/home_view';

//        if (!$this->session->has_userdata('data_login')) {
//            redirect('back_end/Authentication/login');
//        }
        
//        $check_result = $this->check_data_login();
//        if ($check_result == 'role_user') {
//            $data['content'] = 'back_end/code_head/401_view';
//            $data['message'] = 'home error';
//        }

        $this->breadcrumbs->push($this->lang->line('home_breadcrum'), '/account/home');
        $this->load->view('layout_back_end_view', $data);
    }

    public function update_info()
    {
        $data = array();
        $session_data = $this->session->userdata('data_login');
        $id = $session_data['id'];

        if ($this->input->post() != NULL) {
            if ($this->input->post('fullname') != NULL) {
                $data = array('fullname' => $this->input->post('fullname'));
                $this->load->model('Account_model');
                $result_m = $this->Account_model->Update_info($id, $data);
                //var_dump($result_m);exit();
                if ($result_m != NULL) {
                    //update session
                    $this->session->set_userdata('data_login', $result_m);
                    //var_dump($result_m);exit();
                    redirect('account/home');
                    return;
                } else {
                    echo 'Update error in Data';
                    exit();
                }
            } else {
                $this->load->model('Account_model');
                $result_m = $this->Account_model->Load_user($id);
                if ($result_m != NULL) {
                    $data['ketqua'] = $result_m;
                } else {
                    echo 'Update error';
                    exit();
                }
                $data['message'] = 'Input is empty';
            }
        } else {
            //load user view
            $this->load->model('Account_model');
            $result_m = $this->Account_model->Load_user($id);
            if ($result_m != NULL) {
                $data['ketqua'] = $result_m;
            } else {
                echo 'Update error';
                exit();
            }
        }
        $this->breadcrumbs->push($this->lang->line('home'), '/acount/home');
        $this->breadcrumbs->push($this->lang->line('update_user_breadcrum'), '/account/update_info');

        $data['content'] = 'back_end/Account_update_info_view';
        $this->load->view('layout_back_end_view', $data);
    }

    /**
     * return all message if have error 'not much + error pass old'
     * @return type
     */
    public function change_password()
    {
        $data = array();
        if ($this->input->method() == 'post') {

            if ($this->input->post('pass_new') != NULL) {
                
            } else {
                $data['message_pass_new'] = 'The password old you entered is null.';
            }
            if ($this->input->post('pass_old') != NULL) {
                
            } else {
                $data['message_pass_old'] = 'The password re you entered is null.';
            }
            if ($this->input->post('pass_re') != NULL) {
                
            } else {
                $data['message_pass_re'] = 'The password re you entered is null.';
            }

            if ($this->input->post() != NULL) {
                $check_pass_same = FALSE; //kiem tra mat khau co trung nhau khong
                $check_pass_old = FALSE; //kiem tra mat khau cu co dung khong
                //save change pass action
                if ($this->input->post('pass_new') == $this->input->post('pass_re')) {
                    $check_pass_same = TRUE;
                } else {
                    $data['message_pass_re'] = 'Error Input pass new != pass re';
                }
                $pass_old = $this->input->post('pass_old');
                $pass_new = $this->input->post('pass_new');

                $data_session = $this->session->userdata('data_login');
                $id = $data_session['id'];

                //check pass old exit()
                $this->load->model('Account_model');
                $check_pass_result = $this->Account_model->check_pass($id, $pass_old);
                if ($check_pass_result != FALSE) {
                    $check_pass_old = TRUE;
                } else {
                    $data['message_pass_old'] = 'The password you entered is incorrect.';
                }
                if ($check_pass_old && $check_pass_same) { //neu mat khau trung nhau va mat khau cu dung thi new mat khau moi
                    $this->load->model('Account_model');
                    $result_m = $this->Account_model->Update_pass($id, $pass_new);
                    redirect('account/home');
                    return;
                }
            } else {
                //load view o duoi
            }
        }

        $this->breadcrumbs->push($this->lang->line('home'), '/account/home');
        $this->breadcrumbs->push($this->lang->line('change_pass_breadcrum'), '/account/change_password');

        $data['content'] = 'back_end/Account_change_pass_view';
        $this->load->view('layout_back_end_view', $data);
    }

}
