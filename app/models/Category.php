<?php


namespace app\models;


use luxury\App;

class Category extends AppModel
{
    public $attrebutes = [
      'id'=> '',
      'title'=> '',
      'alias'=> '',
      'keywords'=> '',
      'description'=> '',
      'parent_id'=> '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ]
    ];

    public function getIds($id)
    {
        $cats = App::$app->getProperty('cats');
        $ids = null;
        foreach ($cats as $k => $v) {
            if ($v['parent_id'] == $id){
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }
}