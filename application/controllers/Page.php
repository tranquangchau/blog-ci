<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of page
 *
 * @author JTec
 */
class Page extends CI_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //method get
    public function index($account_id = NULL)
    {
        echo 'Xem all post cua Userid: ' . $account_id;
    }

    //method get
    public function post($account_id = NULL, $post_id = NULL)
    {
        echo 'với tài khoản cua Userid: ' . $account_id . ' xem bài post: ' . $post_id;
    }

    //method post 
    public function post_comment($account_id = NULL, $post_id = NULL)
    {
        echo 'comment post: ' . $post_id . ' cua Userid: ' . $account_id;
    }

    //method get
    public function search($account_id = NULL, $key_work = NULL)
    {
        echo 'tim kiem bai post cua Useid: ' . $account_id . ' voi key_work ' . $key_work;
    }

    //method get
    public function category($account_id = NULL, $category_id = NULL)
    {
        echo 'xem cac bai post co category la: ' . $category_id . ' cua Userid: ' . $account_id;
    }

    //method get
    public function list_personal()
    {
        echo 'Xem danh sach Userid da post bai';
    }

}
