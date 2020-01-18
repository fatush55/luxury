<?php


namespace app\widgets\Menu;


use app\widgets\currency\Currency;
use luxury\App;
use luxury\Cache;

class Menu
{

    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tml;
    protected $container = 'ul';
    protected $class = 'menu';
    protected $table = 'category';
    protected $cache = 3600;
    protected $cacheKey = 'luxury_menu';
    protected $attrs = [];
    protected $prepend = '';
    protected $expansion_outside = '';
    protected $expansion_inside = '';

    public function __construct($options = [])
    {
        $this->tml = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $cache = Cache::instance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml) {
            $this->data = App::$app->getProperty('cats');
            if (!$this->data) {
                $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
            }
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if ($this->cache){
                $cache->get($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->output();
    }

    protected function output()
    {
        $attrs = '';
        if (!empty($this->attrs)){
            foreach ($this->attrs as $k => $v){
                $attrs .= $k . "=$v ";
            }
        }
        echo '<'. $this->container . " class='" . $this->class . "' " . $attrs .  $this->expansion_inside . '>';
            echo $this->prepend;
            echo $this->menuHtml;
        echo '</'. $this->container .'>';
        echo $this->expansion_outside;
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tml;
        return ob_get_clean();
    }

}