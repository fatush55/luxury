<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Currency</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/currency">Currency</a></li>
                        <li class="breadcrumb-item active">Currency Add</li>
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
                    <h5><i class="icon fas fa-check"></i> SUCCESS!</h5>
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
                        <form id="add_form" action="<?= ADMIN ?>/currency/add" data-toggle="validator" role="form" method="post">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="title" class="control-label">Name Currency</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Name"
                                           data-error="Enter Name Currency" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="code" class="control-label">Code</label>
                                    <input name="code" type="text" class="form-control" id="code" placeholder="Code"
                                           data-error="Enter Code" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group">
                                    <label for="symbol_left" class="control-label">Symbol Left</label>
                                    <input name="symbol_left" type="text" class="form-control" id="symbol_left" placeholder="Symbol" >
                                </div>

                                <div class="form-group">
                                    <label for="symbol_right" class="control-label">Symbol Right</label>
                                    <input name="symbol_right" type="text" class="form-control" id="symbol_right" placeholder="Symbol" >
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="value" class="control-label">Rate</label>
                                    <input name="value" type="text" class="form-control" id="value" placeholder="Rate"
                                           data-error="Only integer and dot" required
                                           pattern="^[0-9.]+?$">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>


                                <div class="form-group">
                                    <input type="hidden" name="base" value="0">
                                    <button id="add_btn_form" type="submit" class="btn btn-primary">Add</button>
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