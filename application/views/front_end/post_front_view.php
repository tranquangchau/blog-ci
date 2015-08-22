<?php //var_dump($ketqua);  exit();                  ?>
<?php
if ($this->session->has_userdata('data_login')) {
    $data = $this->session->userdata('data_login');
    //var_dump($data);
    if (isset($data['id'])) {
        //echo '<p>User have login</p>';
    } else {
        //echo '<p>User no login</p>';
    }
} else {
    //echo '<p>Chua Login</p>';
}
?>

<div class="container">
    <div class="row">
        <?php if (isset($ketqua)): ?>
            <div>
                <h1>Title: <?php echo $ketqua['title']; ?> <small>by <a href="#<?= $ketqua['ac_username']; ?>">
                            <?php echo $ketqua['ac_fullname']; ?></a></small></h1>
                <hr>
            </div>
            <div class="row">        
                <?php echo $this->breadcrumbs->show(); ?>
            </div>

        <?php endif; ?>
        <div class="container">
            <div class="row"> 
                <?php if (isset($ketqua)): ?>

                    <div class="col-md-8">

                        <div class="row">
                            <hr>

                            <p><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Postted on August 28,2013 at 10:00 PM</p>
                            <hr>
                            <?php if (isset($ketqua['hinh_anh'])): ?>
                                <img src="<?php echo base_url('upload').'/'.$ketqua['hinh_anh']; ?>" alt="" class="img-responsive"/>
                                <hr>
                            <?php endif; ?>
                            <p><strong>    <?php echo $ketqua['mieu_ta']; ?>            </strong>   </p>
                            <hr>
                            <?php echo $ketqua['content']; ?>
                            <?php $post_of_id = $ketqua['id']; ?>

                            <hr>
                            <div class="well">
                                <h3>Leave a Comment:</h3>
                                <?php
                                if ($this->session->has_userdata('data_login')) {
                                    $data = $this->session->userdata('data_login');
                                    //var_dump($data);
                                    if (isset($data['id'])) {
                                        //echo '<p>User have login</p>';
                                    } else {
                                        //echo '<p>User no login</p>';
                                    }
                                } else {
                                    //echo '<p>Chua Login</p>';
                                }
                                ?>

                                <?php if ($this->session->has_userdata('data_login')): ?>
                                    <?php $data = $this->session->userdata('data_login'); ?>
                                    <?php if (($data['role'] == 1) or ( $data['role'] == 0)): ?>
                                        <form method="POST">
                                            <textarea name="comment" class="form-control" rows="3" id="textArea"></textarea>
                                            <input name="post_id" value="<?php echo $post_of_id; ?>" class="hidden">
                                            <br>
                                            <input type="submit" class="btn btn-primary">
                                        </form>
                                    <?php endif; ?>

                                <?php else : ?>
                                    <p>You no Login, You can click login here</p>
                                    <a href="<?php echo site_url('/back_end/authentication/login'); ?>" class="btn btn-primary">Login</a>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="media">

                                <?php //var_dump($ketqua['comment']); ?>
                                <?php if (isset($ketqua['comment'])): ?>
                                    <?php foreach ($ketqua['comment'] as $key => $value): ?>
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" alt="64x64" src="http://localhost/blog/upload/avata.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"> <?php echo $value['create_time']; ?> <small>by Account: <?php echo $value['account_id']; ?></small></h4>
                                            <p><?php echo nl2br(htmlspecialchars($value['content']))  ; ?></p>
                                        </div>
                                        <br>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php else: ?>

                    <div class="col-md-8">
                        <div class="row">
                            <?php if (isset($message)): ?>
                                <p class="text-danger"><?php echo $message; ?></p>
                            <?php endif; ?>




                        </div>
                    </div>



                <?php endif; ?>
                <div class="col-md-4" style="padding-right: 0px;">
                    <div class="well">
                        <h2>Blog Search</h2>
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="password" aria-describedby="basic-addon1" name="password">
                                <span class="input-group-addon" id="basic-addon1">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="well">
                        <h2>Blog Categories</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#">Category Name</a><br>
                                <a href="#">Category Name</a><br>
                                <a href="#">Category Name</a><br>
                                <a href="#">Category Name</a><br>
                            </div>
                            <div class="col-md-6">
                                <a href="#">Category Name</a><br>
                                <a href="#">Category Name</a><br>
                                <a href="#">Category Name</a><br>
                                <a href="#">Category Name</a><br>
                            </div>
                        </div>

                    </div>
                    <div class="well">
                        <h2>Side Widget Well</h2>
                        <div class="container-fluid">
                            <div class="row">
                                <p>Provide pagination links for your site or app with the multi-page pagination component, or the simpler pager alternative.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
