<?php


namespace app\controllers\admin;


use app\models\AppModel;
use app\models\User;
use app\widgets\currency\Currency;
use luxury\App;
use luxury\base\Controller;

class AppController extends Controller
{

    public $layout = 'admin';
    public $orders;

    public function __construct($route)
    {
        new AppModel();

        parent::__construct($route);
        if (!User::isAdmin() && $route['action'] !== 'login-admin') {
            redirect( ADMIN .'/user/login-admin');
        }

        $_SESSION['newOrders'] = \R::count('order', 'status = "new"');
        $_SESSION['paidOrders'] = \R::count('order', 'status = "paid"');
    }


}