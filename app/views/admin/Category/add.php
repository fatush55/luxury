<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Category Add</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/category">Categories</a></li>
                        <li class="breadcrumb-item active">Category Add</li>
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
                        <form action="<?= ADMIN ?>/category/add" data-toggle="validator" role="form" method="post">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="title" class="control-label">Name Category</label>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter Name Category"
                                           data-error="Enter Name" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group">
                                    <label for="parent_category" class="control-label">Parent Category</label>
                                    <?php new \app\widgets\Menu\Menu([
                                            'tml' => WWW . '/menu/select.php',
                                            'container' => 'select',
                                            'cache' => 0,
                                            'cacheKey' => 'select_admin',
                                            'class' => 'form-control',
                                            'attrs' => [
                                                    'name' => 'parent_id',
                                                    'id' => 'parent_id',
                                            ],
                                            'prepend' => "<option value='0'>No Parent</option>",

                                    ])?>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input name="description" type="text" class="form-control" id="description" placeholder="Enter Description">
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>
                                    <input name="keywords" type="text" class="form-control" id="keywords" placeholder="Enter Keywords">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add</button>
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