<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li><a href="<?= PATH ?>/user/orders">Orders <?= $name ?></a></li>
                <li>Order <?= $id?></li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->


<!--start-messenger-success-order-->

<?php if (!empty($_SESSION['success_order'])): ?>
    <div class="container success_order">
        <div class="row">
            <div class="col col-md-6 col-md-offset-3">
                <div class="alert alert-success">
                    <?php echo $_SESSION['success_order'];
                    unset($_SESSION['success_order']) ?>
                </div>
            </div>
        </div>
    </div>

<?php else: ?><!--end-messenger-success-order-->

    <!--start-product-buy-->
    <?php if (!empty($products)): ?>
        <div class="container boy_container">
            <h3 class="text-center">Order <?= $id?></h3>
            <div class="row">
                <div class="col col-md-12">
                    <div class="table-responsive">
                        <table class="table  table-hover table-striped">
                            <tbody>
                            <?php foreach ($products as $id => $item): ?>

                                <tr>
                                    <td>
                                        <a href="product/<?= $item['alias'] ?>">
                                            <img src="images/<?= $item['img'] ?>" alt="<?= $item['title'] ?>"
                                                 height="60">
                                        </a>
                                    </td>
                                    <td class="text-center line-center">
                                        <a href="product/<?= $item['alias'] ?>">
                                            <?= $item['title'] ?>
                                        </a>
                                    </td>
                                    <td class=" line-center">
                                        <p><?= $item['qty'] ?></p>
                                    </td>
                                    <td class="text-center  line-center">
                                        <p>
                                            <?= $order['symbol_left'] ?>

                                            <?= $item['price'] ?>

                                            <?= $order['symbol_right'] ?>
                                        </p>
                                    </td>
                                    <td class="text-center  line-center">
                                        <p>
                                            <?= $order['symbol_left'] ?><?= $item['price'] * $item['qty'] ?><?= $order['symbol_right'] ?>
                                        </p>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                            </tbody>
                        </table>
                        <table class="table  table-hover table-striped ">
                            <tr>
                                <td>
                                    <h4> Sum: <?= $order['symbol_left'] ?>
                                        <?= $order['sum_price'] ?>
                                        <?= $order['symbol_right'] ?>
                                        <span>
                                        Total: <?= $order['sum_qty'] ?>
                                    </span>
                                    </h4>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end-product-buy-->
    <?php else: ?>
        <h3 class="text-center buy_found">Buy not found</h3>
    <?php endif; ?>

<?php endif; ?>


