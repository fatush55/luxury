<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li>Edit Account <?= $name ?></li>
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

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<h3 class="text-center">Edit Account  <?= $name ?></h3>
<div class="container form_reg">
    <div class="row">

        <div class="col col-md-8 col-md-offset-3 account-left">
            <form role="form" data-toggle="validator" id="signup_form" method="post" action="/user/edit">

                <div class="form-group has-feedback">
                    <label for="login">Login</label>
                    <input name="login" type="text" class="form-control" id="login"
                           placeholder="Enter login" required
                           data-error="Login must be at least 4 characters and should consist of letters and numbers"
                           value="<?= h($_SESSION['user']['login']) ?>">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group ">
                    <label for="inputPassword" class="control-label">Password</label>
                    <input name="password" type="password"  class="form-control"
                           id="inputPassword" placeholder="password min 6 symbol">
                </div>

                <div class="form-group has-feedback">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email"
                           aria-describedby="emailHelp" required
                           data-error="We'll never share your email with anyone else."
                           value="<?= h($_SESSION['user']['email']) ?>">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group has-feedback">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name"
                           placeholder="name" required
                           value="<?= h($_SESSION['user']['name']) ?>">

                </div>
                <div class="form-group has-feedback">
                    <label for="address">Address</label>
                    <input name="address" type="text" class="form-control" id="address"
                           placeholder="Address" required
                           value="<?= h($_SESSION['user']['address']) ?>">
                </div>
                <div class="form-group">
                    <div class="row btm_user_edit">
                        <div class="col col-md-9">
                            <button id="singnup_btn" type="submit" class="btn btn-primary">Save</button>

                        </div>
                        <div class="col col-md-2">
                            <button type="button" class="btn btn-warning">
                                <a href="/user/add-img" style="text-decoration: none; color: white">Add Photo</a>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/tabs.js"></script>
