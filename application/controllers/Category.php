<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author JTec
 */
class Category extends CI_Controller
{

    private $data_session;

//    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->data_session = $this->session->userdata('data_login');
        //var_dump($data_session);
    }

    public function index($name = NULL)
    {
      
        //print $this->data_session(); exit();
        //var_dump($this->data_session['id']);exit();
        if ($name != NULL) {
            $data = array();
//            var_dump($this->data_session);
//            exit();

            $this->load->model('Front_category_model');
            $data_result = $this->Front_category_model->show_category($name, $this->data_session['id'] );
            if ($data_result != NULL) {
                $data['result'] = $data_result;
                //set breadcrumbs
                $this->breadcrumbs->push('Home', '/index');
                $this->breadcrumbs->push($data['result']['0']['ct_title'], '/category/index/' . $data['result']['0']['ct_alias']);
            } else {
                $data['message'] = 'No have post or no category';
            }
        } else {
            //echo 'No have category select';
            $data['message'] = 'No have category select';
        }


        $data['content'] = 'front_end/category_view';
        $this->load->view('layout_front_end_view', $data);
    }

    public function home()
    {
//        echo"--home";
    }

}
