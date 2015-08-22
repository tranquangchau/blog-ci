<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Front_post_model
 *
 * @author JTec
 */
class Front_post_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo 'Welcome to Front_post_model';
    }

    public function show_post($id = NULL)
    {
        //show data vs $id
        //$this->db->select('id, title, account_id, content,hinh_anh, mieu_ta');
        $this->db->select('category.title as ct_title, category.alias as ct_alias, category.description as ct_description,'
                . 'account.fullname as ac_fullname, account.role as ac_role, account.username as ac_username ,'
                . ' post.id, post.alias, post.title,post.content,post.mieu_ta,post.hinh_anh, post.create_time');
        $this->db->from('post');
        $this->db->where('post.id', $id);
        $this->db->join('account','account.id=post.account_id');
        $this->db->join('category','category.id=post.category_id');
        $query = $this->db->get('');
        if ($query->num_rows() > 0) {
            $data_result = $query->row_array();
            $data_result['comment'] = $this->show_comment_post($data_result['id']);
        } else {
            //show data vs $alias
            $this->db->select('category.title as ct_title, category.alias as ct_alias, category.description as ct_description,'
                . 'account.fullname as ac_fullname, account.role as ac_role , account.username as ac_username,'
                . ' post.id, post.alias, post.title,post.content,post.mieu_ta,post.hinh_anh, post.create_time');
            $this->db->from('post');
            $this->db->where('post.alias', $id);
            $this->db->join('account','account.id=post.account_id');
            $this->db->join('category','category.id=post.category_id');
            $query = $this->db->get('');
            if ($query->num_rows() > 0) {
                $data_result = $query->row_array();
                $data_result['comment'] = $this->show_comment_post($data_result['id']);
            } else {
                return NULL;
            }
        }
        
        //var_dump($data_result);exit;
        return $data_result;
    }

    public function show_comment_post($post_id)
    {
        $this->db->select('id, ,account_id,content,create_time,post_id');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('comment');
        if ($query->num_rows() > 0) {
            $out_put = $query->result_array();
            return $out_put;
        } else {
            return NULL;
        }
    }

    public function new_comment($data)
    {
        $this->db->insert('comment', $data);
        return TRUE;
    }
    
    public function search_post($key_search){
        $this->db->select('id, title, alias, mieu_ta, hinh_anh, create_time');
        $this->db->like('mieu_ta', $key_search);
        $query = $this->db->get('post');
        if ($query->num_rows()>0) {
            $data_result= $query->result_array();            
        }else
        {
            return NULL;
        }
        return $data_result;
    }

}
