<!--breadcrumb-starts-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href='/'>Home</a></li>
                <li>Payment Failed</li>
            </ol>
        </div>
    </div>
</div>
<!--breadcrumb-end-->

<?php $curr = \luxury\App::$app->getProperty('currency'); ?>

<div class="row box_pay">
    <?php if (!empty($_SESSION['payment'])): ?>
    <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
        <input type="hidden" name="ik_co_id" value="5e15bd4c1ae1bd15008b4597"/>
        <input type="hidden" name="ik_pm_no" value="<?= $_SESSION['payment']['id']?>"/>
        <input type="hidden" name="ik_am" value="<?= $_SESSION['payment']['sum']?>"/>
        <input type="hidden" name="ik_cur" value="<?= $_SESSION['payment']['curr']?>"/>
        <input type="hidden" name="ik_desc" value="Payment at the store luxury "/>
    </form>
    <?php endif; ?>
</div>

<script type="text/javascript" src="js/payment.js"></script>




