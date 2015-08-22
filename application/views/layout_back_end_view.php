<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('header_view'); ?>
        <!--Load style back_end-->
        <link href="<?php echo base_url(); ?>/assets/css/back_end_style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!--Load menu back_end-->
        <?php $this->load->view('back_end/menu_view'); ?>
        <!--Load content back_end-->
            <?php
        if (isset($content)) {
            $this->load->view($content);
        } else
            $this->load->view('index_test_view');
        ?>
    </body>
    <footer>
        <?php $this->load->view('footer_view'); ?>
    </footer>
</html>