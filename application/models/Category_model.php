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
class Category_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show category index by account_id
     * @param type $id
     * @return type
     */
    public function index($id)
    {
        $this->db->select('id,title,description,account_id,create_time,modify_time');
        $this->db->where('category.account_id',$id);
        $query = $this->db->get('category');
        $out_put = $query->result_array();
        return $out_put;
    }
    /**
     * show all category
     * @return type
     */
    public function index_all()
    {
        $this->db->select('id,title,description,account_id,create_time,modify_time');
        $query = $this->db->get('category');
        $out_put = $query->result_array();
        return $out_put;
    }

    public function new_post($in_data)
    {
        $this->db->insert('category', $in_data);
        return TRUE;
    }

    public function update_post($id, $in_data,$account_id)
    {
        $this->db->where('id', $id);
        $this->db->where('account_id', $account_id);
        $this->db->update('category', $in_data);
        return TRUE;
    }

    public function delete($id,$account_id)
    {
        //khi xoa category thi xoa post?? hay co 1 category default -> luon
        $this->db->where('id', $id);
        $this->db->where('account_id', $account_id);
        $this->db->delete('category');
        return true;
    }
    
    //chac chua can thiet lam
    public function Result_id($id,$account_id)
    {
        //show id data
        $this->db->select('id, title, alias, description');
        $this->db->where('id', $id);
        $this->db->where('account_id', $account_id);
        
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            $out_put = $query->result_array();
            return $out_put;
        } else {
            return NULL;
        }
    }
    
    public function show_category($account_id){
        $this->db->select('id, title');    
        $this->db->where('account_id',$account_id);    
        $query = $this->db->get('category');
        if ($query->num_rows()>0) {
            return $query->result_array();
        }
        
    }

}
