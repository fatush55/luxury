<?php


namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Product;

class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status ='on'", [$alias]);
        if (!$product){
            throw new \Exception("This product({$alias}) was not found", 404);
        }


        //TO DO: breadcrumbs
        $breadCrumbs = BreadCrumbs::getBreadCrumbs($product->category_id, $product->title);

        //TO DO related product
        $related = \R::getAll("SELECT * FROM `related_product` 
        JOIN `product` ON product.id = related_product.related_id 
        WHERE related_product.product_id = ? AND product.status = 'on ' ", [$product['id']]);

        //TO DO add current product to cache
        $p_modal = new Product();
        $p_modal->setRecentlyView($product['id']);

        //TO DO viewed product
        $r_viewed = $p_modal->getRecentlyView();
        $recently = null;
        if ($r_viewed){
            $recently = \R::find('product', 'id IN ('. \R::genSlots($r_viewed) .') LIMIT 3', $r_viewed);
        }

        //TO DO gallery product
        $getImg = \R::findAll('gallery', 'product_id =?', [$product['id']]);

        //TO DO get modification product
        $mods = \R::findAll('modification', 'product_id=?', [$product->id]);
//        debug($mods);

        $this->setMeta('LW | ' . $product['title'], $product['description'], $product['keyword']);
        $this->setData(compact('product','related', 'getImg', 'recently', 'breadCrumbs', 'mods'));
    }


}