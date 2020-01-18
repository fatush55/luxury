<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\User;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $mod_id = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;

        if ($id) {
            $product = \R::findOne('product', 'id = ?', [$id]);
            if (!$product) {
                return false;
            }
            if ($mod_id) {
                $mod = \R::findOne('modification', 'id = ? AND product_id = ?', [$mod_id, $id]);
            }

            $cart = new Cart();
            $cart->addToCart($product, $qty, $mod);
            if ($this->isAjax()) {
                $this->loadView('cart_modal');
            }
            redirect();
        }
        return false;
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;

        if (isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.currency']);
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function countAction()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $qty = isset($_GET['qty']) ? $_GET['qty'] : null;

        if (isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->count($id, $qty);
        }

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function viewAction()
    {
        $this->setMeta('LW | Buy');
    }

    public function checkoutAction()
    {
        if (isset($_POST)) {
            //register
            if (!User::checkAuth()) {
                $user = new User();
                $data = $_POST;

                $user->load($data);
                if (!$user->validate($data) || !$user->checkUnique()) {
                    $_SESSION['form_data'] = $data;
                    $user->getError();
                    redirect();
                } else {
                    $user->attrebutes['password'] = password_hash($user->attrebutes['password'], PASSWORD_DEFAULT);
                    if (!$user_id = $user->save('user')) {
                        $_SESSION['error'] = 'User not registered';
                        redirect();
                    } else {
                        $_SESSION['form_success'] = $data;
                    }
                }
            }

            //save order and append payment date
            $data['user_id'] = isset($user_id) ? $user_id : $_SESSION['user']['id'];
            $data['note'] = isset($_POST['note']) ? $_POST['note'] : '';
            $user_email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];
            $order_id = Order::saveOrder($data);

            if (!empty($_POST['pay'])) {
                Order::getPaymentDate($order_id);
            }

            Order::mailOrder($order_id, $user_email);

            if (!empty($_POST['pay'])) {
                if (!empty($_SESSION['success_order'])) unset($_SESSION['success_order']);
                redirect(PATH . '/payment/form');
            }

            redirect();
        }
    }

    public function paymentAction(){
        $_SESSION['test'][]= $_GET;
        $_SESSION['test'][]= $_POST;
        if (empty($_POST)) die;

        $dataSet = $_POST;
        unset($dataSet['ik_sign']);
        ksort($dataSet, SORT_STRING);
        array_push($dataSet, App::$app->getProperty('ik_key'));
        $signString = implode(':', $dataSet);
        $sign = base64_encode(md5($signString, true));

        $order = \R::load('order', (int)$dataSet['ik_pm_no']);

        if (!$order) die;

        if ($dataSet['ik_co_id'] === App::$app->getProperty('ik_id') && $dataSet['ik_inv_st'] === 'success'
            && $dataSet['ik_am'] === $order->sum && $sign === $_POST['ik_sign'] ) {
            $order->status = 'paid';
            \R::store($order);
        }
        die;
    }

}