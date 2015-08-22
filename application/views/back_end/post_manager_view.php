<?php
//var_dump($ketqua);exit();
$this->lang->load('content_back');

if (isset($ketqua['category_search'])) {
    $c_search = $ketqua['category_search'];
} else {
    $c_search = '';
}

if (isset($ketqua['keysearch'])) {
    $c_keysearch = $ketqua['keysearch'];
} else {
    $c_keysearch = '';
}
?>

<div class="container">
    <div class="row container"> 
        <h1><?= $this->lang->line('post_m_name') ?> <small><?= $this->lang->line('post_m_name_small') ?></small></h1>
        <hr>        
    </div>
    <div class="row">        
        <?php echo $this->breadcrumbs->show(); ?>
    </div>

    <div class="row">
        <hr>
        <div class="form-group">
            <label for="select" class="col-lg-1 control-label"><?= $this->lang->line('post_m_combobox_category') ?></label>
            <div class="col-lg-5">
                <div class="form-group">                    
                    <select class="form-control" name="size" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                        <!--<select class="form-control" name="size" onchange="location = this.options[this.selectedIndex].value;">-->
                        <?php if (isset($ketqua)): ?>
                            <option value=""><?= $this->lang->line('post_m_combobox_default') ?></option>
                            <?php foreach ($ketqua['category'] as $key => $value): ?>

                                <?php if ($value['id'] == $c_search): ?>
                                    <option selected value="<?= site_url('/admin/post/post_by_category/' . $value['id']) ?>"><?= $value['title'] ?></option>
                                <?php else: ?>
                                    <option value="<?= site_url('admin/post/post_by_category/' . $value['id']) ?>"><?= $value['title'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <option value="<?= site_url('admin/post/post_by_category/') ?>"><?= $this->lang->line('post_m_combobox_all') ?></option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <form method="POST" action="<?= site_url('admin/post/search_post/'); ?>">
                    <div class="input-group">
                        <input name="keysearch" type="text" class="form-control" placeholder="<?= $this->lang->line('post_m_placeho_search') ?>" value="<?= $c_keysearch ?>">
                        <input name="category_id" type="text" class="hidden" value="<?= $c_search ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><?= $this->lang->line('post_m_search') ?></button>
                        </span>
                    </div><!-- /input-group -->
                </form>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead style="background-color: #D0D0D0; text-transform: uppercase">
                        <tr>
                            <td><?= $this->lang->line('post_m_table_stt') ?></td>
                            <td><?= $this->lang->line('post_m_table_title') ?></td>
                            <td><?= $this->lang->line('post_m_table_account_id') ?></td>
                            <td><?= $this->lang->line('post_m_table_category_name') ?></td>
                            <td><?= $this->lang->line('post_m_table_create_time') ?></td>
                            <td><?= $this->lang->line('post_m_table_modify_time') ?></td>
                            <td><?= $this->lang->line('post_m_table_delete') ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($ketqua['post'])): ?>
                            <?php foreach ($ketqua['post'] as $row): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td> <a href=" <?= site_url('admin/post/edit_post/' . $row['id']); ?> "> <?= $row['title']; ?></a></td>
                                    <td><?= $row['account_id']; ?></td>
                                    <td> <?= $row['ct_title'] ?></td>
                                    <td> <?= $row['create_time'] ?></td>
                                    <td> <?= $row['modify_time'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm-<?= $row['id']; ?>"><?= $this->lang->line('post_m_btn_delete') ?></button>
                                        <div class="modal fade bs-example-modal-sm-<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <h4  class="modal-title" id="mySmallModalLabel"><?= $this->lang->line('post_m_btn_question') ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-3"></div>
                                                            <div class="col-lg-9">
                                                                <a href="<?= site_url('admin/post/delete/' . $row['id']); ?>" class="btn btn-primary"><?= $this->lang->line('post_m_btn_yes') ?></a>
                                                                <a href="#" class="btn btn-success" class="close" data-dismiss="modal" aria-label="Close"><?= $this->lang->line('post_m_btn_no') ?></a>                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>                                        
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>