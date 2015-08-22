<?php ?>


<div class="container">
    <div class="row">
        <br>
        <h1>ERROR:</h1> 
        <h2>401 unauthorized</h2>
        <br>
        <?php if (isset($message)): ?>
            <div class="well">
                <h2>Message:</h2>
                <?= $message ?>
            </div>
        <?php endif; ?>

        <br>
        <a class="btn btn-success" href="<?= site_url('account/home') ?>">Back Home</a>
    </div>
</div>