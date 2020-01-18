<?php


namespace app\controllers\admin;


use app\models\admin\Currency;

class CurrencyController extends AppController
{

    public function indexAction()
    {
        $currency = \R::findAll('currency');
        $this->setMeta('Admin | Currency');
        $this->setData(compact('currency'));
    }

    public function addAction()
    {
        if ($_POST) {
            $currency = new Currency();
            $data = $_POST;
            if (!$currency->validate($data)) {
                $currency->getError();
                redirect();
            }
            $currency->load($data);
            if ($currency->save('currency')) {
                $_SESSION['success'] = 'currency added successfully';
                redirect();
            }
        }

        $this->setMeta('Admin | Currency Add');
    }

    public function editAction()
    {
        if ($_POST) {
            $id = $this->getId(0);
            $currency = new Currency();
            $data = $_POST;
            if (!$currency->validate($data)) {
                $currency->getError();
                redirect();
            }
            $currency->load($data);
            if ($currency->update('currency', $id)) {
                $_SESSION['success'] = 'currency changed successfully';
                redirect();
            }
        }

        $id = $this->getId();
        $currency = \R::load('currency', $id);
        $this->setMeta('Admin | Currency Add');
        $this->setData(compact('currency'));
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $currency = \R::load('currency', $id);
        \R::trash($currency);
        $_SESSION['success'] = 'Currency successfully delete';
        redirect();
    }
}