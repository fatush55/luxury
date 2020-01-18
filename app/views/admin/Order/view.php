<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order #<?= $order['id'] ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/order">Orders</a></li>
                        <li class="breadcrumb-item active">Order #<?= $order['id'] ?></li>
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
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username"><?= $order['name'] ?></h3>
                            <h5 class="widget-user-desc"><?= $order['email'] ?></h5>
                        </div>
                        <a href="<?= ADMIN?>/user/show?id=<?= $order['user_id'] ?>" class="user_info">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2"
                                     src="/images/users/<?= $order['img'] ?>"
                                     alt="User Avatar">
                            </div>
                        </a>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?= $sumOrder ?>
                                        </h5>
                                        <span class="description-text">Sum</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?= $orders_success ?>
                                        </h5>
                                        <span class="description-text">Success </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            <?= $orders_new ?>
                                        </h5>
                                        <span class="description-text">New</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>

                <div class="col-md-6">
                    <div class="cart">
                        <div class="card-header">
                            <h3  class="cart-title">Info is Order</h3>
                        </div>
                        <div class="cart-body table-response p-o">
                            <table class="table p-0">
                                <tbody>
                                <tr>
                                    <td><b>Date</b></td>
                                    <td><?= $order['date'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>Upgrade Date</b></td>
                                    <td><?= $order['update_at'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>Sum</b></td>
                                    <td><?= $order['sum'] . ' ' . $order['currency'] ?></td>
                                </tr>
                                <tr>
                                    <td><b>Status</b></td>
                                    <?php
                                    if ($order['status'] === 'processing') {
                                        $status = 'In Processing';
                                    } elseif ($order['status'] === 'success') {
                                        $status = 'Success';
                                    }elseif ($order['status'] === 'paid') {
                                        $status = 'Paid';
                                    } else {
                                        $status = 'New';
                                    }
                                    ?>
                                    <td><?=$status?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col clo-md-2" style="margin-top: 65px;">
                    <a href="<?= ADMIN ?>/order/delete?id=<?=$order['id']?>" >
                        <button type="button" data-id="<?=$order['id']?>" class="btn btn-block btn-danger btn-lg delete" style="margin-bottom: 10px;">Delete</button>
                    </a>
                    <a href="<?= ADMIN ?>/order/processing?id=<?=$order['id']?>">
                        <button type="button" class="btn btn-block btn-warning btn-lg processing" style="margin-bottom: 10px;">In Processing</button>
                    </a>
                    <a href="<?= ADMIN ?>/order/success?id=<?=$order['id']?>">
                        <button type="button" class="btn btn-block btn-success btn-lg success" style="margin-bottom: 10px;">Success</button>
                    </a>

                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-9">
                    <div class="card poste">
                        <div class="card-header">
                            <h3 class="card-title">Info is Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Prece</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['product_id'] ?></td>
                                    <td>
                                        <div class="poster">
                                            <a href="/product/<?=$product['alias']?>"><?= $product['title'] ?></a>
                                            <div class="descr">
                                                <img src="/images/<?= $product['img']?>" alt="">
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $product['price'] . ' ' . $order['currency']?></td>
                                    <td><?= $product['qty'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order Note</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?= $order['note']?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>
<!--content-wrapper-end -->
