<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li>Orders <?= $name ?></li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<div class="container messenger_container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<h3 class="text-center" style="margin-bottom: 50px;">Orders <?= $name ?></h3>
<div class="container boy_container">
    <div class="row">
        <div class="col col-md-12">
            <div class="table-responsive">
                <?php if (!empty($orders)): ?>
                    <table class="table">
                        <tbody>
                        <?php foreach ($orders as $id => $order): ?>
                            <?php
                            if ($order['status'] === 'processing') {
                                $class = 'bg_warning';
                            } elseif ($order['status'] === 'success') {
                                $class = 'bg_success';
                            } elseif ($order['status'] === 'paid') {
                                $class = 'bg_info';
                            } else {
                                $class = 'bg_new';
                            }
                            ?>

                            <tr class="<?= $class ?> order_event" data-id="<?= $id ?>">
                                <td class="text-center line-center">
                                    <p><?= $order['date'] ?></p>
                                </td>
                                <td class="text-center line-center">
                                    <p> <?= $order['update_at'] ?></p>
                                </td>
                                <td class=" line-center">
                                    <p> <?= $order['status'] ?></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty_order_card">
                        <p>Your Order Not Fount</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


