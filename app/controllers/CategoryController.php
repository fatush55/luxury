<?php


namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Category;
use app\widgets\filter\Filter;
use luxury\App;
use luxury\libs\Pagination;

class CategoryController extends AppController
{

    public function viewAction()
    {
        $alias = $this->route['alias'];
        if ($alias) {
            $category = \R::findOne('category', 'alias = ?', [$alias]);
        }

        if (empty($category)) {
            throw new \Exception('Page is not found', 404);
        } else {
            $breadcrumb = BreadCrumbs::getBreadCrumbs($category->id);

            $modal = new Category();
            $ids = $modal->getIds($category->id);
            $ids = !$ids ? $category->id : $ids . $category->id;

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = App::$app->getProperty('pagination');

            /*filters-search-start */

            $sql_part = '';

            if (!empty($_GET['filter'])) {
                $filter = Filter::getFilters();
                if ($filter) {
                    $count = Filter::getCountAttributes($filter);
                    $sql_part_dop = "GROUP BY product_id HAVING COUNT(product_id) = $count";
                    $sql_part = "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id
                    IN ($filter) $sql_part_dop)";
                }
            }
            /*filters-search-end */

            $total = \R::count("product", "category_id IN ($ids) $sql_part");
            $pagination = new Pagination($page, $perpage, $total);
            $start = $pagination->getStart();
            $products = \R::find("product", "category_id IN ($ids) $sql_part AND status = 'on' LIMIT $start, $perpage");

            /*filters-view-start */

            if ($this->isAjax()) {
                $this->loadView('filter', compact('products', 'total', 'pagination'));
            }
            /*filters-view-end */

            $this->setMeta('LW | ' . $category->title, $category->description, $category->keyword);
            $this->setData(compact('products', 'breadcrumb', 'pagination', 'total'));
        }
    }
}