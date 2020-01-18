<?php


namespace app\controllers;


use app\models\Order;
use app\models\User;

class UserController extends AppController
{
    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);

            if (!$user->validate($data) || !$user->checkUnique()) {
                $_SESSION['form_data'] = $data;
                $user->getError();
            } else {
                $user->attrebutes['password'] = password_hash($user->attrebutes['password'], PASSWORD_DEFAULT);
                $check = $user->attrebutes['check'];
                unset($user->attrebutes['check']);
                if ($user->save('user')) {
                    if ($check) {
                        redirect();
                    }

                    $user = \R::findOne('user', "login = ?", [$user->attrebutes['login']]);
                    foreach ($user as $k => $v) {
                        if ($k !== 'password') $_SESSION['user'][$k] = $v;
                    }
                    redirect('/');

                } else {
                    $_SESSION['error'] = 'User not registered';
                }
            }
            redirect();
        }
    }

    public function loginAction()
    {
        if (isset($_POST)) {
            $user = new User();
            if (!$user->login()) {
                $_SESSION['error'] = 'Login or password is incorrect';
            }

            if ($_POST['checked']) {
                $_SESSION['remember']['login'] = $_POST['login'];
                $_SESSION['remember']['password'] = $_POST['password'];
                $_SESSION['remember']['checked'] = ' checked';
            } else {
                if (isset($_SESSION['remember'])) unset($_SESSION['remember']);
            }

            $this->loadView('authorization');
        }
    }

    public function editAction()
    {
        if ($_POST) {
            $id = $_SESSION['user']['id'];
            $data = $_POST;
            $data['id'] = $id;
            $data['role'] = 'user';
            $user = new \app\models\admin\User();
            $user->load($data);

            if (!empty($user->attrebutes['password'])) {
                $user->attrebutes['password'] = password_hash($user->attrebutes['password'], PASSWORD_DEFAULT);
            } else {
                unset($user->attrebutes['password']);
            }

            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getError();
            } else {
                if ($user->update('user', $id)) {
                    foreach ($user->attrebutes as $k => $v) {
                        $_SESSION['user'][$k] = $v;
                    }
                    $_SESSION['success'] = 'Data changed';
                }
            }
            redirect();
        }

        if (empty($_SESSION['user'])) redirect('/');
        $name = $_SESSION['user']['name'];
        $this->setMeta("LW | Edit Account $name");
        $this->setData(compact('name'));
    }

    public function ordersAction()
    {
        if (empty($_SESSION['user'])) redirect('/');
        $name = $_SESSION['user']['name'];
        $id = $_SESSION['user']['id'];
        $orders = \R::getAssoc("SELECT `order`.`id`, `order`.`status`, `order`.`date`, `order`.`update_at`, `order`.`currency`
        FROM `order` WHERE `order`.`user_id` = ? GROUP BY `date` DESC", [$id,]);

        $this->setMeta("LW | Orders $name");
        $this->setData(compact('name', 'orders'));
    }

    public function orderShowAction()
    {
        $id = $this->getId();
        if (empty($_SESSION['user'])) redirect('/');
        $name = $_SESSION['user']['name'];
        $products = \R::getAll('SELECT * FROM `order_product` WHERE `order_id` = ?', [$id]);

        $order = Order::getProductsOrder($id);

        $this->setMeta("LW | Order $id");
        $this->setData(compact('name', 'id', 'sum', 'products', 'order'));
    }

    public function addImgAction()
    {
        if ($_FILES) {
            $type = explode('.', $_FILES['file']['name']);
            $type = array_reverse($type);
            $type = '.' . $type[0];
            $name = time() . mt_rand(1000, 9999) . $type;
            $path = WWW . '/images/users/';
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path . $name)) {
                $user = \R::load('user', $_SESSION['user']['id']);
                unlink($path . $user->img);
                $user->img = $name;
                \R::store($user);
                $_SESSION['user']['img'] = $name;
            }
            redirect();
        }

        if (empty($_SESSION['user'])) redirect('/');
        $name = $_SESSION['user']['name'];
        $this->setMeta("LW | Add Image $name");
        $this->setData(compact('name'));
    }

    public function logoutAction()
    {
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect();
    }


    public function showAction()
    {
        $this->loadView('authorization');
    }

    public function registerAction()
    {
        $this->setMeta('LW | Registration');
    }
}