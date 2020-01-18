<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li>Registration</li>
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

<h3 class="text-center">Registration</h3>
<div class="container form_reg">
    <div class="row">



        <div class="col col-md-8 col-md-offset-3 account-left">
            <form role="form" data-toggle="validator" id="signup_form" method="post" action="/user/signup">

                <div class="form-group has-feedback">
                    <label for="login">Login</label>
                    <input name="login" type="text" class="form-control" id="login"
                           placeholder="Enter login" required
                           data-error="Login must be at least 4 characters and should consist of letters and numbers"
                           value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''; ?>">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group ">
                    <div class="form-inline row">
                        <div class="form-group col-md-5 has-feedback">
                            <label for="inputPassword" class="control-label">Password</label>
                            <input name="password" type="password" data-minlength="6" class="form-control"
                                   id="inputPassword"
                                   placeholder="Password" data-error="Minimum of 6 characters" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-5 has-feedback">
                            <label for="inputPassword" class="control-label">Password verification</label>
                            <input type="password" class="form-control" id="inputPasswordConfirm"
                                   data-match="#inputPassword" data-match-error="Whoops, these don't match"
                                   placeholder="Confirm" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email"
                           aria-describedby="emailHelp" required
                           data-error="We'll never share your email with anyone else."
                           value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ''; ?>">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group has-feedback">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name"
                           placeholder="name" required
                           value="<?= isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : ''; ?>">

                </div>
                <div class="form-group has-feedback">
                    <label for="address">Address</label>
                    <input name="address" type="text" class="form-control" id="address"
                           placeholder="Address" required
                           value="<?= isset($_SESSION['form_data']['address']) ? h($_SESSION['form_data']['address']) : ''; ?>">
                </div>
                <div class="form-group">
                    <button id="singnup_btn" type="submit" class="btn btn-primary">SignUp</button>
                </div>
            </form>
            <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']) ?>
        </div>
    </div>
</div>