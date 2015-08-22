<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <div class="row container">
        <h1><?= $this->lang->line('login_form_name') ?> <small><?= $this->lang->line('login_welcome'); ?></small></h1>
        <hr>
    </div>
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class='col-lg-3'></div>
        <div class='col-lg-6'>
            <div class='panel panel-warning'>
                <div class='panel-heading'>
                    <div class='container-fluid'>
                        <div class="row">
                            <div class='col-lg-6'><span style="font-size:18px;"><?= $this->lang->line('login_form_name') ?></span></div>
                            <div class='col-lg-6 text-right'>
                                <sub style="font-size: 12px;"><a href='<?= site_url('back_end/authentication/forgot_password') ?>'><?= $this->lang->line('login_form_forgot_pass') ?></a></sub>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='panel-body'>
                    <form method="POST">
                        <?php if (isset($message['error'])) : ?>
                            <p class="text-danger"><?php echo $message['error']; ?></p>
                        <?php endif; ?>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </span>
                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('login_form_username') ?>" aria-describedby="basic-addon1" name="username">
                            <br>

                            <?php if (isset($message['error_username'])) : ?>
                                <p class="text-danger"><?php echo $message['error_username']; ?></p>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                <span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
                            </span>
                            <input type="text" class="form-control" placeholder="<?= $this->lang->line('login_form_password') ?>" aria-describedby="basic-addon1" name="password">
                            <?php if (isset($message['error_password'])) : ?>
                                <p class="text-danger"><?php echo $message['error_password']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="checkbox">
                            <br>
                            <label>
                                <input type="checkbox"> <?= $this->lang->line('login_form_remember') ?>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-success"><?= $this->lang->line('login_form_submit') ?></button>
                        <button type="submit" class="btn btn-primary"><?= $this->lang->line('login_form_facebook') ?></button>
                        <hr style="height:2px;background-color:gray">
                        <p><?= $this->lang->line('login_form_no_account') ?> <a href='<?= site_url('/register') ?>'><?= $this->lang->line('login_form_sign_up') ?></a></p>
                    </form>
                </div>
            </div>
        </div>
        <div class='col-lg-3'></div>
    </div>
</div>