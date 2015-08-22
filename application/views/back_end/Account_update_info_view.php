<?php
//var_dump($ketqua);exit();
$this->lang->load('content_back');
?>

<div class="container">
    <div class="row container">
        <h1><?= $this->lang->line('update_name') ?><small> <?= $this->lang->line('update_name_small') ?></small></h1>
        <hr>
    </div>  
    <!--Load Breadcrumb-->
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>
    <div class="row container">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="row">
                <form class="form-horizontal" method="POST">
                    <fieldset>
                        <legend><?= $this->lang->line('update_user_name') ?></legend>
                        <?php if (isset($ketqua)): ?>
                            <div class="form-group">
                                <label for="inputTitle" class="col-lg-3 control-label"><?= $this->lang->line('update_user_username') ?> </label>
                                <p class="col-lg-9 form-control-static"><?= $ketqua['0']['username'] ?></p>
                            </div>
                            <div class="form-group
                            <?php if (isset($message)): ?>
                                <?= ' has-error' ?>
                                 <?php endif; ?>">
                                <label for="inputAlias" class="col-lg-3 control-label"><?= $this->lang->line('update_user_fullname') ?></label>
                                <div class="col-lg-9">
                                    <input name="fullname" type="text" class="form-control" id="inputPassword" value="<?= $ketqua['0']['fullname'] ?>">
                                    <?php if (isset($message)): ?>                                
                                        <span class="help-inline text-danger"><?= $message ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <a href="http://localhost/blog/back_end/authentication/home" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Submit</button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
