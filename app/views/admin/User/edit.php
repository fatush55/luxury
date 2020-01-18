<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User #<?=$user->id ?> Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=ADMIN?>">Home</a> </li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/user">Users</a></li>
                        <li class="breadcrumb-item active">User #<?= $user->id?> Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.Alert Error and Success start-->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="row justify-content-center">
            <div class="col  col-md-6">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> ERROR!</h5>
                    <?= $_SESSION['error'] ?>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['error']) ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="row justify-content-center">
            <div class="col  col-md-6">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> SUCCESS!</h5>
                    <?= $_SESSION['success'] ?>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['success'])) unset($_SESSION['success']) ?>
    <?php endif; ?>
    <!-- /.Alert Error and Success end-->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col col-md-12">
                    <div class="box">
                        <form action="<?= ADMIN ?>/user/edit" data-toggle="validator" role="form" method="post">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="login" class="control-label">New Login</label>
                                    <input name="login" type="text" class="form-control" id="login" placeholder="New Login"
                                           data-error="Enter New Login" value="<?=h($user->login)?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group ">
                                    <label for="password" class="control-label">New Password</label>
                                    <input name="password" type="text" class="form-control" id="password" placeholder="New Password"
                                           data-error="Enter New Password">
                                    <div class="help-block">Optional For Edit</div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="name" class="control-label">New Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="New Name"
                                           data-error="Enter New Name" value="<?=h($user->name)?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email" class="control-label">New Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="New Email"
                                           data-error="Enter New Email" value="<?=h($user->email)?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="address" class="control-label">New Address</label>
                                    <input name="address" type="tetx" class="form-control" id="address" placeholder="New Address"
                                           data-error="Enter New Address" value="<?=h($user->address)?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option  value="user"
                                            <?php if ($user->role === 'user') echo ' selected'?> >User
                                        </option>
                                        <option value="Admin"
                                            <?php if ($user->role === 'admin') echo ' selected'?> >Admin
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $user->id?>">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!--content-wrapper-end -->