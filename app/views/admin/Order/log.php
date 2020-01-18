<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order #<?= $order_log['order_id'] ?> Log</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/order">Orders List</a></li>
                        <li class="breadcrumb-item active">Order #<?= $order_log['order_id'] ?> Log</li>
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
                            <h3 class="card-title">User : <a href="<?= ADMIN ?>/user/show?id=<?= $order_log['user_id'] ?>">
                                    <?= $order_log['user_name'] ?>
                                </a> | Sum :
                                <?= $order_log['currency'] === 'USD' ||  $order_log['currency'] === 'EUR' ? $order_log['currency'] : ''?>
                                <?= $order_log['sum']?>
                                <?= $order_log['currency'] !== 'USD' ||  $order_log['currency'] !== 'EUR' ? $order_log['currency'] : ''?>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th >Data</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($log_edit)): ?>

                                    <?php foreach ($log_edit as $log): ?>
                                        <?php
                                        if ($log['status'] === 'processing') {
                                            $class = 'bg-purple';
                                        } elseif ($log['status'] === 'success') {
                                            $class = 'bg-success';
                                        }elseif ($log['status'] === 'paid') {
                                            $class = 'bg-primary';
                                        } elseif($log['status'] === 'delete') {
                                            $class = 'bg-danger';
                                        }  else {
                                            $class = 'bg-secondary';
                                        }
                                        ?>
                                        <tr class="<?= $class ?>">
                                            <td><?= $log['date'] ?></td>
                                            <td><?= $log['status'] ?></td>
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