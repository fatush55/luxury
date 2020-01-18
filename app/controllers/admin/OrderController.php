<?php


namespace app\controllers\admin;


use app\models\Order;
use luxury\App;
use luxury\libs\Pagination;

class OrderController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('order');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`status`, `order`.`date`, `order`.`update_at`,
        `order`.`currency`, `order`.`note`,`order`.`log_id`, `user`.`name`, `user`.`id` AS `user_id`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
        JOIN `user` ON `order`.`user_id` = `user`.`id` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
        GROUP BY  `order`.`id` ORDER BY `order`.`status`, `order`.`date` DESC LIMIT $start, $perpage");

        $this->setMeta('Admin | Orders');
        $this->setData(compact('pagination', 'count', 'orders'));
    }

    public function viewAction()
    {
        $order_id = $this->getId();
        $user_id = $this->getId(1, 'user_id');

        $order = \R::getRow("SELECT `order`.*, `user`.`name`, `user`.`email`, `user`.`img`,
        ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order` 
        JOIN `user` ON `order`.`user_id` = `user`.`id` JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
        WHERE `order`.`id` = ?
        GROUP BY  `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);

        $products = \R::findAll('order_product', "order_id = ?", [$order_id]);

        $order_total = \R::getAll("
        SELECT `order_product`.`price` AS `price`, `order_product`.`qty`, `order`.`currency`
        FROM  `order_product` JOIN `order` ON `order_product`.`order_id` = `order`.`id`
        WHERE `order`.`user_id` = ? AND `order`.`status` = 'success' ", [$user_id]);

        $orders_success = \R::getAll("SELECT `order`.* FROM `order` 
        WHERE `order`.`user_id` = ? AND `order`.`status` = 'success'", [$user_id]);

        $orders_new = \R::getAll("SELECT `order`.* FROM `order` 
        WHERE `order`.`user_id` = ? AND `order`.`status` = 'new'", [$user_id]);

        if (!$order && !$products && !$orders_success && !$orders_success) {
            throw new \Exception('Page is not found', 404);
        }

        $sumOrder = ceil(Order::getOrder($order_total, 'UAH')) . ' ' . 'UAH';
        $orders_new = count($orders_new);
        $orders_success = count($orders_success);


        $this->setMeta("Admin | Order #{$order_id}");
        $this->setData(compact('order', 'products', 'sumOrder', 'orders_new', 'orders_success'));
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $order = \R::load('order', $id);

        $order_log = \R::load('order_log', $order->log_id);
        $time = date("Y-m-d H:i:s");
        $order_log->log = $order_log->log . ',delete?' . $time;
        $order_log->status = 'delete';

        \R::store($order_log);
        \R::trash($order);

        $_SESSION['success'] = "Order #$id Remove";
        redirect(ADMIN . '/order');
    }

    public function processingAction()
    {
        $order_id = $this->getId();
        $order = \R::load('order', $order_id);
        if ($order->status === 'processing') redirect();

        $order->status = 'processing';
        $order->update_at = date("Y-m-d H:i:s");

        $order_log = \R::load('order_log', $order->log_id);
        $time = date("Y-m-d H:i:s");
        $order_log->log = $order_log->log . ',processing?' . $time;
        $order_log->status = 'processing';

        \R::store($order_log);
        \R::store($order);

        $_SESSION['success'] = 'Changes Applied';
        redirect();
    }

    public function successAction()
    {
        $order_id = $this->getId();
        $order = \R::load('order', $order_id);
        if ($order->status === 'success') redirect();

        $order->status = 'success';
        $order->update_at = date("Y-m-d H:i:s");

        $order_log = \R::load('order_log', $order->log_id);
        $time = date("Y-m-d H:i:s");
        $order_log->log = $order_log->log . ',success?' . $time;
        $order_log->status = 'success';

        \R::store($order_log);
        \R::store($order);
        $_SESSION['success'] = 'Changes Applied';
        redirect();
    }

    public function logAction()
    {
        $log_id = $this->getId();

        $order_log = \R::getRow("SELECT `order_log`.*, `user`.`name` AS `user_name`
        FROM `order_log`
        JOIN `user` ON `user`.`id` = `order_log`.`user_id`
        WHERE `order_log`.`id` = ?", [$log_id]);

        if (empty($order_log)) redirect(ADMIN . '/order');

        $log = $order_log['log'];
        $log  = explode(',', $log);
        $log_edit = [];

        foreach ($log as $v){
            $z = explode('?', $v);
            $log_edit[$z[0]]['status']=$z[0];
            $log_edit[$z[0]]['date']=$z[1];
        }

        $this->setMeta("Admin | Order #{$order_log['order_id']} Log");
        $this->setData(compact('order_log', 'log_edit'));
    }

    public function removedAction(){

        $order_log = \R::getAll("SELECT `order_log`.*, `user`.`name` AS `user_name`
        FROM `order_log`
        JOIN `user` ON `user`.`id` = `order_log`.`user_id`
        WHERE `order_log`.`status` = 'delete'");

//        debug($order_log,1);

        $this->setMeta("Admin | Order Delete");
        $this->setData(compact('order_log'));
    }
}