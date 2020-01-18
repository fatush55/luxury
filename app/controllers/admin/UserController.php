<?php


namespace app\controllers\admin;


use app\models\Order;
use app\models\User;
use luxury\App;
use luxury\libs\Pagination;
use function Sodium\compare;

class UserController extends AppController
{
    public function loginAdminAction()
    {
        $this->layout = 'login_admin';

        if (!empty($_POST)) {
            $user = new User();
            if ($user->login(true)) {
                $_SESSION['success'] = 'You have successfully logged in';
            } else {
                $_SESSION['error'] = 'Such users was not found';
            }

            if (User::isAdmin()) {
                redirect(ADMIN);
            } else {
                redirect();
            }
        }
    }

    public function showAction()
    {
        $user_id = $this->getId();
        $orders = \R::getAll("SELECT `order`.*, ROUND(SUM(`order_product`.`price`), 2) AS `price` 
        FROM `order`
        JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
        WHERE `order`.`user_id` = ? GROUP BY  `order`.`date` DESC", [$user_id]);

        $order_total = \R::getAll("
        SELECT `order_product`.`price` AS `price`, `order_product`.`qty`, `order`.`currency`
        FROM  `order_product` JOIN `order` ON `order_product`.`order_id` = `order`.`id`
        WHERE `order`.`user_id` = ?  AND `order`.`status` = 'success' ", [$user_id]);

        $orders_new = \R::getAll("SELECT `order`.* FROM `order` 
        WHERE `order`.`user_id` = ? AND `order`.`status` = 'new'", [$user_id]);

        $orders_success = \R::getAll("SELECT `order`.* FROM `order` 
        WHERE `order`.`user_id` = ? AND `order`.`status` = 'success'", [$user_id]);

        $user = \R::findOne('user', "id=$user_id");

        if (!$user) {
            throw new \Exception('Page not found', 404);
        }

        $sumOrder = ceil(Order::getOrder($order_total, 'UAH')) . ' ' . 'UAH';
        $orders_success = count($orders_success);
        $orders_new = count($orders_new);

        $this->setMeta("Admin | User #$user_id Show");
        $this->setData(compact('orders', 'sumOrder', 'orders_success', 'orders_new', 'user'));

    }

    public function indexAction()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::findAll('user', "LIMIT $start, $perpage");

        $this->setMeta('Admin | Users');
        $this->setData(compact('pagination', 'users', 'count'));
    }

    public function editAction()
    {
        if (!empty($_POST['id'])) {
            $id = $this->getId(false);
            $user = new \app\models\admin\User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getError();
                redirect();
            } else {
                if (!$user->attrebutes['password']) {
                    unset($user->attrebutes['password']);
                } else {
                    $user->attrebutes['password'] = password_hash($user->attrebutes['password'], PASSWORD_DEFAULT);
                }

                if ($user->update('user', $id)) $_SESSION['success'] = 'Data changed';
            }
            redirect();
        }

        $id = $this->getId();
        $user = \R::findOne('user', "id = $id");
        $this->setMeta("Admin | User #$id Edit");
        $this->setData(compact('user'));
    }

    public function addAction()
    {
        $this->setMeta('Admin | User Add');
    }

}