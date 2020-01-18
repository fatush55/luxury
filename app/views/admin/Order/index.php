<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Orders List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item active">Orders List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!--Alert Error and Success start-->
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
    <!--Alert Error and Success end-->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th class="hide">Sum</th>
                                    <th class="hide_full">Date</th>
                                    <th class="hide">Upgrade Date</th>
                                    <th class="hide">Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($orders)): ?>

                                    <?php foreach ($orders as $order): ?>
                                        <?php
                                        if ($order['status'] === 'processing') {
                                            $class = 'bg-purple';
                                            $status = 'In Processing';
                                            $style = " style=' color: white;'";
                                        } elseif ($order['status'] === 'success') {
                                            $class = 'bg-success';
                                            $status = 'Success';
                                            $style = " style=' color: white;'";
                                        }elseif ($order['status'] === 'paid') {
                                            $class = 'bg-primary';
                                            $status = 'Paid';
                                            $style = " style=' color: white;'";
                                        } else {
                                            $class = 'bg-secondary';
                                            $status = 'New';
                                            $style = " style=' color: white;'";
                                        }
                                        ?>
                                        <tr class="<?= $class ?>">
                                            <td><?= $order['id'] ?></td>
                                            <td>
                                                <a href="<?= ADMIN ?>/user/show?id=<?= $order['user_id'] ?>" <?=$style?>>
                                                    <?= $order['name'] ?>
                                                </a>
                                            </td>
                                            <td class="hide"><?= $order['sum'] . ' ' . $order['currency'] ?></td>
                                            <td class="hide_full"><?= $order['date'] ?></td>
                                            <td class="hide"><?= $order['update_at'] ?></td>
                                            <td class="hide"><?= $status ?></td>
                                            <td>
                                                <a style="color: #000;" href="<?= ADMIN ?>/order/log?id=<?= $order['log_id'] ?>">
                                                    <i class="fas fa-clipboard-list"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a style="color: #000;" href="<?= ADMIN ?>/order/view?id=<?= $order['id'] ?>&user_id=<?= $order['user_id'] ?>">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?= ADMIN ?>/order/delete?id=<?= $order['id'] ?>"
                                                   data-id="<?= $order['id'] ?>" class="text-danger delete">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="float-right" style="margin: 35px">
                        <h6>(<?= count($orders) ?> orders from <?= $count ?>)</h6>
                        <?php if ($pagination->countPages > 1): ?>
                            <?= $pagination ?>
                        <?php endif; ?>
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