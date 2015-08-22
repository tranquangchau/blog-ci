<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_model
 *
 * @author JTec
 */
class Login_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 
     * @param type $username
     * @param type $password
     * @return type
     */
    public function check_login($username, $password)
    {
        $data_value = array();
        $this->db->select('id, username, fullname, role');
        $this->db->from('account');
        $this->db->where('username', $username);
        $this->db->where('password', ($password));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result_value = $query->row_array();
            $data_value = array(
                'id' => $result_value['id'],
                'username' => $result_value['username'],
                'fullname' => $result_value['fullname'],
                'role' => $result_value['role'],
            );
        } else {
            $data_value = NULL;
        }
        return $data_value;
    }        

}
