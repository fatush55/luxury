<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Currency</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= ADMIN ?>">Home</a></li>
                        <li class="breadcrumb-item active">Currency</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!--    --><?php //debug($_SESSION); ?>

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
                <div class="col clo-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Currency</h3>
                        </div>
                        <div class="card-body table-relative p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="hide">Id</th>
                                    <th class="hide_full">Name</th>
                                    <th>Code</th>
                                    <th>Rate</th>
                                    <th class="hide_full">Role</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($currency as $item): ?>
                                    <tr <?php if ($item->base === '1') echo ' class="bg-warning"' ?> >
                                        <td class="hide"><?= $item->id ?></td>
                                        <td class="hide_full"><?= $item->title ?></td>
                                        <td><?= $item->code ?></td>
                                        <td><?= $item->value ?></td>
                                        <?php if ($item->base === '1'): ?>
                                            <td class="hide_full">BASE</td>
                                        <?php else: ?>
                                            <td class="hide_full"></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?= ADMIN ?>/currency/edit?id=<?= $item->id ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($item->base !== '1'): ?>
                                            <a class="delete text-danger"
                                               href="<?= ADMIN ?>/currency/delete?id=<?= $item->id ?>">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!--content-wrapper-end -->


