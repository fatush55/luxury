<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Filter Attribute <?= $attr->value ?> Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/filter/attribute">Filter Attribute</a></li>
                        <li class="breadcrumb-item active">Filter <?= $attr->value ?> Edit</li>
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
                        <form id="add_form" action="<?= ADMIN ?>/filter/attribute-edit" data-toggle="validator" role="form" method="post">
                            <div class="box-body">
                                <div class="form-group has-feedback">
                                    <label for="title" class="control-label">Name Filter Group</label>
                                    <input name="value" type="text" class="form-control" id="title" placeholder="Name"
                                           data-error="Enter Name Filter Group"
                                           value="<?= $attr->value ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="category_id">Group</label>
                                    <select class="form-control category_select" name="attr_group_id" id="category_id"
                                            data-error="Select one of the group" required>
                                        <?php foreach ($groups as $group): ?>
                                            <option value="<?= $group->id?>" <?php if ($group->id === $attr->attr_group_id) echo ' selected'?>>
                                                <?= $group->title?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $attr->id ?>">
                                    <button id="add_btn_form" type="submit" class="btn btn-primary">Save</button>
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