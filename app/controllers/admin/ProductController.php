<?php


namespace app\controllers\admin;


use app\models\admin\Product;
use app\models\AppModel;
use luxury\App;
use luxury\libs\Pagination;

class ProductController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('product');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $products = \R::getAll("SELECT `product`.`id`, `product`.`category_id` AS `cat`, `product`.`title`, 
        `product`.`price`, `product`.`old_price`, `product`.`status`, `category`.`title` AS `name_cat`
        FROM  `product` 
        JOIN `category` ON `product`.`category_id` = `category`.`id`
        GROUP BY `product`.`id`
        LIMIT $start, $perpage");

        $this->setMeta('Admin | Products');
        $this->setData(compact('pagination', 'products', 'count'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            $product = new Product();
            if ($product->validate($data)) {
                $product->load($data);
                $product->attrebutes['status'] = $product->attrebutes['status'] ?: 'off';
                $product->attrebutes['hit'] = $product->attrebutes['hit'] ?: 'off';
                $product->attrebutes['old_price'] = $product->attrebutes['old_price'] ? (float)$product->attrebutes['old_price'] : 0;
                $product->saveImg('');

                if ($id = $product->save('product')) {

                    /*create new alias product - start*/
                    $alias = AppModel::createAlias('product', 'alias', $product->attrebutes['title'], $id);
                    $product_alias = \R::load('product', $id);
                    $product_alias->alias = $alias;
                    \R::store($product_alias);
                    /*create new alias product - end*/

                    $product->saveGallery($id);
                    $product->editFilter($id, $data);
                    $product->editRelated($id, $data);
                    $product->editModification($id, $data);
                    $_SESSION['success'] = 'Product Created';
                    redirect();
                };
            } else {
                $product->getError();
                $_SESSION['form_data'] = $data;
            }
            redirect();
        }

        /*remove main img product and delete old img - start*/
        if (!empty($_SESSION['single'])) {
            $product = new Product();
            $product->deleteSingle($_SESSION['single']);
        }
        if (!empty($_SESSION['multi'])) {
            $product = new Product();
            $product->deleteMulti($_SESSION['multi']);
        }
        /*remove main img product and delete old img - end*/

        $this->setMeta('Admin | Product Add');
    }

    public function editAction()
    {
        if (!empty($_POST)) {
            $id = $this->getId(0);
            $product = new Product();
            $data = $_POST;

            if ($product->validate($data)) {
                $product->load($data);
                $product->attrebutes['status'] = $product->attrebutes['status'] ?: 'off';
                $product->attrebutes['hit'] = $product->attrebutes['hit'] ?: 'off';
                $product->attrebutes['old_price'] = $product->attrebutes['old_price'] ? (float)$product->attrebutes['old_price'] : 0;

//                debug($product->attrebutes,1);

                /*remove main img product and delete old img - start*/
                $old_img = $product->deleteOldImg($id);
                $product->saveImg($old_img);
                /*remove main img product and delete old img - end*/

                /*remove dir for content product and remove src img - start*/
                if (!empty($product->attrebutes['content'])) {
                    $prod = \R::findOne('product', 'id = ?', [$id]);
                    if ($prod->title !== $product->attrebutes['title']) {
                        $old = WWW . '/images/images/' . $prod->title;
                        $new = WWW . '/images/images/' . $product->attrebutes['title'];
                        $newDir = AppModel::removeDir($old, $new);

                        if ($newDir) {
                            $newContent = AppModel::removeSrc($prod->title, $product->attrebutes['title'], $prod->content);
                            $product->attrebutes['content'] = $newContent;
                        }
                    }
                }
                /*remove dir for content product and remove src img - end*/

                /*checks the content, availability of photos - start*/
                $product->checkedImgContent($product->attrebutes['content'], $product->attrebutes['title']);
                /*checks the content, availability of photos - end*/

                if ($id = $product->update('product', $id)) {

                    /*create new alias product - start*/
                    $alias = AppModel::createAlias('product', 'alias', $product->attrebutes['title'], $id);
                    $product_alias = \R::load('product', $id);
                    $product_alias->alias = $alias;
                    \R::store($product_alias);
                    /*create new alias product - end*/

                    $product->saveGallery($id);
                    $product->editFilter($id, $data);
                    $product->editRelated($id, $data);
                    $product->editModification($id, $data);
                    $_SESSION['success'] = 'Product changed';
                    redirect();
                };
            } else {
                $product->getError();
            }
//            debug($product->attrebutes,1);
            redirect();
        }

        /*delete unnecessary img of session after reboot - start*/
        if (!empty($_SESSION['single'])) {
            $product = new Product();
            $product->deleteSingle($_SESSION['single']);
            redirect();
        }
        if (!empty($_SESSION['multi'])) {
            $product = new Product();
            $product->deleteMulti($_SESSION['multi']);
        }
        /*delete unnecessary img of session after reboot - end*/

        $id = $this->getId();
        $products = \R::findOne('product', 'id = ?', [$id]);


        if (empty($products->content)) {
            $dir = WWW . '/images/images/' . $products->title;
            if (is_dir($dir)) Product::delTree($dir);
        }

        App::$app->setProperty('parent_id', $products['category_id']);

        $related = \R::getAll("SELECT `related_product`.`related_id` , `product`.`title` 
        FROM `related_product` JOIN `product` ON `product`.`id` =`related_product`.`related_id`
        WHERE `related_product`.`product_id` = ?", [$id]);

        $filter = \R::getCol("SELECT `attr_id` FROM  `attribute_product` 
        WHERE  `product_id` = ?", [$id]);

        $gallery = \R::getCol("SELECT `img` FROM `gallery` WHERE `product_id` = ?", [$id]);

        $modification = \R::getAll("SELECT * FROM `modification` WHERE `product_id` = ?", [$id]);

        $this->setMeta("Admim | Product {$products->title} Edit");
        $this->setData(compact('products', 'related', 'filter', 'gallery', 'modification'));
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $product = \R::findOne('product', 'id = ?', [$id]);
        $gallery = \R::findAll('gallery', 'product_id = ?', [$id]);

        \R::exec("DELETE FROM `product` WHERE `id` = ?", [$id]);

        if (!empty($product)) {
            $file = WWW . '/images/' . $product->img;
            if (is_file($file) && (trim($product->img, ' ') !== 'pattern/no_image.jpg')) unlink($file);
        }

        if (!empty($gallery)) {
            foreach ($gallery as $item) {
                $gallery_delete = new Product();
                $gallery_delete->deleteImg($item->img, $id);
            }
        }

        if (!empty($product->content)) {
            $dir = WWW . '/images/images/' . $product->title;
            if (is_dir($dir)) {
                $content = new Product();
                $content::delTree($dir);
            }
        }

        \R::exec("DELETE FROM `attribute_product` WHERE `product_id` = ?", [$id]);
        \R::exec("DELETE FROM `related_product` WHERE `product_id` = ?", [$id]);
        \R::exec("DELETE FROM `modification` WHERE `product_id` = ?", [$id]);
        $_SESSION['success'] = "Product $product->title Remove";
        redirect();
    }

    public function statusAction()
    {
        $id = $this->getId();
        $status = $_GET['status'];
        $product = \R::load('product', $id);
        if ($status === 'on') {
            $product->status = 'off';
        } else {
            $product->status = 'on';
        }
        \R::store($product);
        die;
    }

    public function relatedProductAction()
    {
        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $data['items'] = [];
        $product = \R::getAssoc("
        SELECT `id`, `title` 
        FROM `product` 
        WHERE `title` LIKE ? LIMIT 10", ["%{$q}%"]);

        if ($product) {
            $i = 0;
            foreach ($product as $id => $title) {
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
            echo json_encode($data);
            die;
        }
    }

    public function addImageAction()
    {
        if (isset($_GET['upload'])) {
            $name = $_POST['name'];
            if ($name === 'single') {
                /*delete old main img after load new main img - start*/
                if (!empty($_SESSION['single'])) {
                    $product = new Product();
                    $product->deleteSingle($_SESSION['single']);
                }
                /*delete old main img after load new main img - end*/

                $wMax = App::$app->getProperty('img_width');
                $hMax = App::$app->getProperty('img_height');
            } else {
                $wMax = App::$app->getProperty('gallery_width');
                $hMax = App::$app->getProperty('gallery_height');
            }

            $images = new Product();
            $images->uploadImage($name, $wMax, $hMax);
        }
    }

    public function deleteImageAction()
    {
        if (!empty($_GET)) {
            $url = $_GET['url'];
            $id = $_GET['id'] ?: null;
            $product = new Product();
            $product->deleteImg($url, $id);
            die;
        }
    }
}