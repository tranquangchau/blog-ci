<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class post extends CI_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function index($alias = NULL)
    {
        echo $alias.' Echo Heelo';
//        $data = array();
//        $data['content'] = 'front_end/post_front_view';
//        $this->load->view('layout_front_end_view', $data);
//        $data = array();
//        $this->load->model(Front_index);
//        $data['result']= $this->Front_index->index();
//        var_dump($data);
//        $data['content'] = 'front_end/post_front_view';
//        $this->load->view('layout_front_end_view', $data);
    }

    public function view($id = NULL)
    {
        $data = array();
        if ($id != NULL) {
            //xu ly luu comment
            if ($this->input->post('comment') != NULL && $this->input->post('post_id') != NULL) {

                $data = $this->session->userdata('data_login');

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = date('Y-m-d H:i:s');
                $data = array(
                    'account_id' => $data['id'],
                    'content' => $this->input->post('comment'),
                    'create_time' => $date,
                    'post_id' => $this->input->post('post_id'),
                );
                $this->load->model('Front_post_model');
                $check_result = $this->Front_post_model->new_comment($data);
                if ($check_result) {
                    
                } else {
                    $data['message'] = 'cannot comment';
                }
            } else {
                //khong xu ly nut luu
            }
            //load bai viet
            $this->load->model('Front_post_model');
            $ketqua = $this->Front_post_model->show_post($id);
            if ($ketqua != NULL) {
                $data['ketqua'] = $ketqua;
                //load breadcrum
                $this->breadcrumbs->push('Home', '/index');
                $this->breadcrumbs->push('Category ' . $data['ketqua']['ct_title'], '/category/index/' . $data['ketqua']['ct_alias']);
                $this->breadcrumbs->push($data['ketqua']['title'], '/a');
            } else {
                $data['message'] = 'Khong co bai viet';
            }
        } else {
            $data['message'] = 'Nhap bai post rong';
        }

        $data['content'] = "front_end/post_front_view";
        $this->load->view('layout_front_end_view', $data);
    }

    public function search()
    {
        $data = array();
        $key_search = $this->input->get('key_search');
        if ($key_search != NULL) {
            $this->load->model('Front_post_model');
            $data_search = $this->Front_post_model->search_post($key_search);
            if ($data_search != NULL) {
                $data['result'] = $data_search;
            } else {
                //echo 'Data: No have value for search';
                $data['message'] = 'Data: No have value for search';
            }
        } else {
            $data['message'] = 'Input: No have key search';
        }
        $data['content'] = 'front_end/search_view';
        $this->load->view('layout_front_end_view', $data);
    }

}
