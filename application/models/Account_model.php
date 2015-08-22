<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account_mode
 *
 * @author JTec
 */
class Account_model extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function Load_user($id)
    {
        $this->db->select('fullname, username');
        $this->db->where('id', $id);
        $query = $this->db->get('account');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }

    public function Update_info($id, $data)
    {
        //update thong tin
        $this->db->where('id', $id);
        $this->db->update('account', $data);

        //load thong tin sau khi update danh cho session
        $this->db->select('id, fullname, role, username');
        $this->db->where('id', $id);
        $query = $this->db->get('account');
        $result_value = $query->row_array();

        $data_value = array(
            //'id' => $result_value->id, //lay ra la 1 doi tuong $query->row();
            'id' => $result_value['id'],
            'username' => $result_value['username'],
            'fullname' => $result_value['fullname'],
            'role' => $result_value['role'],
        );

        return $data_value;
    }

    public function Update_pass($id, $pass_new)
    {
        $this->db->where('id', $id);
        $this->db->update('account', array('password' => $pass_new));
        return TRUE;
    }

    public function check_pass($id, $pass_old)
    {
        $this->db->select('id');
        $this->db->where('id', $id);
        $this->db->where('password', $pass_old);
        $query = $this->db->get('account');
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function forgot_pass_model($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('account');
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function is_email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('account');
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function update_pass_email($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->update('account', array('password' => $password));
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function register($data)
    {
        $this->db->insert('account', $data);
        return TRUE;
    }

    public function check_username($username)
    {
        $this->db->select('id');
        $this->db->where('username', $username);
        $query = $this->db->get('account');
       //echo $query->num_rows(); exit();
        if ($query->num_rows() > 0) {
            return FALSE;
        }
        return TRUE;
    }

    public function check_email($email)
    {
        $this->db->select('id');
        $this->db->where('email', $email);
        $query = $this->db->get('account');
        if ($query->num_rows() > 0) {
            return FALSE;
        }
        return TRUE;
    }

}
