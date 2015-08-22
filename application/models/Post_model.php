<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of post_model
 *
 * @author JTec
 */
class Post_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Manager by 1 account
     * @return type
     */
    public function manager($id)
    {
        $this->db->select('post.id,post.title,post.category_id,post.create_time,post.modify_time,post.account_id,'
                . 'category.id as ct_id, category.title as ct_title');
        $this->db->order_by('create_time', "desc");
        $this->db->where('post.account_id',$id);
        $this->db->join('category', 'category.id = post.category_id');
        $query = $this->db->get('post');
        $out_put['post'] = $query->result_array();

        $this->db->select('id, title');
        $this->db->where('account_id',$id);
        $query1 = $this->db->get('category');
        $out_put['category'] = $query1->result_array();

        return $out_put;
    }
    
    /**
     * Manager all post
     * @return type
     */
    public function manager_all_post()
    {
        $this->db->select('post.id,post.title,post.category_id,post.create_time,post.modify_time,post.account_id,'
                . 'category.id as ct_id, category.title as ct_title');
        $this->db->order_by('create_time', "desc");
        $this->db->join('category', 'category.id = post.category_id');
        $query = $this->db->get('post');
        $out_put['post'] = $query->result_array();

        $this->db->select('id, title');
        $query1 = $this->db->get('category');
        $out_put['category'] = $query1->result_array();

        return $out_put;
    }

    public function new_post($in_data)
    {
        //$kiemtra = $this->db->insert('post', $in_data);
        $this->db->insert('post', $in_data);
//        if ($kiemtra) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
        return TRUE;
        // // $this->db->set($in_data)->get_compiled_insert('post');
        // $query = $this->db->get();
        //var_dump($query);
        //exit();
    }

    public function update_post($id, $in_data,$account_id)
    {
        $this->db->where('id', $id);
        $this->db->where('account_id', $account_id);
        $this->db->update('post', $in_data);
        return TRUE;
    }

    public function delete_post($id_post)
    {
        //xoa luon comment
    }

    public function Result_id($id,$account_id)
    {
        //show id data
        $this->db->select('id, title, alias, hinh_anh, category_id, mieu_ta, content');
        $this->db->where('id', $id);
        $this->db->where('account_id', $account_id);
        $query = $this->db->get('post');
        if ($query->num_rows() > 0) {
            $out_put = $query->result_array();
            return $out_put;
        } else {
            return NULL;
        }
    }

    public function delete($id,$account_id)
    {
        //khi xoa post thi xoa comment luon
        $this->db->where('id', $id);
        $this->db->where('account_id', $account_id);
        $this->db->delete('post');
        return TRUE;
    }

    public function Show_post_by_account($account_id)
    {
        $this->db->select('post.id as p_id,post.title as p_title,post.category_id as p_category_id,post.create_time as p_create_time,post.modify_time as p_modify_time,'
                . 'category.id as c_id, category.title as c_title');
        $this->db->where('account_id', $account_id);
        $this->db->join('category', 'category.id=post.category_id');
        $query = $this->db->get('post');
        $output = $query->result_array();
        return $out_put;
    }

    public function get_from_category($category_id,$account_id)
    {
        $this->db->select('post.id,post.title,post.category_id,post.create_time,post.modify_time,post.account_id,'
                . 'category.id as ct_id, category.title as ct_title');
        if ($category_id != NULL) {
            $this->db->where('category_id', $category_id);
        }
        $this->db->join('category', 'category.id = post.category_id');
        $this->db->where('post.account_id',$account_id);
        $query = $this->db->get('post');
        if ($query->num_rows() > 0) {
            $out_put['post'] = $query->result_array();
        } else {
            //return NULL;
        }
        $this->db->select('id, title');
        $this->db->where('account_id',$account_id);
        $query1 = $this->db->get('category');
        $out_put['category'] = $query1->result_array();
        
        return $out_put;
    }

    /**
     * Search posts from database
     */
    public function search_posts($keywords, $category_id,$account_id)
    {
        //Get posts by Title and Description
        $this->db->select('post.id,post.title,post.category_id,post.create_time,post.modify_time,post.account_id,'
                . 'category.id as ct_id, category.title as ct_title');
        $this->db->or_like('post.title', $keywords);
        //$this->db->like('mieu_ta', $keywords);
        if ($category_id!=NULL) {
            $this->db->where('category_id', $category_id);
        }    
        $this->db->where('post.account_id',$account_id);
        $this->db->join('category', 'category.id = post.category_id');
        $query = $this->db->get('post');
        if ($query->num_rows() > 0) {
            $out_put['post'] = $query->result_array();
           
        } else {
            //return null;
        }
        
        $this->db->select('id, title');
        $this->db->where('account_id',$account_id);
        $query1 = $this->db->get('category');
        $out_put['category'] = $query1->result_array();
        return $out_put;
         return $data_result;
    }
    public function result_hinhanh($id){
        $this->db->select('hinh_anh');
        $this->db->where('id',$id);
        $query = $this->db->get('post');
        if ($query->num_rows()>0) {
            return $query->result_array();            
        }
        return '';
    }

}
