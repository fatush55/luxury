<?php


namespace app\controllers\admin;


class MainController extends AppController
{
    public function indexAction()
    {
        unset($_SESSION['error']);
        unset($_SESSION['success']);

        $countProduct = \R::count('product');
        $countUser = \R::count('user');
        $countCategories = \R::count('category');

        $this->setData(compact( 'countCategories', 'countUser', 'countProduct' ));
        $this->setMeta('Admin');
    }

}