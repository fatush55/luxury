<div class="login-box">
    <div class="login-logo">
        <b>Luxury</b>Watch
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?php if (isset($_SESSION['error'])):?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> ERROR!</h5>
                   <?=$_SESSION['error']?>
                </div>
            <?php endif;?>

            <form action="<?= ADMIN?>/user/login-admin" method="post">
                <div class="input-group mb-3">
                    <input name="login" type="text" class="form-control" placeholder="Login">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <div class="col-md-4 content-center">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <p class="mb-1" style="margin: 10px 0 0 15px;">
                        <a href=<?= PATH ?> "/"><i class="fas fa-long-arrow-alt-left"></i><b> back</b></a>
                    </p>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>

