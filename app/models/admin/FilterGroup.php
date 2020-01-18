<?php


namespace app\models\admin;


use app\models\AppModel;

class FilterGroup extends AppModel
{
    public $attrebutes = [
        'title' => ''
    ];

    public $routs = [
        'required' => [
            ['title']
        ]
    ];
}