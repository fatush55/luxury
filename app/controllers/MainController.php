<?php


namespace app\controllers;


use luxury\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product',"status = 'on' AND hit = 'on'");
        $canonical = PATH ;


        $this->setMeta('LW | Main');
        $this->setData(compact('brands','hits', 'canonical'));
    }
}