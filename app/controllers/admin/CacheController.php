<?php


namespace app\controllers\admin;


use luxury\Cache;

class CacheController extends AppController
{

    public function indexAction()
    {
        $this->setMeta('Admin | Cache');
    }

    public function deleteAction(){
        $id = $this->getId(true,'cache');
        $cache = Cache::instance();

        switch ($id){
            case 'category':
                $cache->delete('cats');
                $data = 'category';
                break;
            case 'filter':
                $cache->delete('filter_group');
                $cache->delete('filter_attribute');
                $data = 'filter';
                break;
        }
        $_SESSION['success'] = "Cache $data Clear";
        redirect();
    }

}