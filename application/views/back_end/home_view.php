<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$data = $this->session->userdata('data_login');

//$this->lang->load('content_back');
?>

<div class="container">
    <div class="row container">
        <h1> <?= $this->lang->line('home_name') ?><small> <?= $this->lang->line('home_name_small') ?></small></h1>
        <hr>
    </div>
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
    <div class="container">

        <div class="row">
            <div class="row">
                <div class="col-md-7">
                    <div class="well bg-danger">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://bootswatch.com/assets/img/shopify.png" class="img-circle" height="90px" width="90px">
                                </div>
                                <div class="col-md-7">

                                    <h3><?= $this->lang->line('home_fullname') ?>: <?php echo $data['fullname']; ?></h3>
                                    <p><?= $this->lang->line('home_username') ?> <?php echo $data['username']; ?> </p>
                                    <p>
                                        <?php if (isset($message)): ?>
                                            <?= $message ?>
                                        <?php endif; ?>
                                    </p>
                                    <a href="#"><?= $this->lang->line('home_more') ?></a>
                                </div>
                                <div class="col-md-3">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info">Action</a>
                                        <a href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Show More Infor</a></li>
                                            <li><a href="#">Logout</a></li>                                    
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </div>
</div>
