<?php


namespace luxury;


abstract class Request
{

    public function getId($get = true, $res = 'id')
    {
        if ($get){
            $data = $_GET;
        } else {
            $data = $_POST;
        }
         $id = !empty($data[$res]) ? $data[$res] : null;

        if (!$id){
            throw new \Exception('Page is not found', 404);
        }
        return $id;
    }

}