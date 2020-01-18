<?php


namespace app\models;


use luxury\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel
{
    public $attrebutes = [
        'user_id' => '',
        'note' => '',
        'currency' => '',
        'sum' => '',
    ];

    public static function saveOrder($data)
    {
        $data['currency'] = $_SESSION['cart.currency']['code'];
        $data['sum'] = $_SESSION['cart.sum'];

        $order = new Order();
        $order->load($data);
        $order_id = $order->save('order');
        self::saveLog($order_id, $data['user_id'],$_SESSION['cart.sum'], $data['currency']);

        self::saveOrderProduct($order_id);
        return $order_id;
    }

    public static function saveOrderProduct($order_id)
    {
        $sql_part = '';
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $product_id = (int)$product_id;
            $sql_part .= "({$order_id}, {$product_id}, '{$product['title']}','{$product['alias']}','{$product['img']}',
             {$product['qty']}, {$product['price']}),";
        }
        $sql_part = rtrim($sql_part, ',');

        \R::exec("INSERT INTO order_product (order_id, product_id, title, alias, img, qty, price) VALUES  $sql_part");
    }

    public static function mailOrder($order_id, $user_email)
    {
        try {
            $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'),
                App::$app->getProperty('smtp_protocol')))
                ->setUsername(App::$app->getProperty('smtp_login'))
                ->setPassword(App::$app->getProperty('smtp_password'));

            $mailer = new Swift_Mailer($transport);

            //Create message
            ob_start();
            require APP . '/views/mail/mail_order.php';
            $body = ob_get_clean();

            $message_client = (new Swift_Message("You ordered №{$order_id} on " . App::$app->getProperty('smtp_login')))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                ->setTo($user_email)
                ->setBody($body, 'text/html');

            $message_admin = (new Swift_Message("Ordered №{$order_id} from {$user_email}"))
                ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
                ->setTo(App::$app->getProperty('admin_email'))
                ->setBody($body, 'text/html');

            // Send the message
            $result = $mailer->send($message_client);
            $result = $mailer->send($message_admin);
        } catch (\Exception $e) {

        }
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.currency']);
        $_SESSION['success_order'] = 'Thanks for your order. The manager will contact you shortly!';
    }

    public static function getOrder($data, $curr = 'USD')
    {
        $order = 0;
        $currency = \R::find('currency');

        foreach ($data as $v) {
            foreach ($currency as $cur) {
                if ($v['currency'] === $cur['code']) $v['price'] = $v['price'] / $cur['value'];
            }
            $order += $v['price'];
        }

        foreach ($currency as $v) {
            if ($curr === $v['code']) $order = $order * $v['value'];
        }
        return $order;
    }

    public static function getProductsOrder($id)
    {
        $order = [];
        $currencies = App::$app->getProperty('currencies');

        $order = \R::getRow("SELECT ROUND(SUM(`price` * `qty`),2) AS `sum_price`, ROUND(SUM(`qty`),0) AS `sum_qty`
        FROM `order_product` WHERE `order_id` = ?", [$id]);

        $currency = \R::getRow('SELECT `currency` FROM `order` WHERE `id` = ?', [$id]);

        foreach ($currencies as $code => $v) {
            if ($code === $currency['currency']) {
                $order ['symbol_left'] = $currencies[$currency['currency']]['symbol_left'];
                $order ['symbol_right'] = $currencies[$currency['currency']]['symbol_right'];
            }
        }

        return $order;
    }

    public static function getPaymentDate($id)
    {
        if (!empty($_SESSION['payment'])) unset($_SESSION['payment']);
        $_SESSION['payment']['id'] = $id;
        $_SESSION['payment']['sum'] = $_SESSION['cart.sum'];
        $_SESSION['payment']['curr'] = $_SESSION['cart.currency']['code'];
    }

    public static function saveLog($order_id,$user_id, $sum, $currency){
        $time = date("Y-m-d H:i:s");
        $log = 'new?'. $time;

        $tbl = \R::xdispense('order_log');
        $tbl->order_id = $order_id;
        $tbl->user_id = $user_id;
        $tbl->sum = $sum;
        $tbl->currency = $currency;
        $tbl->log = $log;
        $tbl->date = $time;
        $log_id =\R::store($tbl);

        $order = \R::load('order', $order_id);
        $order->log_id = $log_id;
        \R::store($order);
    }
}