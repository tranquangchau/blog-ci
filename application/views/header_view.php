<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (isset($title)) {
    echo '<title>' . $title . '</title>';
} else {
    echo '<title>Welcome</title>';
}
if (isset($meta_charset)) {
    echo '<title>' . $meta_charset . '</title>';
} else {
    echo '<meta charset="utf-8">';
}
?>

<!-- Latest compiled and minified CSS -->
<?php if ($this->session->has_userdata('data_login')): ?>
    <link rel="stylesheet" href=" <?php echo base_url() . "assets/"; ?>css/bootstrap.min.css">
<?php else: ?>
    <link rel="stylesheet" href=" <?php echo base_url() . "assets/"; ?>css/bootstrap.min_3.css">
<?php endif; ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

<script src=" <?php echo base_url() . "assets/"; ?>js/jquery.min.js" type="text/javascript"></script>
<script src=" <?php echo base_url() . "assets/"; ?>js/bootstrap.min.js" type="text/javascript"></script>


<!--Load js for textare-->
<script src=" <?php echo base_url() . "assets/"; ?>js/summernote.js" type="text/javascript"></script>
<link rel="stylesheet" href=" <?php echo base_url() . "assets/"; ?>css/summernote.css">


<script type="text/javascript">
    $(function () {
        $('.summernote').summernote({
            height: 200
        });

    });
</script>

<!--<link rel="stylesheet" href=" <?php echo base_url() . "assets/"; ?>css/font-awesome.min.css">-->
