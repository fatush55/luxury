<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Home</a></li>
                <li>Buy</li>
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
    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="container boy_container">
            <h3 class="text-center">Buy</h3>
            <div class="row">
                <div class="col col-md-12">
                    <div class="table-responsive">
                        <table class="table  table-hover table-striped">
                            <tbody>
                            <?php foreach ($_SESSION['cart'] as $id => $item): ?>

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
                                            <?= $_SESSION['cart.currency']['symbol_left'] ?>

                                            <?= $item['price'] ?>

                                            <?= $_SESSION['cart.currency']['symbol_right'] ?>
                                        </p>
                                    </td>
                                    <td class="text-center  line-center">
                                        <p>
                                            <?= $_SESSION['cart.currency']['symbol_left'] ?><?= $item['price'] * $item['qty'] ?><?= $_SESSION['cart.currency']['symbol_right'] ?>
                                        </p>
                                    </td>
                                    <td class="delete-product  img-center" data-id="<?= $id ?>">
                                        <a href="/cart/delete/?id=<?= $id ?>">
                                            <img src="/images/icons/trash.svg" width="32" height="32"
                                                 title="Bootstrap">
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                            </tbody>
                        </table>
                        <table class="table  table-hover table-striped ">
                            <tr>
                                <td>
                                    <h4> Sum: <?= $_SESSION['cart.currency']['symbol_left'] ?>
                                        <?= $_SESSION['cart.sum'] ?>
                                        <?= $_SESSION['cart.currency']['symbol_right'] ?>
                                        <span>
                                        Total: <?= $_SESSION['cart.qty'] ?>
                                    </span>
                                    </h4>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end-product-buy-->

        <!--start-messenger-error-->
        <div class="container messenger_container">
            <div class="row">
                <div class="col col-md-6 col-md-offset-3">
                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['success_order '])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success_order'];
                            //                        unset($_SESSION['error']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--end-messenger-error-->

        <!--register-start-->
        <div class="container form_reg">
            <div class="row">
                <div class="col col-md-8 col-md-offset-3 account-left">
                    <form role="form" data-toggle="validator" id="signup_form" method="post" action="/cart/checkout">

                        <?php if (!isset($_SESSION['user'])): ?>

                            <div class="form-group has-feedback">
                                <label for="login">Login</label>
                                <input name="login" type="text" class="form-control" id="login"
                                       placeholder="Enter login" required
                                       data-error="Login must be at least 4 characters and should consist of letters and numbers"
                                       value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''; ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group ">
                                <div class="form-inline row">
                                    <div class="form-group col-md-5 has-feedback">
                                        <label for="inputPassword" class="control-label">Password</label>
                                        <input name="password" type="password" data-minlength="6" class="form-control"
                                               id="inputPassword"
                                               placeholder="Password" data-error="Minimum of 6 characters" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-5 has-feedback pas_ver">
                                        <label for="inputPassword" class="control-label ">Password verification</label>
                                        <input type="password" class="form-control" id="inputPasswordConfirm"
                                               data-match="#inputPassword" data-match-error="Whoops, these don't match"
                                               placeholder="Confirm" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="email">Email address</label>
                                <input name="email" type="email" class="form-control" id="email"
                                       aria-describedby="emailHelp" required
                                       data-error="We'll never share your email with anyone else."
                                       value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ''; ?>">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group has-feedback">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name"
                                       placeholder="name" required
                                       value="<?= isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : ''; ?>">

                            </div>
                            <div class="form-group has-feedback">
                                <label for="address">Address</label>
                                <input name="address" type="text" class="form-control" id="address"
                                       placeholder="Address" required
                                       value="<?= isset($_SESSION['form_data']['address']) ? h($_SESSION['form_data']['address']) : ''; ?>">
                            </div>

                        <?php endif; ?>

                        <div class="form-group col-md-12 note">
                            <label for="note">Note</label>
                            <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="pay" name="pay" >
                            <label for="pay">
                                Pay Now
                            </label>
                        </div>

                        <div class="form-group">
                            <button id="singnup_btn" type="submit" class="btn btn-primary">Buy</button>
                        </div>
                    </form>
                    <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']) ?>
                </div>
            </div>
        </div>

        <!--register-end-->
    <?php else: ?>
        <h3 class="text-center buy_found">Buy not found</h3>
    <?php endif; ?>

<?php endif; ?>

