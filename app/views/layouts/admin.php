<!DOCTYPE html >
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?= $this->getMeta() ?>

    <base href="/adminLTE/">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= PATH?>/images/star.png" type="image/png" />


    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

<!--    <link rel="stylesheet" href="adminLTE/dist/css/formValidation.min.css">-->


    <!-- my admin style-->
    <link rel="stylesheet" href="css/admin_style.css">



    <?php foreach ($styles as $style) {
        echo $style;
    } ?>

<!--    --><?php //debug($_SESSION, 1); ?>
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/images/users/<?= $_SESSION['user']['img'] ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="<?= PATH?>" class="d-block"><?= $_SESSION['user']['name']?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?= ADMIN?>" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= ADMIN?>/order" class="nav-link">
                            <i class="nav-icon fas fa-shopping-basket"></i>
                            <p>
                                Orders
                               <span class="right badge badge-danger"><?= $_SESSION['newOrders']?></span>
                               <span class="right badge badge-success"><?= $_SESSION['paidOrders']?></span>
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= ADMIN?>/order/removed" class="nav-link">
                            <i class="nav-icon fas fa-trash"></i>
                            <p>
                                Removed Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a  class="nav-link treeview">
                            <i class="nav-icon fas fa-align-left"></i>

                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/category" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/category/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-gifts"></i>
                            <p>
                                Product
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/product" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/product/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= ADMIN?>/cache" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Caching
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/user" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/user/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New user</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-filter"></i>
                            <p>
                                Filters
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/filter/group" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of Group Filter </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/filter/group-add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Group Filter </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/filter/attribute" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of Attribute Filter </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/filter/attribute-add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Attribute Filter </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Currency
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/currency" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of Currency </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN?>/currency/add" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Currency</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <?= $content?>

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.1
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
    let path = '<?=PATH?>',
        adminpath = '<?=ADMIN?>';
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>

<script src="plugins/select2/js/select2.full.min.js"></script>

<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script type="text/javascript" src="/js/typeahead.bundle.js"></script>

<script src="js/ajaxupload.js"></script>

<script type="text/javascript" src="/js/validator.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
<script src="dist/js/demo.js"></script>
<script src="js/main.js"></script>
<script src="js/order.js"></script>
<script src="js/sidebar.js"></script>



<?php foreach ($scripts as $script) {
    echo $script;
} ?>


<?php
//$login = R::getDatabaseAdapter()
//    ->getDatabase()
//    ->getLogger();
//debug($login->grep('SELECT'));
//?>

</body>
</html>

