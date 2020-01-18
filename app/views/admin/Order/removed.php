<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order Removed Log</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item active">Order Removed Log</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Removed</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>User</th>
                                    <th>Sum</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($order_log)): ?>

                                    <?php foreach ($order_log as $log): ?>
                                        <tr class="bg-danger">
                                            <td><?= $log['order_id'] ?></td>
                                            <td>
                                                <a style="color: white" href="<?= ADMIN ?>/user/show?id=<?= $log['user_id'] ?>">
                                                    <?= $log['user_name'] ?>
                                            </td>
                                            <td>
                                                <?= $log['currency'] === 'USD' ||  $log['currency'] === 'EUR' ? $log['currency'] : ''?>
                                                <?= $log['sum']?>
                                                <?= $log['currency'] !== 'USD' ||  $log['currency'] !== 'EUR' ? $log['currency'] : ''?>
                                            </td>
                                            <td><?= $log['date'] ?></td>
                                            <td>
                                                <a style="color: #000;" href="<?= ADMIN ?>/order/log?id=<?= $log['id'] ?>">
                                                    <i class="fas fa-clipboard-list"></i>
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
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
</div>



<!--content-wrapper-end -->