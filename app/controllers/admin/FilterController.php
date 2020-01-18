<?php


namespace app\controllers\admin;


use app\models\admin\FilterAttribute;
use app\models\admin\FilterGroup;

class FilterController extends AppController
{


    public function groupAction()
    {
        $groups = \R::findAll('attribute_group');
        $this->setMeta('Admin | Filter Groups');
        $this->setData(compact('groups'));
    }

    public function groupDeleteAction()
    {
        $id = $this->getId();
        $count = \R::count('attribute_value', "attr_group_id = ?", [$id]);

        if ($count) {
            $_SESSION['error'] = 'This group has attributes';
        } else {
            \R::exec("DELETE FROM `attribute_group` WHERE `id` = ?", [$id]);
            $_SESSION['success'] = 'This group has been successfully delete';
        }
        redirect();
    }

    public function groupAddAction()
    {
        if ($_POST) {
            $group = new FilterGroup();
            $data = $_POST;
            if (!$group->validate($data)) {
                $group->getError();
                redirect();
            }
            $group->load($data);
            if ($group->save('attribute_group', false)) {
                $_SESSION['success'] = 'group added successfully';
                redirect();
            }
        }

        $this->setMeta('Admin | Filter Group Add');
    }

    public function groupEditAction()
    {
        if ($_POST) {
            $id = $this->getId(0);
            $group = new FilterGroup();
            $data = $_POST;
            if (!$group->validate($data)) {
                $group->getError();
                redirect();
            }
            $group->load($data);
            if ($group->update('attribute_group', $id)) {
                $_SESSION['success'] = 'group changed successfully';
                redirect();
            }
        }

        $id = $this->getId();
        $groups = \R::load('attribute_group', $id);
        $this->setMeta("Admin | Filter Group $groups->title Edit");
        $this->setData(compact('groups'));
    }

    public function attributeAction()
    {
        $attributes = \R::getAssoc("SELECT `attribute_value`.*,  `attribute_group`.`title` 
        FROM `attribute_value` JOIN `attribute_group` ON `attribute_value`.`attr_group_id` = `attribute_group`.`id`");

        $this->setMeta('Admin | Filter Attribute');
        $this->setData(compact('attributes'));
    }

    public function attributeDeleteAction()
    {
        if (!empty($_GET)) {
            $id = $this->getId();
            $attr = \R::findOne('attribute_value', $id);
            \R::exec("DELETE FROM `attribute_product` WHERE `attr_id` = ?", [$id]);
            \R::exec("DELETE FROM `attribute_value` WHERE `id` = ?", [$id]);
            $_SESSION['success'] = "Attribute $attr->value successfully delete";
            redirect();
        }
        $_SESSION['error'] = "Removal failed";
        redirect();
    }

    public function attributeAddAction()
    {
        if ($_POST) {
            $group = new FilterAttribute();
            $data = $_POST;
            if (!$group->validate($data)) {
                $group->getError();
                redirect();
            }
            $group->load($data);
            if ($group->save('attribute_value', false)) {
                $_SESSION['success'] = 'attribute added successfully';
                redirect();
            }
        }

        $groups = \R::findAll('attribute_group');
        $this->setMeta('Admin | Filter Attribute Add');
        $this->setData(compact('groups'));
    }

    public function attributeEditAction()
    {
        if ($_POST) {
            $id = $this->getId(0);
            $group = new FilterAttribute();
            $data = $_POST;
            if (!$group->validate($data)) {
                $group->getError();
                redirect();
            }
            $group->load($data);
            if ($group->update('attribute_value', $id)) {
                $_SESSION['success'] = 'attribute changed successfully';
                redirect();
            }
        }
        $id  = $this->getId();
        $groups = \R::findAll('attribute_group');
        $attr = \R::findOne('attribute_value', 'id = ?', [$id]);
        $this->setMeta("Admin | Filter Attribute $attr->value Edit");
        $this->setData(compact('groups','attr'));
    }

}