<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Controller
 *
 * @author JTec
 */
class My_Controller extends CI_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function test_1()
    {
        return '2';
    }

    /**
     * 
     * @return string
     * 
     */
    public function check_data_login()
    {
        if ($this->session->has_userdata('data_login')) {
            $data = $this->session->userdata('data_login');
            //var_dump($data);exit();
            if (isset($data['role'])) {
                if ($data['role'] != 1) {
                    //echo 'Kog du quyen'; exit();
                    //redirect('401');
                    return 'role_user';
                }
            } else {
                echo 'Data session No have role';
                exit();
            }
        } else {
            redirect('back_end/Authentication/login');
        }
    }

    //user
//    $check_result = $this->check_data_login();
//        if ($check_result == 'role_user') {
//            $data['content'] = 'back_end/code_head/401_view';
//            $data['message'] = 'home error';
//        }


//    public function check_is_login()
//    {
//        if (!$this->session->has_userdata('data_login')) {
//            redirect('back_end/Authentication/login');
//        }
//    }

    public function blog_send_email($to, $subject, $message)
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
        $this->email->subject($subject);
        $this->email->message($message);
        //$this->email->send();

        if ($this->email->send()) {
            return TRUE;
        }
        return FALSE;
    }

}
