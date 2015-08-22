<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <legend>Edit Category</legend>

                            <?php if (isset($message['error'])) : ?>
                                <p class="text-danger"><?php echo $message['error']; ?></p>
                            <?php endif; ?>

                            <?php if (isset($result_id)): ?>    
                                <div class="form-group">
                                    <label for="inputTitle" class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input name="title" type="text" class="form-control" id="inputTitle" placeholder="Title" value="<?php echo $result_id['0']['title']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAlias" class="col-lg-2 control-label">Alias</label>
                                    <div class="col-lg-10">
                                        <input name="alias" type="text" class="form-control" placeholder="Alias" value="<?php echo $result_id['0']['alias']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea name="description" class="summernote" id="contents" required="required" title="Contents" placeholder="Content"><?php echo $result_id['0']['description']; ?></textarea>                                            
                                        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Submit</button>
                                        <a href="<?php echo site_url(); ?>/admin/category/index" class="btn btn-primary">Cancel</a>
                                        <a href="<?php echo site_url(); ?>/admin/category/delete/<?php echo $result_id['0']['id']; ?>" class="btn btn-danger">Delete</a>
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