<?php


namespace app\controllers\admin;


use app\models\AppModel;
use app\models\Category;
use luxury\App;

class CategoryController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Admin | Categories');
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $error = false;
        $category = \R::count('category', 'parent_id = ?', [$id]);
        $product = \R::count('product', 'category_id = ?', [$id]);

        if ($category) $error = "<li>There are nested categories in this category</li>";
        if ($product) $error = "<li>There are products in this category</li>";

        if ($error) {
            $_SESSION['error'] = "<ul>$error</ul>";
            redirect();
        }

        $cat = \R::load('category', $id);
        \R::trash($cat);
        $_SESSION['success'] = "Removal succeeded";
        redirect();
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            $category = new Category();
            $data = $_POST;
            $category->load($data);

            if (!$category->validate($data)) {
                $category->getError();
                redirect();
            }
            if ($id = $category->save('category')) {
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $cat = \R::load('category', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Category Added';
            }
            redirect();
        }

        $this->setMeta('Admin | Category Add');
    }

    public function editAction()
    {
        if (!empty($_POST['id'])) {
            $id = $this->getId(false);
            $category = new Category();
            $data = $_POST;
            $category->load($data);

            if (!$category->validate($data)) {
                $category->getError();
                redirect();
            }

            if ($category->update('category', $id)) {
                $alias = AppModel::createAlias('category', 'alias', $data['title'], $id);
                $cat = \R::load('category', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Category Changed';
            }
            redirect();
        }

        $id = $this->getId();
        $category = \R::load('category', $id);
        App::$app->setProperty('parent_id', $category->parent_id);
        $this->setMeta("Admin | Category $category->title Edit");
        $this->setData(compact('category'));
    }
}