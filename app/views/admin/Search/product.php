<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Search: "<?= $query?>"</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=ADMIN?>">Home</a> </li>
                        <li class="breadcrumb-item"><a href="<?=ADMIN?>/product">Product</a> </li>
                        <li class="breadcrumb-item active">Product Search: "<?= $query?>"</li>
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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                            <div class="card-tools">
                                <div class="row">
                                    <form action="<?= ADMIN?>/search/product" autocomplete="off">
                                        <div class="input-group input-group-sm " style="width: 220px;">
                                            <div class="input-group-append">

                                                <input type="text" id="typeahead" name="s"
                                                       class="typeahead form-control float-right" placeholder="Search">
                                                <button type="submit" class="btn btn-default"><i
                                                            class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th class="hide">Price</th>
                                    <th class="hide">Old Price</th>
                                    <th>Status</th>
                                    <th class="hide">Category</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $product):?>
                                    <tr>
                                        <td><?= $product['id']?></td>
                                        <td><?= $product['title']?></td>
                                        <td class="hide"><?= $product['price']?></td>
                                        <td class="hide"><?= $product['old_price']?></td>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"
                                                     data-status="<?= $product['status']?>"
                                                     data-id="<?= $product['id']?>">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="customSwitch3-<?= $product['id']?>"
                                                        <?= $product['status'] ? ' checked' : ''?>>
                                                    <label class="custom-control-label" for="customSwitch3-<?= $product['id']?>">
                                                        <?= $product['status'] ? 'On' : 'Off' ?>
                                                    </label>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="hide"><?= $product['name_cat']?></td>
                                        <td>
                                            <a href="<?= ADMIN?>/product/edit?id=<?=$product['id']?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= ADMIN?>/product/delete?id=<?=$product['id']?>" data-id="61" class="text-danger delete">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                        <td></td>
                                    </tr>


                                <?php endforeach;?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="float-right" style="margin: 35px">
                        <h6>(<?= count($products) ?> orders from <?= $count ?>)</h6>
                        <?php if ($pagination->countPages > 1): ?>
                            <?= $pagination ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>
<!--content-wrapper-end -->

<script src="js/search_product.js"></script>


