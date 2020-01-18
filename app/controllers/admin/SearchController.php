<?php


namespace app\controllers\admin;

use luxury\App;
use luxury\libs\Pagination;

class SearchController extends AppController
{

    public function typeaheadAction()
    {
        if ($this->isAjax()) {
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query) {
                $products = \R::getAll("SELECT id, title, img FROM product WHERE title LIKE ? LIMIT 11", ["%{$query}%"]);
                echo json_encode($products);
            }
        }
        die;
    }

    public function productAction()
    {
        $query = isset($_GET['s']) ? $_GET['s'] : null;
        if ($query){

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = App::$app->getProperty('pagination');
            $count = \R::count('product', 'title LIKE ?', ["%{$query}%"]);

            $pagination =  new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

        }

        $products = \R::find('product', "title LIKE ? LIMIT $start, $perpage", ["%{$query}%"]);


        $this->setMeta('Admin | Search by: ' . h($query) );
        $this->setData(compact('products', 'query', 'pagination', 'count'));

    }


    public function typeaheadUserAction()
    {
        if ($this->isAjax()) {
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query) {
                $users = \R::getAll("SELECT id, `name`, img FROM `user` WHERE `name` LIKE ?  LIMIT 11", ["%{$query}%"]);
                echo json_encode($users);
            }
        }
        die;
    }

    public function UserAction()
    {
        $query = isset($_GET['s']) ? $_GET['s'] : null;
        if ($query){

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = App::$app->getProperty('pagination');
            $count = \R::count('user', 'name LIKE ?', ["%{$query}%"]);

            $pagination =  new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

        }

        $users = \R::find('user', "name LIKE ? LIMIT $start, $perpage", ["%{$query}%"]);


        $this->setMeta('Admin | Search by: ' . h($query) );
        $this->setData(compact('users', 'query', 'pagination', 'count'));

    }

}