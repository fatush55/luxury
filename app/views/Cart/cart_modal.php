<?php if (!empty($_SESSION['cart'])): ?>
    <div class="table-responsive">
        <table class="table  table-hover table-striped ">
            <tbody class="table_cart">
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>

                <tr>
                    <td>
                        <a href="product/<?= $item['alias'] ?>">
                            <img src="images/<?= $item['img'] ?>" alt="<?= $item['title'] ?>" height="60">
                        </a>
                    </td>
                    <td class="text-center title_prod_card line-center">
                        <a href="product/<?= $item['alias'] ?>">
                            <?= $item['title'] ?>
                        </a>
                    </td>
                    <td class="text-center line-center">
                        <div class="cart_qty_product">
                            <input class="cqp_input" type="number" name="cqp" min="1" max="9"
                                   value="<?= $item['qty'] ?>" disabled="disabled"
                                   data-id="<?= $id ?>">
                            <div class="cqp-nav">
                                <div class="cqp-button cqp-up" >+</div>
                                <div class="cqp-button cqp-down">-</div>
                            </div>
                        </div>
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
                    <td id="delete-product" class="delete-product  img-center" data-id="<?= $id ?>">
                        <img src="/images/icons/trash.svg" width="32" height="32"
                             title="Bootstrap">
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
        <div class="main_total">
            <div class="total">
                <div class="left-total">SUM</div>
                <div class="right-total sum">
                    <?= $_SESSION['cart.currency']['symbol_left'] ?>
                    <?= $_SESSION['cart.sum'] ?>
                    <?= $_SESSION['cart.currency']['symbol_right'] ?>
                </div>
            </div>
            <div class="total">
                <div class="left-total ">TOTAL</div>
                <div class="right-total qty_item">
                    <?= $_SESSION['cart.qty'] ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <h3>Cart is empty</h3>
<?php endif; ?>

