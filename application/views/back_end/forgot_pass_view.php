<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->lang->load('content_back');
?>

<div class="container">
    <div class="row container">
        <h1><?= $this->lang->line('forgot_p_home') ?> <small><?= $this->lang->line('forgot_p_welcome'); ?></small></h1>
        <hr>        
    </div>  
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="row well">
                    <form class="form-horizontal" method="POST">
                        <fieldset>
                            <legend><?= $this->lang->line('forgot_p_form_name') ?></legend>

                            <?php if (isset($message['sucess'])): ?>                                
                                <span class="help-inline text-success bg-success"><?= $message['sucess'] ?>
                                    <a href="<?php echo site_url('/login'); ?>" class=""><?= $this->lang->line('forgot_p_form_btn_login') ?></a>
                                </span>
                            <?php endif; ?>

                            <span class="help-block"><?= $this->lang->line('forgot_p_form_message_help') ?></span>
                            <div class="form-group
                            <?php if (isset($message['error'])): ?>
                                <?= ' has-error' ?>
                                 <?php endif; ?>">
                                <label for="inputTitle" class="col-lg-3 control-label"><?= $this->lang->line('forgot_p_form_lbl_email') ?></label>
                                <div class="col-lg-9">
                                    <input name="email" type="text" class="form-control" id="inputTitle" placeholder="<?= $this->lang->line('forgot_p_form_text') ?>">
                                    <?php if (isset($message['error'])): ?>                                
                                        <span class="help-inline text-danger"><?= $message['error'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <a href="<?php echo site_url('/login'); ?>" class="btn btn-primary"><?= $this->lang->line('forgot_p_form_btn_cancel') ?></a>
                                    <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <?= $this->lang->line('forgot_p_form_btn_send_mail') ?></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>
