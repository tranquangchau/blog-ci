<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->helper('form');
//var_dump($result_id);
$this->lang->load('content_back');
?>
<div class="container">

    <div class="row container">  
        <h1><?= $this->lang->line('post_n_name') ?> <small><?= $this->lang->line('post_n_name_small') ?></small></h1>
        <hr>
    </div>
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>       
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <legend><?= $this->lang->line('post_n_form_name') ?></legend>

                            <?php if (isset($message['error'])) : ?>
                                <p class="text-danger"><?php echo $message['error']; ?></p>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="inputTitle" class="col-lg-2 control-label"><?= $this->lang->line('post_n_form_title') ?></label>
                                <div class="col-lg-10">
                                    <input name="title" type="text" class="form-control" id="inputTitle" placeholder="Title" value="<?= $this->input->post('title')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAlias" class="col-lg-2 control-label"><?= $this->lang->line('post_n_form_alias') ?></label>
                                <div class="col-lg-10">
                                    <input name="alias" type="text" class="form-control" id="inputPassword" placeholder="Alias" value="<?= $this->input->post('alias')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTitle" class="col-lg-2 control-label"><?= $this->lang->line('post_n_form_photo') ?></label>
                                <div class="col-lg-10">
                                    <input name="userfile" type="file" class="form-control" id="inputTitle" placeholder="Url img">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select" class="col-lg-2 control-label"><?= $this->lang->line('post_n_form_category') ?></label>
                                <div class="col-lg-5">
<!--                                    <select name="category" class="form-control" id="select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>-->
                                    <select class="form-control"  name="category">
                                        <?php if (isset($result_id)): ?>

                                           

                                            <?php foreach ($result_id['category_info'] as $key => $value): ?>


                                                <?php if ($value['id'] == $result_id['0']['category_id']): ?>
                                                    <option selected value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-lg-5"></div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label"><?= $this->lang->line('post_n_form_description') ?></label>
                                <div class="col-lg-10">
                                    <textarea name="mieu_ta" class="form-control" id="description" required="required" title="description" placeholder="Description"><?= $this->input->post('mieu_ta')?></textarea>                                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textArea" class="col-lg-2 control-label"><?= $this->lang->line('post_n_form_content') ?></label>
                                <div class="col-lg-10">
                                    <textarea name="content" class="summernote" id="contents" required="required" title="Contents" placeholder="Content"><?= $this->input->post('content')?></textarea>                                            
                                    <span class="help-block"><?= $this->lang->line('post_n_form_help') ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <a href="<?php echo site_url('/admin/post/index'); ?>" class="btn btn-primary"><?= $this->lang->line('post_n_form_cancel') ?></a>
                                    <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> <?= $this->lang->line('post_n_form_submit') ?></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>
