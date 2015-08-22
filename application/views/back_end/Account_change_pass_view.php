<?php
//var_dump($message1);var_dump($message2);exit();
$this->lang->load('content_back');
?>

<div class="container">
    <div class="row container">
        <h1><?=$this->lang->line('change_name')?> <small><?=$this->lang->line('change_name_small')?></small></h1>
        <hr>        
    </div>   
    <!--    Load Breadcrumb-->
    <div class="row">        
        <?php echo  $this->breadcrumbs->show(); ?>
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="row">
                <form class="form-horizontal well" method="POST">
                    <fieldset>
                        <legend><?=$this->lang->line('change_pass_name')?></legend>                        
                        <div class="form-group 
                        <?php if (isset($message_pass_old)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?=$this->lang->line('change_pass_oldpass')?></label>
                            <div class="col-lg-8">
                                <input name="pass_old" type="password" class="form-control" id="inputPassword" value="">
                                <?php if (isset($message_pass_old)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_pass_old ?></span>
                                <?php endif; ?>
                            </div>                                                        
                        </div>
                        <div class="form-group
                            <?php if (isset($message_pass_new)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?=$this->lang->line('change_pass_newpass')?></label>
                            <div class="col-lg-8">
                                <input name="pass_new" type="password" class="form-control" id="inputPassword" value="">
                                <?php if (isset($message_pass_new)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_pass_new ?></span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="form-group 
                        <?php if (isset($message_pass_re)): ?>
                            <?= ' has-error' ?>
                             <?php endif; ?>">
                            <label for="inputAlias" class="col-lg-4 control-label"><?=$this->lang->line('change_pass_repass')?></label>
                            <div class="col-lg-8">
                                <input name="pass_re" type="password" class="form-control" id="inputPassword" value="">
                                <?php if (isset($message_pass_re)): ?>                                
                                    <span class="help-inline text-danger"><?= $message_pass_re ?></span>
                                <?php endif; ?>
                            </div>

                        </div>                        
                        <div class="form-group">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <a href="<?= site_url('/login') ?>" class="btn btn-primary"><?=$this->lang->line('change_pass_cancel')?></a>
                                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span><?=$this->lang->line('change_pass_submit')?></button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
