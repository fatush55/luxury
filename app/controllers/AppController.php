<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use luxury\App;
use luxury\base\Controller;
use luxury\Cache;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        $_SESSION['defaultImg'] = '/images/user_default.png';

        /*****
         * Widget currency, add currencies object  in Property and add current currency in Property
         */
        App::$app->setProperty('currencies', Currency::getCurrencies());
        App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currencies')));

        /**
         * Widget menu , add menu data in Property
         */
        App::$app->setProperty('cats', self::cacheCategory());
    }

    public function cacheCategory()
    {
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if (!$cats) {
            $cats = \R::getAssoc("SELECT * FROM category");
            $cache->set('cats', $cats);
        }
        return $cats;
    }
}