<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('header_view'); ?>
    </head>
    <body>
        <?php
            if(isset($content)){
                $this->load->view($content);
            }else
                $this->load->view('index_test_view');
        ?>
    </body>
    <footer>
        <?php $this->load->view('footer_view'); ?>
    </footer>
</html>