<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<?php // debug( $_SESSION['avatar_img']);?>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li><a href="<?= PATH ?>/user/edit">Edit Account</a></li>
                <li>Add Image  <?= $name ?></li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<div class="container messenger_container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<h3 class="text-center">Add Image  <?= $name ?></h3>
<div class="container form_reg">
    <div class="row">

        <div class=" col-md-6 text-right">
            <div class="img_user">
                <img src="/images/users/<?= $_SESSION['user']['img']?>" alt="" width="200">
            </div>
        </div>
        <div class="col col-md-6">

            <form action="user/add-img" method="post" enctype="multipart/form-data">
                <input id="load_img" type="file" name="file">
                <input id="add_img" type="submit" value="Save">
            </form>

        </div>

    </div>
</div>

<script src="/js/tabs.js"></script>
