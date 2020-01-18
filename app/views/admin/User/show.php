<link rel="stylesheet" href="css/user_show.css">
<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User #<?= $user->id ?> Show</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>/user">Users</a></li>
                        <li class="breadcrumb-item active">User #<?= $user->id ?> Show</li>
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

                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username"><?= $user->name ?></h3>
                            <h5 class="widget-user-desc"><?= $user->email ?></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                 src="/images/users/<?= $user->img ?> "
                                 alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link">
                                        Total Sum of Orders <span class="float-right badge bg-info">
                                                <?= $sumOrder ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        New Order <span class="float-right badge bg-info">
                                            <?= $orders_new ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        Success Order <span class="float-right badge bg-info">
                                            <?= $orders_success ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        Sale <span class="float-right badge bg-info">0%</span>
                                    </a>
                                </li>

                            </ul>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <?php if (!empty($orders)): ?>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sum</th>
                                    <th>Date</th>
                                    <th>Upgrade Date</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="tbody_hidden">

                                <?php foreach ($orders as $order): ?>
                                    <?php
                                    if ($order['status'] === 'processing') {
                                        $class = 'bg-purple';
                                        $status = 'In Processing';
                                    } elseif ($order['status'] === 'success') {
                                        $class = 'bg-success';
                                        $status = 'Success';
                                    }elseif ($order['status'] === 'paid') {
                                        $class = 'bg-primary';
                                        $status = 'Paid';
                                    } else {
                                        $class = 'bg-secondary';
                                        $status = 'New';
                                    }
                                    ?>
                                    <tr class="<?= $class ?>">
                                        <td><?= $order['id'] ?></td>
                                        <td><?= $order['price'] . ' ' . $order['currency'] ?></td>
                                        <td><?= $order['date'] ?></td>
                                        <td><?= $order['update_at'] ?></td>
                                        <td><?= $status ?></td>
                                        <td>
                                            <a  style="color: #000;" href="<?= ADMIN ?>/order/view?id=<?= $order['id'] ?>&user_id=<?= $order['user_id'] ?>">
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
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <?php else: ?>

                 <div class="col col-md-8">
                     <div class="callout callout-danger" style="margin-top: 135px">
                         <h5>Order not found!</h5>

                         <p>This user has not had orders yet</p>
                     </div>
                 </div>
                <?php endif; ?>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!--content-wrapper-end -->





