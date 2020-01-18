<?php


namespace app\widgets\filter;


use luxury\App;
use luxury\Cache;

class Filter
{
    public $groups;
    public $attributes;
    public $tmp;
    public $filter;

    public function __construct($filter = null, $tmp = '')
    {
        $this->filter = $filter;
        $this->tmp = $tmp ? : __DIR__ . '/filter_tmp/filter.php';
        $this->run();
    }

    protected function run()
    {
        $cache = Cache::instance();
        $this->groups = $cache->get('filter_group');
        if (!$this->groups) {
            $this->groups = self::getGroups();
            $cache->set('filter_group', $this->groups, 1);
        }

        $this->attributes = $cache->get('filter_attribute');
        if (!$this->attributes) {
            $this->attributes = self::getAttributes();
            $cache->set('filter_attribute', $this->attributes, 1);
        }
        $this->getHtml();
    }

    protected static function getGroups()
    {
        return \R::getAssoc('SELECT id, title FROM attribute_group');
    }

    protected static function getAttributes()
    {
        $data = \R::getAssoc('SELECT * FROM attribute_value');
        $attributes = [];
        foreach ($data as $k => $v) {
            $attributes[$v['attr_group_id']][$k] = $v['value'];
        }
        return $attributes;
    }

    protected function getHtml()
    {
        ob_start();
        $filter = self::getFilters();
        if (!empty($filter)) {
            $filter = explode(',', $filter);
        }
        require $this->tmp;
        $tmp = ob_get_clean();
        echo $tmp;
    }

    public static function getFilters()
    {
        $filter = null;
        if (!empty($_GET['filter'])) {
            $filter = preg_replace('#[^\d,]+#', '', $_GET['filter']);
            $filter = trim($filter, ',');

        }
        return $filter;
    }

    public static function getCountAttributes($filter)
    {
        $filter = explode(',', $filter);
        $cache = Cache::instance();
        $attributes = $cache->get('filter_attribute');
        if (!$attributes) {
            $attributes = self::getAttributes();
        }
        $data = [];
        foreach ($attributes as $kiy => $item) {
            foreach ($item as $k => $v) {
                if (in_array($k, $filter)) {
                    $data[] = $kiy;
                    break;
                }
            }
        }
        return count($data);
    }
}