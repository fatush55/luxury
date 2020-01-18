<?php


namespace app\controllers;


use luxury\App;
use luxury\libs\Pagination;

class SearchController extends AppController
{

    public function typeaheadAction()
    {
        if ($this->isAjax()) {
            $query = !empty(trim($_GET['query'])) ? trim($_GET['query']) : null;
            if ($query) {
                $products = \R::getAll("SELECT id, title, img FROM product WHERE title LIKE ? AND status = 'on' LIMIT 11", ["%{$query}%"]);
                echo json_encode($products);
            }
        }
        die;
    }

    public function indexAction()
    {
        $query = isset($_GET['s']) ? $_GET['s'] : null;
        if ($query){

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = App::$app->getProperty('pagination');
            $total = \R::count('product', 'title LIKE ?', ["%{$query}%"]);


            $pagination =  new Pagination($page, $perpage, $total);
            $start = $pagination->getStart();
            $products = \R::find('product', "title LIKE ? AND status = 'on' LIMIT $start, $perpage", ["%{$query}%"]);
        }

        $this->setMeta('LW | Search by: ' . h($query) );
        $this->setData(compact('products', 'query', 'pagination', 'total'));

    }

}