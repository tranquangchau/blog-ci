<?php //var_dump($result); exit();  ?>
<div class="container">
    

        <div class="row container">
            <h1>Blog Home One <small>Subheading</small></h1>
            <hr>
        </div>
        <div class="row">        
            <?php echo $this->breadcrumbs->show(); ?>
        </div>

        <div class="row col-md-8">

            <?php if (isset($result)) : ?>

                <?php foreach ($result as $key => $value): ?>

                    <div class="row">
                        <a href="<?php echo site_url(); ?>post/<?php echo $value['alias']; ?>"><h1><?php echo $value['title']; ?> </h1></a>
                        <h3>by author: <a href="#<?= $value['username']; ?>"><?php echo $value['fullname']; ?> </a></h3>

                        <p><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Postted on  <?php echo $value['create_time']; ?> </p>
                        <hr>

                        
                        <img src=" <?php echo base_url('upload').'/'.$value['hinh_anh']; ?> " alt="" class="img-responsive"/>
                        <hr>
                        <p> <?php echo $value['mieu_ta']; ?> </p>
                        <a href="<?php echo site_url(); ?>/post/view/<?php echo $value['alias']; ?>" class="btn btn-primary">Readmore ></a>
                        <hr>
                    </div>

                <?php endforeach; ?>

                <nav>
                    <ul class="pager">
                        <li class="previous disabled"><a href="#">← Older</a></li>
                        <li class="next"><a href="#">Newer →</a></li>
                    </ul>

                </nav>
            <?php else:?>
            <div class="row">
                <br><br><br><br>
                <h4 class="bg-info">No have post by user have</h4>
            </div>
            <?php endif; ?>

        </div>
        <div class="col-md-4" >
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
