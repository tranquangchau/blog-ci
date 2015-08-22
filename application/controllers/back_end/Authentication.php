<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Authentication
 *
 * @author JTec
 */
class Authentication extends My_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('content_back');
        $this->load->model('Account_model', 'am', TRUE);
    }

    public function index()
    {
        echo '1234';
        //$this->login();
    }

    public function login()
    {
        $data = array();
        $isValid = TRUE;

        if ($this->session->has_userdata('data_login')) {
            $data_user = $this->session->userdata('data_login');
            $value_url = $this->find_url_session();

            if (!isset($value_url['url_' . $data_user['id']])) {
                redirect('account/home');
            }
            //if ($this->session->has_userdata('data_login')) {                
            redirect($value_url['url_' . $data_user['id']]);
            //}
        }

        if ($this->input->post()) {
            if ($this->input->post('username') == '') {
                $data['message']['error_username'] = 'Input Error Username';
                $isValid = FALSE;
            }

            if ($this->input->post('password') == '') {
                $data['message']['error_password'] = 'Input Error Password';
                $isValid = FALSE;
            }

            if ($isValid) {
                $this->load->model('Login_model');
                $data = $this->Login_model->check_login($this->input->post('username'), $this->input->post('password'));
                if ($data == NULL) {
                    $data['message']['error'] = 'Error Login Username or Password Check';
                    $isValid = FALSE;
                }
            }

            if ($isValid) {
                $this->session->set_userdata('data_login', $data);
                $data_user = $this->session->userdata('data_login');
                $value_url = $this->find_url_session();

                if (!isset($value_url['url_' . $data_user['id']])) {
                    if ($data_user['role'] != 1) {
                        //echo 'Kog du quyen'; exit();
                        redirect('/account/home');
                    } else {
                        redirect('account/home');
                    }
                    //var_dump($value_url);
                    //exit();
                } else {
                    redirect($value_url['url_' . $data_user['id']]);
//                    var_dump ($value_url);
//                    exit();
                    //return;
                }
            }
        }

        $this->breadcrumbs->push($this->lang->line('home'), '/home');
        $this->breadcrumbs->push($this->lang->line('login_breadcrum'), '/login');

        $data['content'] = 'back_end/login_view';
        $this->load->view('layout_back_end_view', $data);
    }

    public function home()
    {
        $data = array();
        //khai bao back_end/home_view truoc tien
        $data['content'] = 'back_end/home_view';

        //khong cho truy cap, hien thi gui user
        $check_result = $this->check_data_login();
        if ($check_result == 'role_user') {
            $data['content'] = 'back_end/code_head/401_view';
        }
        $this->breadcrumbs->push($this->lang->line('home_breadcrum'), '/account/home');

        $this->load->view('layout_back_end_view', $data);
    }

    public function logout()
    {
        $data_user = $this->session->userdata('data_login');

//        $url_save = array('url_' . $data_user['id'] => current_url());
//        $this->session->set_userdata('url_save', $url_save);
        //var_dump($this->session->userdata('url_save'));
        //$this->session->sess_destroy();
        $this->session->unset_userdata('data_login');
        redirect('login');
    }

    /**
     * 
     * @return boolean
     */
    private function find_url_session()
    {
        if ($this->session->has_userdata('url_save')) {
            $data = $this->session->userdata('url_save');
            return ($data);
        } else {
            return NULL;
        }
    }

    /**
     * send email and password
     */
    public function forgot_password()
    {
        $data = array();
        $isValid = TRUE;
        
        if ($this->input->post()) { //Input validation
            $email = $this->input->post('email');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $isValid = FALSE;
                $data['message']['error'] = 'Not is address email';
            }
            if ($isValid && !($isValid = $this->am->is_email_exists($email))) { //Email validation
                $data['message']['error'] = 'Email not exists';
            }
            if ($isValid) { //Generate new password and send
                $pass_new = $this->generate_random_password();
                $this->am->update_pass_email($email, $pass_new);
                $this->lang->load('forgot_password_mail');
                $result_sendmail = $this->send_email_for_new_password($email, $pass_new, $this->lang->line('forgot_password_email_content'));
                $data['message']['sucess'] = 'Send Mail is: '.$result_sendmail;                
            }
        }
        $this->push_breadcrumbs([
            $this->lang->line('home') => '/account/home',
            $this->lang->line('forgot_p_breadcrum') => '/forget_password'
        ]);
        $data['content'] = 'back_end/forgot_pass_view';
        $this->load->view('layout_back_end_view', $data);
    }

    /**
     * 
     * @param type $value Array key is Title, value is URL
     */
    private function push_breadcrumbs($value)
    {
        foreach ($value as $title => $url) {
            $this->breadcrumbs->push($title, $url);
        }
    }

    /**
     * 
     * @param type $to
     * @param type $new_password
     * @param type $message_pattern
     * @return boolean
     */
    private function send_email_for_new_password($to, $new_password, $message_pattern)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'test.email.chau@gmail.com',
            'smtp_pass' => '****',
            'mailtype' => 'html',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('test.email.chau@gmail.com');
        $this->email->to($to);
        $this->email->subject('test_subject from localhost/blog');
        $message = sprintf($message_pattern, $new_password);
        $this->email->message($message);

        if ($this->email->send()) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 
     * @return type
     */
    public function generate_random_password()
    {
        $this->load->helper('string');
        return random_string('alnum', 8);
    }

    public function register()
    {
        $data = array();
        $isValid = TRUE;

        //chekc is old login
        if ($this->session->has_userdata('data_login')) {
            $data_user = $this->session->userdata('data_login');
            $value_url = $this->find_url_session();

            if (!isset($value_url['url_' . $data_user['id']])) {
                redirect('account/home');
            }
            //if ($this->session->has_userdata('data_login')) {                
            redirect($value_url['url_' . $data_user['id']]);
            //}
        }

        if ($this->input->post()) {

            $user = $this->input->post('user');
            $fullname = $this->input->post('fullname');
            $email = $this->input->post('email');
            $pass = $this->input->post('pass');
            $repass = $this->input->post('repass');

            if ($user == '') {
                $data['message_user'] = 'Input Error Username';
                $isValid = FALSE;
            }

            if ($pass == '') {
                $data['message_pass'] = 'Input Error Password';
                $isValid = FALSE;
            }
            if ($repass == '' or ( $pass != $repass)) {
                $data['message_repass'] = 'Input Error Re* Password';
                $isValid = FALSE;
            }

            if ($fullname == '') {
                $data['message_fullname'] = 'Input Error Fullname';
                $isValid = FALSE;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $isValid = FALSE;
                $data['message_email'] = 'Not is address email';
            }
            $this->load->model('Account_model', 'lm', TRUE);

            //check account exit
            $result_check1 = $this->lm->check_username($user);
            if (!$result_check1) {
                $data['message_user'] = 'Error: Exit Username Check';
                $isValid = FALSE;
            }

            //check email exit
            $result_check2 = $this->lm->check_email($email);
            if (!$result_check2) {
                $data['message_email'] = 'Error: Exit Email Check';
                $isValid = FALSE;
            }

            //register
            if ($isValid) {
                $in_data = array(
                    'username' => $user,
                    'fullname' => $fullname,
                    'email' => $email,
                    'role' => 0,
                    'password' => $pass,
                );
                $this->lm->register($in_data);

                //send mail
                $subject = 'Welcome ' . $fullname . 'To Website';
                $message = '<h2> Sucess Rigister<h2> Username:' . $user;
                $_a = $this->blog_send_email($email, $subject, $message);


                //redirect('/login');
                $data['message']['error'] = 'Success: Create User Status send mail: ' . $_a;
            }
        }

        $this->breadcrumbs->push($this->lang->line('home'), 'account/home');
        $this->breadcrumbs->push($this->lang->line('register_breadcrum'), '/register');

        $data['content'] = 'back_end/register_view';
        $this->load->view('layout_back_end_view', $data);
    }        

}
