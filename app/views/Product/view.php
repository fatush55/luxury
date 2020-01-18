<link href="css/product.css" rel="stylesheet" type="text/css" media="all"/>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">

                <?= $breadCrumbs ?>

            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">

                        <?php if ($getImg): ?>
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php foreach ($getImg as $img): ?>
                                        <li data-thumb="images/<?= $img->img ?>">
                                            <div class="thumb-image">
                                                <img src="images/<?= $img->img ?>"
                                                     data-imagezoom="true" class="img-responsive" alt=""/></div>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>

                        <?php else: ?>

                            <div class="gallery_fail">
                                <img src="images/<?= $product['img'] ?> " alt="">
                            </div>
                        <?php endif ?>
                        <!-- FlexSlider -->
                        <?php $curr = \luxury\App::$app->getProperty('currency') ?>
                        <?php $cats = \luxury\App::$app->getProperty('cats') ?>
                    </div>
                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?= $product['title'] ?></h2>
                            <div class="star-on">
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <div class="review">
                                    <a href="#"> 1 customer review </a>

                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="price_container">
                                <h5 class="item_price" id="base_price"
                                    data-base-price="<?= $product['price'] * $curr['value'] ?>"
                                    data-base-old-price="<?= $product['old_price'] * $curr['value'] ?>">
                                    <?= $curr['symbol_left'] ?><?= $product['price'] * $curr['value'] ?><?= $curr['symbol_right'] ?>

                                </h5>
                                <h5>
                                    <?php if ($product->old_price): ?>
                                        <small>
                                            <del id="old_price">
                                                <?= $curr['symbol_left'] ?><?= $product->old_price * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                            </del>
                                        </small>
                                    <?php endif; ?>
                                </h5>
                            </div>
                            <?php if ($mods): ?>
                                <div class="available">
                                    <ul>
                                        <li>Color
                                            <select>
                                                <option>Choose Color</option>

                                                <?php foreach ($mods as $mod): ?>

                                                    <option data-title="<?= $mod->title ?>"
                                                            data-price="<?= $mod->price * $curr['value'] ?>"
                                                            data-old-price="<?= $mod->old_price * $curr['value'] ?>"
                                                            value="<?= $mod->id ?>">
                                                        <?= $mod->title ?>
                                                    </option>

                                                <?php endforeach; ?>

                                            </select>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <ul class="tag-men">
                                <li><span>CATEGORY: </span>
                                    <a href="category/<?= $cats[$product['category_id']]['alias'] ?>">
                                        <?= $cats[$product['category_id']]['title'] ?>
                                    </a>
                                </li>
                            </ul>

                            <div class="add_count_product">
                                <div class="quantity">
                                    <input type="number" min="1" max="9" step="1" value="1" name="quantity">
                                </div>

                                <div class="add_button">
                                    <a id="productAdd" href="card/add?id=<?= $product['id'] ?>"
                                       data-id="<?= $product['id'] ?>"
                                       class="add-cart item_add add-to-cart-link">ADD TO CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tabs">
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="images/arrow.png" alt="">Description</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="images/arrow.png" alt="">Additional information</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="images/arrow.png" alt="">Reviews (10)</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="images/arrow.png" alt="">Helpful Links</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="images/arrow.png" alt="">Make A Gift</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>



                <div class="col clo-md-12" style="margin: 100px 0 100px 0">
                    <p><?= $product['content'] ?></p>
                </div>



                <?php if ($related): ?>
                    <h3>Related Products</h3>
                    <div class="latestproducts">
                        <div class="product-one">

                            <?php foreach ($related as $item): ?>

                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="product/<?= $item['alias'] ?>" class="mask"><img
                                                    class="img-responsive zoom-img"
                                                    src="images/<?= $item['img'] ?>" alt=""/></a>
                                        <div class="product-bottom">
                                            <a href="product/<?= $item['alias'] ?>" style="text-decoration: none">
                                                <h3><?= $item['title'] ?></h3></a>
                                            <p>Explore Now</p>
                                            <h4>
                                                <a class="item_add add-to-cart-link"
                                                   href="cart/add?id=<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
                                                    <i></i>
                                                </a>
                                                <span class=" item_price">
                                                    <?= $curr['symbol_left'] ?><?= $item['price'] * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                                </span>

                                                <?php if ($item['old_price']): ?>
                                                    <small>
                                                        <del>
                                                            <?= $curr['symbol_left'] ?><?= $item['old_price'] * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                                        </del>
                                                    </small>
                                                <?php endif; ?>
                                            </h4>
                                        </div>

                                        <?php if ($item['old_price']): ?>
                                            <div class="srch">
                                                <span><?= ceil(($item['old_price'] - $item['price']) / ($item['old_price'] / 100)) . '%' ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                <?php endif; ?>


                <?php if ($recently): ?>
                    <h3>Recently Viewed</h3>
                    <div class="latestproducts">
                        <div class="product-one">

                            <?php foreach ($recently as $item): ?>

                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="product/<?= $item['alias'] ?>" class="mask"><img
                                                    class="img-responsive zoom-img"
                                                    src="images/<?= $item['img'] ?>" alt=""/></a>
                                        <div class="product-bottom">
                                            <a href="product/<?= $item['alias'] ?>" style="text-decoration: none">
                                                <h3><?= $item['title'] ?></h3></a>
                                            <p>Explore Now</p>
                                            <h4>
                                                <a class="item_add add-to-card-link"
                                                   href="cart/add?id=<?= $item['id'] ?>" data-id="<?= $item['id'] ?>">
                                                    <i></i></a>
                                                <span class=" item_price">
                                                    <?= $curr['symbol_left'] ?><?= $item['price'] * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                                </span>

                                                <?php if ($item['old_price']): ?>
                                                    <small>
                                                        <del>
                                                            <?= $curr['symbol_left'] ?><?= $item['old_price'] * $curr['value'] ?><?= $curr['symbol_right'] ?>
                                                        </del>
                                                    </small>
                                                <?php endif; ?>
                                            </h4>
                                        </div>

                                        <?php if ($item['old_price']): ?>
                                            <div class="srch">
                                                <span><?= ceil(($item['old_price'] - $item['price']) / ($item['old_price'] / 100)) . '%' ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endforeach; ?>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                <?php endif; ?>


            </div>
            <div class="col-md-3 single-right">
                <div class="w_sidebar">
                    <section class="sky-form">
                        <h4>Catogories</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>All
                                    Accessories</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Women
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kids
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Men
                                    Watches</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Brand</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>kurtas</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sonata</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Titan</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Casio</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Omax</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fastrack</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sports</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fossil</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Maxima</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yepme</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Citizen</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diesel</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Colour</h4>
                        <ul class="w_nav2">
                            <li><a class="color1" href="#"></a></li>
                            <li><a class="color2" href="#"></a></li>
                            <li><a class="color3" href="#"></a></li>
                            <li><a class="color4" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                            <li><a class="color12" href="#"></a></li>
                            <li><a class="color13" href="#"></a></li>
                            <li><a class="color14" href="#"></a></li>
                            <li><a class="color15" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                        </ul>
                    </section>
                    <section class="sky-form">
                        <h4>discount</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio" checked=""><i></i>60 % and
                                    above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>50 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>40 % and above</label>
                            </div>
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio"><i></i>30 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>20 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>10 % and above</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--end-single-->

<script type="text/javascript" src="js/imagezoom.js"></script>
<script type="text/javascript" src="js/modification_product.js"></script>
<script type="text/javascript" src="js/input_number.js"></script>

