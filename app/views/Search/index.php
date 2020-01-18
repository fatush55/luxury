<!--breadcrumb-starts-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href='/'>Home</a></li>
                <li><?= h($query) ?></li>
            </ol>
        </div>
    </div>
</div>
<!--breadcrumb-end-->

<!--product-starts-->
<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<div class="product">
    <div class="container">
        <div class="product-top">
            <div class="product-one">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>

                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="product/<?= $product->alias ?>" class="mask">
                                    <img class="img-responsive zoom-img" src="images/<?= $product->img ?>" alt=""/></a>
                                <div class="product-bottom">
                                    <a href="product/<?= $product->alias ?>" style="text-decoration: none">
                                        \<h3><?= $product->title ?></h3></a>
                                    <p>Explore Now</p>
                                    <h4>
                                        <a class="add-to-cart-link" href="cart/add?id=<?= $product->id ?>"
                                           data-id="<?= $product->id ?>">
                                            <i></i>
                                        </a>
                                        <span class=" item_price">
                                            <?= $curr['symbol_left'] ?>
                                            <?= $product->price * $curr['value'] ?>
                                            <?= $curr['symbol_right'] ?>
                                        </span>

                                        <?php if ($product->old_price): ?>
                                            <small>
                                                <del>
                                                    <?= $curr['symbol_left'] ?>
                                                    <?= $product->old_price * $curr['value'] ?>
                                                    <?= $curr['symbol_right'] ?>
                                                </del>
                                            </small>
                                        <?php endif; ?>

                                    </h4>
                                </div>
                                <?php if ($product->old_price): ?>
                                    <div class="srch">
                                        <span>
                                            <?= ceil(($product->old_price - $product->price)
                                                / ($product->old_price / 100)) . '%' ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else:; ?>

                    <div class="text-center">
                        <h3>This "<?= h($query) ?>" request not found</h3>
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="text-center">
            <?php if (!empty($products)): ?>
                <h4>(<?= count($products) ?> product from <?= $total ?>)</h4>
                <?php if ($pagination->countPages > 1): ?>
                    <?= $pagination ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--product-end-->