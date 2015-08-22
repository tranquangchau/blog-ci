<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($result_id);exit();
//var_dump($category_info);
?>

<div class="container">

    <div class="row container">   
        <h1>Home <small>welcome</small></h1>
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
                    <form action="#" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Edit Post</legend>                            
                            <?php if (isset($message['error'])) : ?>
                                <p class="text-danger"><?php echo $message['error']; ?></p>
                            <?php endif; ?>

                            <?php if (isset($result_id['0']['id'])): ?>

                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input name="id" type="hidden" class="form-control" id="inputTitle" placeholder="Title" value="<?php echo $result_id['0']['id']; ?>">
                                        <input name="title" type="text" class="form-control" id="inputTitle" placeholder="Title" value="<?php echo $result_id['0']['title']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAlias" class="col-lg-2 control-label">Alias</label>
                                    <div class="col-lg-10">
                                        <input name="alias" type="text" class="form-control" id="inputPassword" placeholder="Alias" value="<?php echo $result_id['0']['alias']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Photo</label>
                                    <div class="col-lg-10" >
                                        <input name="userfile" type="file" class="form-control" id="inputTitle" placeholder="Url img"">                                        
                                        <?php if ($result_id['0']['hinh_anh'] != ''): ?>
                                            <div class="row container" id="photo">
                                                <br>
                                                <img src="<?php echo $result_id['0']['hinh_anh']; ?>" class="img-thumbnail" height="200" width="400">                                        
                                                <a href=# onclick=myfunction() class="btn btn-danger">Delete Photo</a>
                                            </div>

                                            <script>
                                                function myfunction() {
                                                    $("#photo").remove();
                                                    $('<input>').attr({
                                                        type: 'hidden',
                                                        name: 'delete_hinhanh',
                                                        value: 'true'
                                                    }).appendTo('form');
                                                }
                                            </script>
                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="select" class="col-lg-2 control-label">Category</label>
                                    <div class="col-lg-5">
    <!--                                        <select name="category" class="form-control" id="select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>-->


                                        <select class="form-control"  name="category">
                                            <?php if (isset($result_id)): ?>

                                                <option value=""><?= $this->lang->line('post_m_combobox_default') ?></option>

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
                                    <label for="textArea" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea name="mieu_ta" class="form-control" id="description" required="required" title="description" placeholder="Description"><?php echo $result_id['0']['mieu_ta']; ?></textarea>                                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                                    <div class="col-lg-10">
                                        <textarea name="content" class="summernote" id="contents" required="required" title="Contents" placeholder="Content"><?php echo $result_id['0']['content']; ?></textarea>                                            
                                        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Submit</button>
                                        <a href="<?php echo site_url('/admin/post/index'); ?>" class="btn btn-primary">Cancel</a>
                                        <a href="<?php echo site_url('/admin/post/delete'); ?>/<?php echo $result_id['0']['id']; ?>" class="btn btn-danger">Delete</a>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>