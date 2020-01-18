<!--breadcrumb-starts-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href='/'>Home</a></li>
                <li>Payment Successfully</li>
            </ol>
        </div>
    </div>
</div>
<!--breadcrumb-end-->

<?php $curr = \luxury\App::$app->getProperty('currency'); ?>


<div class="row">
    <div class="col col-md-12 text-center">
        <h2>Payment Successfully</h2>
    </div>
    <div class="col col-md-12 text-center" style="display: flex; justify-content: center; margin: 80px 0 100px 0 ">
        <div class="alert alert-success" role="alert" style=" padding: 20px 200px 20px 200px">Payment Successfully</div>
    </div>

</div>

<?php if (!empty($_SESSION['success'])) unset($_SESSION['success'])?>