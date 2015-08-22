<?php
//var_dump($data_submit);
//$this->lang->load('content_back');
?>

<div class="container">
    <div class="row container">
        <h1><?= $this->lang->line('register_name') ?> <small><?= $this->lang->line('register_small') ?></small></h1>
        <hr>        
    </div>   
    <!--    Load Breadcrumb-->
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="row">
                <form class="form-horizontal well" method="POST">
                    <fieldset>
                        <legend><?= $this->lang->line('register_form_register') ?></legend>     


                        <?php if (isset($message['error'])): ?>                                
                            <span class="help-inline bg-success"><?= $message['error'] ?></span>
                            <br><br>
                        <?php endif; ?>

                        <div class="form-group 
                        <?php if (isset($message_user)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?= $this->lang->line('register_form_username') ?></label>
                            <div class="col-lg-8">
                                <input name="user" type="text" class="form-control" id="inputPassword" value="<?= $this->input->post('user') ?>">
                                <?php if (isset($message_user)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_user ?></span>
                                <?php endif; ?>
                            </div>                                                        
                        </div>
                        <div class="form-group
                        <?php if (isset($message_fullname)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?= $this->lang->line('register_form_fullname') ?></label>
                            <div class="col-lg-8">
                                <input name="fullname" type="text" class="form-control" id="inputPassword" value="<?= $this->input->post('fullname') ?>">
                                <?php if (isset($message_fullname)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_fullname ?></span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="form-group 
                        <?php if (isset($message_email)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?= $this->lang->line('register_form_email') ?></label>
                            <div class="col-lg-8">
                                <input name="email" type="email" class="form-control" id="inputPassword" value="<?= $this->input->post('email') ?>">
                                <?php if (isset($message_email)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_email ?></span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="form-group 
                        <?php if (isset($message_pass)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?= $this->lang->line('register_form_pass') ?></label>
                            <div class="col-lg-8">
                                <input name="pass" type="password" class="form-control" id="inputPassword" value="">
                                <?php if (isset($message_pass)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_pass ?></span>
                                <?php endif; ?>
                            </div>
                        </div>      

                        <div class="form-group 
                        <?php if (isset($message_repass)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?= $this->lang->line('register_form_repass') ?></label>
                            <div class="col-lg-8">
                                <input name="repass" type="password" class="form-control" id="inputPassword" value="">
                                <?php if (isset($message_repass)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_repass ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <a href="<?= site_url('/login')?>" class="btn btn-primary"><?= $this->lang->line('change_pass_cancel') ?></a>
                                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span><?= $this->lang->line('change_pass_submit') ?></button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
