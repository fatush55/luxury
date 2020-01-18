<?php


namespace app\models;


use luxury\App;

class Cart extends AppModel
{
    public function addToCart($product, $qty, $mod = null)
    {
        if (!isset($_SESSION['cart.currency'])) {
            $_SESSION['cart.currency'] = App::$app->getProperty('currency');
        }

        if ($mod) {
            $ID = "{$product->id}-{$mod->id}";
            $title = "{$product->title} ({$mod->title})";
            $price = $mod->price;
        } else {
            $ID = $product->id;
            $title = $product->title;
            $price = $product->price;
        }

        if (isset($_SESSION['cart'][$ID])) {
            $_SESSION['cart'][$ID]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$ID] = [
                'qty' => $qty,
                'title' => $title,
                'alias' => $product->alias,
                'price' => $price * $_SESSION['cart.currency']['value'],
                'img' => $product->img
            ];
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] +
            $qty * ($price * $_SESSION['cart.currency']['value']) : $qty * ($price * $_SESSION['cart.currency']['value']);
    }

    public function deleteItem($id)
    {
        $qty = $_SESSION['cart'][$id]['qty'];
        $sum = $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -= $qty;
        $_SESSION['cart.sum'] -= $sum * $qty;
        unset($_SESSION['cart'][$id]);
    }

    public function count($id, $qty){

        if ($_SESSION['cart'][$id]['qty'] < $qty &&  $qty <= 9){
            $count = $qty - $_SESSION['cart'][$id]['qty'];
        } elseif($_SESSION['cart'][$id]['qty'] > $qty &&  $qty >= 1) {
            $count = $qty - $_SESSION['cart'][$id]['qty'];
        } else {
            $count = 0;
        }

        $_SESSION['cart.qty'] += $count;

        $_SESSION['cart.sum'] = ($_SESSION['cart.sum'] - $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['qty'])
            + ($_SESSION['cart'][$id]['price'] * $qty);
        $_SESSION['cart'][$id]['qty'] = $qty;
    }

    public static function recalc($curr)
    {
        if (!empty($_SESSION['cart.currency'])) {
            if ($_SESSION['cart.currency']['base']) {
                $_SESSION['cart.sum'] *= $curr->value;
            } else {
                $_SESSION['cart.sum'] = $_SESSION['cart.sum'] / $_SESSION['cart.currency']['value'] * $curr->value      ;
            }

            foreach ($_SESSION['cart'] as $k => $v) {
                if ($_SESSION['cart.currency']['base']) {
                    $_SESSION['cart'][$k]['price'] *= $curr->value;
                } else {
                    $_SESSION['cart'][$k]['price'] = $_SESSION['cart'][$k]['price'] / $_SESSION['cart.currency']['value'] * $curr->value;
                }
            }

            foreach ($curr as $k => $v){
                $_SESSION['cart.currency'][$k] = $v;
            }
        }
    }


}