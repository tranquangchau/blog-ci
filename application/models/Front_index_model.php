<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Front_index_model
 *
 * @author JTec
 */
class Front_index_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function index($account_id)
    {
//        $this->db->select('id,title,alias,hinh_anh,mieu_ta,create_time,account_id');
//        $this->db->order_by("create_time", "desc");
//        $this->db->join('comment','comment.post_id = post.id');
//        $query = $this->db->get('post');
//        if ($query->num_rows() > 0) {
//            $resul_data = $query->result_array();
//            var_dump($resul_data);
//        }  else {
//            return NULL;
//        }
//        return $resul_data;
        //$resul_data= $query->row_array();
        //$this->db->select('id,title,alias,hinh_anh,mieu_ta,create_time,account_id');
        //$this->db->order_by("create_time", "desc");

        $this->db->select('*,post.id as p_id,account.id as a_id');
        $this->db->where('post.account_id',$account_id);
        $this->db->order_by("create_time", "desc");
        
        $this->db->from('post');
        //$this->db->join('comment','comment.post_id = post.id');
        $this->db->join('account', 'account.id = post.account_id');
        $query = $this->db->get();

        //$query = $this->db->get('post');
        //$data_result = $query->result_array();
        //var_dump($data_result);exit();

        if ($query->num_rows() > 0) {
            $resul_data = $query->result_array();
            return $resul_data;
        } else {
            return NULL;
        }
    }

}
