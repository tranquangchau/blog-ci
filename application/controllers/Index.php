<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        //$this->load->model('Front_index_model');
        $data_session = $this->session->userdata('data_login');
        $this->load->model('Front_index_model');
        $data['result'] = $this->Front_index_model->index($data_session['id']);

        //set url hinh_anh
//        if ($data['result']['0']['hinh_anh'] != '') {
//            $data['result']['0']['hinh_anh'] = base_url('upload') . '/' . $data['result']['0']['hinh_anh'];
//        }
        //var_dump($data); exit();

        $this->breadcrumbs->push('Home', '/');

        $data['content'] = 'front_end/index_front_view';
        $this->load->view('layout_front_end_view', $data);
    }

}
