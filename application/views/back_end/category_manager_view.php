<?php //var_dump($ketqua);exit(); ?>

<div class="container">
    <div class="row container">
        <h1>Category <small>welcome</small></h1>
        <hr>        
    </div>
    <div class="row">        
            <?php echo $this->breadcrumbs->show(); ?>
    </div>
    <div class="row container">
        <div class="col-lg-12">
            <div class="row table-responsive">
                <table class="table table-bordered  table-striped">
                    <tr style="background-color: #c0c0c0;">
                        <td>ID</td>
                        <td>Title</td>
                        <td>Account ID</td>
                        <td>Description</td>
                        <td>Create Time</td>
                        <td>Modify Time</td>
                        <td>Delete</td>
                    </tr>
                    <?php if (isset($ketqua)): ?>
                        <?php foreach ($ketqua as $row): ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td> <a href=" <?= site_url('/admin/category/edit_category/' . $row['id']); ?> "> <?= $row['title']; ?></a></td>
                                <td> <?= $row['account_id'] ?></td>
                                <td> <?= $row['description'] ?></td>
                                
                                <td> <?= $row['create_time'] ?></td>
                                <td> <?= $row['modify_time'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm-<?= $row['id']; ?>">Delete</button>
                                    <div class="modal fade bs-example-modal-sm-<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    <h4  class="modal-title" id="mySmallModalLabel">Do you want delete</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <a href="<?= site_url('/admin/category/delete/' . $row['id']); ?>" class="btn btn-primary">Yes</a>
                                                            <a href="#" class="btn btn-success" class="close" data-dismiss="modal" aria-label="Close">No</a>                                    
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
                </table>
            </div>
        </div>
    </div>
</div>