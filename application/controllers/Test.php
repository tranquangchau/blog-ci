<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author JTec
 */
class Test extends CI_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $_a = 'chau';
        $_b = 'quang';
        $format = 'There is a difference between %2$s and %1$s';
        $formatEn = 'Welcome %s, %d years old';
        $formatJp = '%2$d Welcome %1$s-san, %1$s';
        printf($formatEn, 'Binh', 22);
        echo"<br>";
        printf($formatJp, 'Binh', 22);
    }

    public function test_send()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'test.email.chau@gmail.com', // change it to yours
            'smtp_pass' => 'jtec1234', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $message = 'noi dung';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('test.email.chau@gmail.com'); // change it to yours
        $this->email->to('test.email.chau@gmail.com'); // change it to yours
        $this->email->subject('test_subject from localhost/blog');
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
    
    public function test_helpper()
    {
        $text = 'Buổi sáng n--s mặt-trời^&*()/*-_---+.#@ @ mọc darn shucks @ ---';
        echo $text . ' Thành <br>';

        $this->load->helper('text');
        $string = convert_accented_characters($text);
        echo url_title($string, '-', true);
    }
    public function test_html_input(){
        //xu ly nhap vao la ma html khong cho show ra html
        echo htmlspecialchars('<b>Wörmann</b>');  // Why isn't this working?
        echo '<b>Wörmann</b><br>';
        //xu ly cho phep luu dau cach
        echo nl2br("foo ist nicht\n bar");
    }

}
