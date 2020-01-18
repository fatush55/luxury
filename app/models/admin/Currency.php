<?php


namespace app\models\admin;


use app\models\AppModel;

class Currency extends AppModel
{

    public $attrebutes = [
        'title' => '',
        'code' => '',
        'symbol_left' => '',
        'symbol_right' => '',
        'value' => '',
        'base' => '',
    ];

    public $routs =[
      'required' => [
          ['title'],
          ['code'],
          ['value']
      ],
      'numeric' => [
          ['value']
      ]
    ];

}