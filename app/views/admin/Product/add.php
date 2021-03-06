<!-- Content Wrapper-start Contains page content -->
<?php unset($_SESSION['multi']); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Add</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/product">Products</a></li>
                        <li class="breadcrumb-item active">Product Add</li>
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
                        <form action="<?= ADMIN ?>/product/add" data-toggle="validator" role="form" method="post">
                            <div class="box-body">

                                <div class="form-group has-feedback">
                                    <label for="title" class="control-label">Name Product</label>
                                    <input name="title" type="text" class="form-control" id="title"
                                           placeholder="Enter Name Product"
                                           data-error="Enter Name" required
                                           value="<?= isset($_SESSION['form_data']['title']) ? $_SESSION['form_data']['title'] : '' ?>">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="parent_category" class="control-label">Product Category</label>
                                    <?php new \app\widgets\Menu\Menu([
                                        'tml' => WWW . '/menu/select.php',
                                        'container' => 'select required ',
                                        'expansion_inside' => 'data-error="Select one of the Category"',
                                        'expansion_outside' => '
                                         <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                        ',
                                        'cache' => 0,
                                        'cacheKey' => 'select_admin',
                                        'class' => 'form-control',
                                        'attrs' => [
                                            'name' => 'category_id',
                                            'id' => 'category_id',
                                        ],
                                        'prepend' => "<option value=''>Choose category</option>",

                                    ]) ?>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="price" class="control-label">Price</label>
                                    <input name="price" type="text" class="form-control" id="price"
                                           placeholder="Enter Price"
                                           data-error="Only integers and points" required pattern="^[0-9.]{1,}$"
                                           value="<?= isset($_SESSION['form_data']['price']) ? $_SESSION['form_data']['price'] : '' ?>">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group has-feedback">
                                    <label for="old_price" class="control-label">Old Price</label>
                                    <input name="old_price" type="text" class="form-control" id="old_price"
                                           placeholder="Enter OLd Price"
                                           data-error="Only integers and points" pattern="^[0-9.]{1,}$"
                                           value="<?= isset($_SESSION['form_data']['old_price']) ? $_SESSION['form_data']['old_price'] : '' ?>">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input name="description" type="text" class="form-control" id="description"
                                           placeholder="Enter Description"
                                           value="<?= isset($_SESSION['form_data']['description']) ? $_SESSION['form_data']['description'] : '' ?>">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Keywords</label>
                                    <input name="keywords" type="text" class="form-control" id="keywords"
                                           placeholder="Enter Keywords"
                                           value="<?= isset($_SESSION['form_data']['keywords']) ? $_SESSION['form_data']['keywords'] : '' ?>">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="status" class="form-control" name="status"
                                                       checked>
                                                <label for="status">
                                                    Status
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2 checkbox_hit">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="hit" class="form-control" name="hit">
                                                <label for="hit">
                                                    Hits
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="editor_1">Content</label>
                                    <textarea name="content" id="editor_1" cols="80" rows="10">
                                         <?= isset($_SESSION['form_data']['content']) ? $_SESSION['form_data']['content'] : '' ?>
                                    </textarea>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="row" style="margin-bottom: 20px ">
                                        <div class="col col-md-11">
                                            <label for="">Modification Product</label>
                                        </div>
                                        <div class="col col-md-1">
                                            <button id="add_mod" type="button" class="btn btn-block btn-success">Add
                                            </button>
                                        </div>
                                    </div>

                                    <div class="body_mod">
                                        <div class="card card-warning" id="card-mod-1">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col col-md-11">
                                                        <h3 class="card-title">Modification</h3>
                                                    </div>
                                                    <div class="col col-md-1 text-right">
                                                        <a href="" class="text-danger mod_del" data-id="1">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                               name="mod[1][title]">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" placeholder="Price"
                                                               name="mod[1][price]">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" placeholder="Old Price"
                                                               name="mod[1][old_price]" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="related">Related Product</label>
                                    <select name="related[]" id="related" class="form-control select2"
                                            multiple></select>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col col-md-10">
                                            <h4>Filters</h4>
                                        </div>
                                        <div class="col col-md-2 ">
                                            <button type="button" id="reset_attr"
                                                    class="btn btn-block btn-danger float-right">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                    <?php new \app\widgets\filter\Filter(0, APP . '/widgets/filter/filter_tmp/filter_tml.php') ?>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-3">
                                            <div class="card card-primary box-solid file-upload">
                                                <div class="card-header">
                                                    <h3 class="card-title">Add main photo</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col col-md-12">
                                                        <div class="card-body">
                                                            <button data-url="/product/add-image" data-name="single"
                                                                    type="button"
                                                                    class="btn btn-block btn-primary" id="single">
                                                                Load
                                                            </button>
                                                            <p><small>Recommended size 125 * 200</small></p>
                                                        </div>
                                                    </div>
                                                    <div class="single"></div>
                                                </div>
                                                <div class="overlay">
                                                    <i class="fas fa-2x fa-sync-alt"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col col-md-9">
                                            <div class="card card-danger box-solid file-upload">
                                                <div class="card-header">
                                                    <h3 class="card-title">Add Photo for Gallery</h3>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="card-body">
                                                        <button data-url="/product/add-image" data-name="multi"
                                                                type="button"
                                                                class="btn btn-block btn-primary btn-load" id="multi">
                                                            Load
                                                        </button>
                                                        <p><small>Recommended size 700 * 1000</small></p>
                                                    </div>
                                                </div>
                                                <div class="row row-multi"></div>
                                                <div class="overlay">
                                                    <i class="fas fa-2x fa-sync-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                        </form>
                        <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']) ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!--content-wrapper-end -->


<script src="js/upload.js"></script>
