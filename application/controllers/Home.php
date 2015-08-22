<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Authentication
 *
 * @author JTec
 */
class Home extends My_Controller
{

    public function index()
    {
        redirect('index');
    }

    public function not_page()
    {
        echo '<h1>404</h1>';
        echo 'The page cannot be found1 <br>';
        exit();
    }

    public function no_role()
    {
        $data = array();
        http_response_code(401);
        //echo $a = '<h1>401 pager</h1> No Role<br>';
        $data['content'] = 'back_end/code_head/401_view';
        $this->load->view('layout_back_end_view', $data);
    }

}
