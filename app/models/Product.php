<?php


namespace app\models;


class Product extends AppModel
{
    public function setRecentlyView($id){
        $recentlyView = $this->getAllRecentlyView($id);
        if (!$recentlyView){
            setcookie('recentlyView', $id, time() + 3600 * 24, '/');
        } else {
            $recentlyView = explode('.' , $recentlyView);
            if (!in_array($id, $recentlyView)){
                $recentlyView[] = $id;
                $recentlyView = implode('.' , $recentlyView);
                setcookie('recentlyView', $recentlyView, time() + 3600 * 24, '/');
            }
        }
    }

    public function getRecentlyView(){
        if (!empty($_COOKIE['recentlyView'])){
            $recentlyView = $_COOKIE['recentlyView'];
            $recentlyView = explode('.' , $recentlyView);
            return array_slice($recentlyView, -3);
        }
        return false;
    }

    public function getAllRecentlyView(){
        if (!empty($_COOKIE['recentlyView'])){
            return $_COOKIE['recentlyView'];
        }
        return false;
    }

}