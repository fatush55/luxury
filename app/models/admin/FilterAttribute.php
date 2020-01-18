<?php


namespace app\models\admin;


use app\models\AppModel;

class FilterAttribute extends AppModel
{
    public $attrebutes = [
        'value' => '',
        'attr_group_id' => '',
    ];

    public $routs = [
        'required' => [
            ['value'],
            ['attr_group_id']
        ],
        'integer' => [
            ['attr_group_id']
        ]
    ];

}