<!--breadcrumb-starts-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?= $breadcrumb ?>
            </ol>
        </div>
    </div>
</div>
<!--breadcrumb-end-->
<?php $curr = \luxury\App::$app->getProperty('currency'); ?>
<!--product-starts-->
<div class="product">
    <div class="container">
        <div class="product-top">
            <div class="col-md-3 product-right">
                <div class="w_sidebar">
                    <?php new \app\widgets\filter\Filter() ?>
                </div>
            </div>
            <div class="product-one cal-md-9">
                <?php if (!$products): ?>
                    <div class="not_prod">
                        <h3>There are no product in this category</h3>
                    </div>
                <?php else:; ?>
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
                                            <?= $curr['symbol_left'] ?><?= $product->price * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                        </span>

                                        <?php if ($product->old_price): ?>
                                            <small>
                                                <del>
                                                    <?= $curr['symbol_left'] ?><?= $product->old_price * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                                </del>
                                            </small>
                                        <?php endif; ?>

                                    </h4>
                                </div>
                                <?php if ($product->old_price): ?>
                                    <div class="srch">
                                        <span><?= ceil(($product->old_price - $product->price) / ($product->old_price / 100)) . '%' ?></span>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>

                    <?php endforeach; ?>

                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h4>(<?= count($products) ?> product from <?= $total ?>)</h4>
                        <?php if ($pagination->countPages > 1): ?>
                            <?= $pagination ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--product-end-->

<script type="text/javascript" src="js/filters.js"></script>
