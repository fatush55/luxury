<!-- Content Wrapper-start Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=ADMIN?>">Home</a> </li>
                        <li class="breadcrumb-item active">Users</li>
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
                <div class="col col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                            <div class="card-tools">
                                <div class="row">
                                    <form action="<?= ADMIN?>/search/user" autocomplete="off">
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
                                    <th class="hide">Email</th>
                                    <th class="hide_full">Login</th>
                                    <th class="hide">Role</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user):?>
                                <tr>
                                    <td><?= $user->id?></td>
                                    <td><?= $user->name?></td>
                                    <td  class="hide" ><?= $user->email?></td>
                                    <td class="hide_full"><?= $user->login?></td>
                                    <td class="hide"><?= $user->role?></td>
                                    <td>
                                        <a href="<?= ADMIN?>/user/show?id=<?=$user->id?>">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= ADMIN?>/user/edit?id=<?=$user->id?>">
                                            <i class="fas fa-pencil-alt"></i>
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
                        <h6>(<?= count($users) ?> Users from <?= $count ?>)</h6>
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

<script src="js/search_user.js"></script>

