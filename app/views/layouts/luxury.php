<!DOCTYPE html>
<html>
<head>
    <base href="/">
    <?= $this->getMeta() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <?php if (!empty($canonical)): ?>
        <link rel="canonical" href="<?= $canonical ?>">
    <?php endif; ?>

    <link rel="shortcut icon" href="images/star.png" type="image/png"/>
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="fontawesome/css/all.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="megamenu/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="megamenu/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>


    <?php foreach ($styles as $style) {
        echo $style;
    } ?>

</head>
<body>

<?php //debug($_SESSION)?>
<?php //unset($_SESSION['test'])?>


<!--top-header-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                <div class="drop">
                    <div class="box">
                        <select id="currency" tabindex="4" class="dropdown drop">
                            <?php new \app\widgets\currency\Currency() ?>
                        </select>
                    </div>
                    <div class="box1">
                        <select tabindex="4" class="dropdown">
                            <option value="" class="label">English :</option>
                            <option value="1">English</option>
                            <option value="2">French</option>
                            <option value="3">German</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-6 top-header-left box_content">
                <div class="cart box_1">

                    <div class="enter_lw">

                        <?php if (empty($_SESSION['user'])): ?>
                            <a class="box_mod_user_0" href="/users/show" title="To enter you need to register or login">
                                <p>Enter in cabinet</p>
                                <i class="fas fa-user"></i>
                            </a>
                        <?php else: ?>
                            <div class="box_user_true">
                                <div>
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <a class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="name_user"><?= $_SESSION['user']['name'] ?></span>
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                                <li><a href="<?= ADMIN ?>">Admin<i class="fas fa-user-shield"></i></a>
                                                </li>
                                            <?php endif; ?>

                                            <li><a href="user/edit">Edit Account <i class="fas fa-user-cog"></i></a>
                                            </li>
                                            <li><a href="user/orders">My Order <i class="fas fa-dolly"></i></a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="user/logout">Logout <i class="fas fa-sign-out-alt"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <img src="images/users/<?= $_SESSION['user']['img'] ?>" alt="" height="35">
                                </div>

                            </div>
                        <?php endif; ?>

                    </div>
                    <a href="cart/show" id="show_cart" class="box_mod_cart">
                        <div class="total">

                            <?php if (!empty($_SESSION['cart.qty'])): ?>
                                <div class="quantity-icon" style="opacity: 1">
                                    <?= $_SESSION['cart.qty'] ?>
                                </div>
                            <?php else: ?>
                                <div class="quantity-icon"></div>
                            <?php endif; ?>

                            <i class="fas fa-shopping-basket"></i>

                            <?php if (!empty($_SESSION['cart.sum'])): ?>
                                <p class="simpleCart_total">
                                    <?= $_SESSION['cart.currency']['symbol_left'] ?>
                                    <?= $_SESSION['cart.sum'] ?>
                                    <?= $_SESSION['cart.currency']['symbol_right'] ?>
                                </p>
                            <?php else: ?>
                                <p class="simpleCart_total">Empty Cart</p>
                            <?php endif; ?>

                        </div>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--start-logo-->
<div class="logo">
    <a href=""><h1>Luxury Watches</h1></a>
</div>
<!--start-logo-->
<!--bottom-header-->
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="menu-container">
                    <div class="menu">
                        <?php new \app\widgets\Menu\Menu([
                            'tml' => WWW . '/menu/menu.php',
                        ]); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3 header-right">
                <div class="search-bar">
                    <form action="search" autocomplete="off">
                        <input type="text" class="typeahead" id="typeahead" name="s" placeholder="Search">
                        <input type="submit" value="">
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--bottom-header-->

<div class="content">
    <?= $content ?>
</div>

<!--information-starts-->
<div class="information">
    <div class="container">
        <div class="infor-top">
            <div class="col-md-3 infor-left">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                    <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                    <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Information</h3>
                <ul>
                    <li><a href="#"><p>Specials</p></a></li>
                    <li><a href="#"><p>New Products</p></a></li>
                    <li><a href="#"><p>Our Stores</p></a></li>
                    <li><a href="contact.html"><p>Contact Us</p></a></li>
                    <li><a href="#"><p>Top Sellers</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>My Account</h3>
                <ul>
                    <li><a href="account.html"><p>My Account</p></a></li>
                    <li><a href="#"><p>My Credit slips</p></a></li>
                    <li><a href="#"><p>My Merchandise returns</p></a></li>
                    <li><a href="#"><p>My Personal info</p></a></li>
                    <li><a href="#"><p>My Addresses</p></a></li>
                </ul>
            </div>
            <div class="col-md-3 infor-left">
                <h3>Store Information</h3>
                <h4>The company name,
                    <span>Lorem ipsum dolor,</span>
                    Glasglow Dr 40 Fe 72.</h4>
                <h5>+955 123 4567</h5>
                <p><a href="mailto:example@email.com">contact@example.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->

<!--preloader-start-->
<div class="preloader">
    <img src="images/ring.svg" alt="">
</div>
<!--preloader-end-->


<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
                <form>
                    <input type="text" value="Enter Your Email" onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
                    <input type="submit" value="Subscribe">
                </form>
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2015 Luxury Watches. All Rights Reserved | Design by
                    <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>


<!--modal cart-starts-->
<div class="modal" id="cart" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <h3 class="modal-title text-center">Shopping Cart</h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a id="buy" href="cart/view" type="button" class="btn btn-success">Buy</a>
                <button id="shopping" type="button" class="btn btn-warning" data-dismiss="modal">Shopping</button>
                <button id="empty_trash" type="button" class="btn btn-danger">Empty trash</button>
            </div>
        </div>
    </div>
</div>
<!--modal cart-end-->


<!--modal user-starts-->
<div class="modal" id="user" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <h3 class="modal-title text-center">Enter in shop Luxury Watches</h3>
            </div>
            <div class="modal-body ">

            </div>
            <div class="modal-footer" style="padding-top: 40px">

            </div>
        </div>
    </div>

</div>
<!--modal user-end-->

<script>
    let path = '<?= PATH ?>';
    let curse = '<?=$curr['value'] ?>';
    let symbolRight = '<?=$curr['symbol_right'] ?>';
    let symbolLeft = '<?=$curr['symbol_left'] ?>';
</script>


<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validator.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.easydropdown.js"></script>
<script type="text/javascript" src="js/responsiveslides.min.js"></script>
<script type="text/javascript" defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript" src="fontawesome/js/all.min.js"></script>


<script type="text/javascript" src="js/shopping_cart.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/currency.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="megamenu/js/megamenu.js"></script>

<?php foreach ($scripts as $script) {
    echo $script;
} ?>

</body>
</html>









