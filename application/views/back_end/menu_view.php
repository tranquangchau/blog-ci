<?php
//$this->lang->load('navigator');
$data_role = $this->session->userdata('data_login');
?>
<div class="navbar navbar-inverse navbar-fixed-top">

    <div class="container">
            <div class="navbar-header">
                <a href="<?php echo site_url(); ?>" class="navbar-brand">Blog Home</a>

                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>        
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav navbar-right">                
                    <?php if ($data_role['role'] == 1): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Category<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('/admin/category/index'); ?>">Manager</a></li>
                                <li><a href="<?php echo site_url('/admin/category/new_category'); ?>">New</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Post<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('/admin/post/index'); ?>">Manager</a></li>
                                <li><a href="<?php echo site_url('/admin/post/new_post'); ?>">New</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->session->has_userdata('data_login')): ?>
                        <?php $data = $this->session->userdata('data_login'); ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Welcome <?= $data['fullname']; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('/account/home'); ?>">Full Name</a></li>
                                <li><a href="<?php echo site_url('/account/update_info'); ?>">Update infor</a></li>
                                <li><a href="<?php echo site_url('/account/change_password'); ?>">Change Password</a></li>
                                <li><a href="<?php echo site_url('/account/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>

                        <li><a href="<?php echo site_url('/login'); ?>" class="active">Login</a></li>
                        <?php endif; ?>
                </ul>
            </div>
    </div>
</div>
