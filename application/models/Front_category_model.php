<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Front_category_model
 *
 * @author JTec
 */
class Front_category_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function show_category($name, $account_id)
    {

        $this->db->select('*,'
                . 'post.id as p_id, post.title as p_titile, post.alias as p_alias,'
                . 'account.id as a_id,'
                . 'category.title as ct_title, category.alias as ct_alias');
        $this->db->where('category.id', $name); //chua check alias
        $this->db->where('account.id', $account_id); //chua check alias
        $this->db->order_by('post.create_time', "desc");
        $this->db->from('post');
        $this->db->join('account', 'account.id = post.account_id');
        $this->db->join('category', 'category.id = post.category_id');
        $query = $this->db->get();

        //$query = $this->db->get('post');
        $data_result = $query->result_array();
        //var_dump($data_result);exit();

        if ($query->num_rows() > 0) {
            $resul_data = $query->result_array();
            //var_dump($resul_data);
            
        } else {
            $this->db->select('*,'
                    . 'post.id as p_id, post.title as p_titile, post.alias as p_alias,'
                    . 'account.id as a_id,'
                    . 'category.title as ct_title, category.alias as ct_alias');
            $this->db->where('category.alias', $name); //chua check alias
            $this->db->where('account.id', $account_id); //chua check alias
            $this->db->order_by('post.create_time', "desc");
            $this->db->from('post');
            $this->db->join('account', 'account.id = post.account_id');
            $this->db->join('category', 'category.id = post.category_id');
            $query = $this->db->get();
            $data_result = $query->result_array();
            //var_dump($data_result);exit();
            if ($query->num_rows() > 0) {
                $resul_data = $query->result_array();
                //var_dump($resul_data);                
            } else {
                return NULL;
            }
        }
        return $resul_data;
    }

}
