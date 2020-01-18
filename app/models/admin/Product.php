<?php


namespace app\models\admin;


use app\models\AppModel;
use http\Client\Request;

class Product extends AppModel
{
    public $attrebutes = [
        'category_id' => '',
        'title' => '',
        'alias' => '',
        'content' => '',
        'price' => '',
        'old_price' => '',
        'keywords' => '',
        'description' => '',
        'status' => '',
        'hit' => '',
        'img' => '',
    ];

    public $routs = [
        'required' => [
            ['title'],
            ['category_id'],
            ['price'],
        ],
        'integer' => [
            ['category_id'],
        ]
    ];

    public function editFilter($id, $data)
    {
        $filters = \R::getCol("SELECT `attr_id`  FROM `attribute_product` 
        WHERE `product_id` = ?", [$id]);

        if (empty($data['attr']) && !empty($filters)) {
            \R::exec("DELETE FROM `attribute_product` WHERE `product_id` = ?", [$id]);
            return;
        }

        if (empty($filters) && !empty($data['attr'])) {
            $sqlAttr = '';
            foreach ($data['attr'] as $v) {
                $sqlAttr .= "($v, $id),";
            }
            $sqlAttr = rtrim($sqlAttr, ',');
            \R::exec("INSERT INTO  `attribute_product`(`attr_id`, `product_id`) VALUES $sqlAttr");
            return;
        }

        if (!empty($data['attr'])) {
            $res = array_diff($data['attr'], $filters);
            if (!empty($res) || (count($data['attr']) === count($filters))) {
                \R::exec("DELETE FROM `attribute_product` WHERE `product_id` = ?", [$id]);
            }
            $sqlAttr = '';
            foreach ($data['attr'] as $v) {
                $sqlAttr .= "($v, $id),";
            }
//            debug($data['attr'] ,1);
            $sqlAttr = rtrim($sqlAttr, ',');
            \R::exec("INSERT INTO  `attribute_product`(`attr_id`, `product_id`) VALUES $sqlAttr");
            return;
        }

    }

    public function editRelated($id, $data)
    {
        $related = \R::getCol("SELECT `related_id` FROM `related_product` 
        WHERE `product_id` = ?", [$id]);

        if (empty($data['related']) && !empty($related)) {
            \R::exec("DELETE FROM `related_product` WHERE `product_id` = ?", [$id]);
            return;
        }

        if (empty($related) && !empty($data['related'])) {
            $sqlAttr = '';
            foreach ($data['related'] as $v) {
                $sqlAttr .= "($v, $id),";
            }
            $sqlAttr = rtrim($sqlAttr, ',');
            \R::exec("INSERT INTO  `related_product`(`related_id`, `product_id`) VALUES $sqlAttr");
            return;
        }

        if (!empty($data['related'])) {
            $res = array_diff($data['related'], $related);
            if (!empty($res) || (count($data['related']) === count($related))) {
                \R::exec("DELETE FROM `related_product` WHERE `product_id` = ?", [$id]);
            }
            $sqlAttr = '';
            foreach ($data['related'] as $v) {
                $sqlAttr .= "($v, $id),";
            }
            $sqlAttr = rtrim($sqlAttr, ',');
            \R::exec("INSERT INTO  `related_product`(`related_id`, `product_id`) VALUES $sqlAttr");
            return;
        }

    }

    public function editModification($id, $data)
    {
        if (!empty($data['mod'])){
            foreach ($data['mod'] as $k => $item){
                if (empty($item['price']) || empty($item['title'])){
                    $_SESSION['error'] = 'Modification were not made ar changed. Empty name and price fields';
                    unset($_SESSION['success']);
                    redirect();
                };
            }
        }

        $modification = \R::getCol("SELECT `title` FROM `modification` WHERE `product_id` = ?", [$id]);

        if (empty($data['mod']) && !empty($modification)) {
            \R::exec("DELETE FROM `modification` WHERE `product_id` = ?", [$id]);
            return;
        }

        if (empty($modification) && !empty($data['mod'])) {
            $sqlMod = '';


            foreach ($data['mod'] as $k => $item){
                if (empty($item['old_price'])) $data['mod'][$k]['old_price'] = 0;
            }

            foreach ($data['mod'] as $v) {
                $sqlMod .= "($id,'" . (string)$v['title'] . "',{$v['price']},{$v['old_price']}),";
            }

            $sqlMod = rtrim($sqlMod, ', ');
            \R::exec("INSERT INTO `modification`(`product_id`, `title`, `price`, `old_price`) VALUES $sqlMod");
            return;
        }

        if (!empty($data['mod'])) {
            $mod = [];

            foreach ($data['mod'] as $key => $item) {
                $mod[] = $item['title'];
            }

            $res = array_diff($mod, $modification);
            if (!empty($res) || (count($mod) === count($modification))) {
                \R::exec("DELETE FROM `modification` WHERE `product_id` = ?", [$id]);
            }

            foreach ($data['mod'] as $k => $item){
                if (empty($item['old_price'])) $data['mod'][$k]['old_price'] = 0;
            }

            $sqlMod = '';
            foreach ($data['mod'] as $v) {
                $sqlMod .= "($id,'" . (string)$v['title'] . "',{$v['price']},{$v['old_price']}),";
            }

            $sqlMod = rtrim($sqlMod, ', ');
            \R::exec("INSERT INTO `modification`(`product_id`, `title`, `price`, `old_price`) VALUES $sqlMod");
            return;
        }

    }

    public function uploadImage($name, $wMax, $hMax)
    {
        $uploadDir = WWW . '/images/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name']));
        $type = array("image/gif", "image/png", "image/jpg", "image/jpeg", 'image/x-png');

        if ($_FILES[$name]['size'] > 1048576) {
            $res = array('error' => 'Error, permissible file size 1 megabyte');
            die(json_encode($res));
        }

        if ($_FILES[$name]['error']) {
            $res = array('error' => 'Error, this file very large');
            die(json_encode($res));
        }

        if (!in_array($_FILES[$name]['type'], $type)) {
            $res = array('error' => 'Error, valid file extension: gif, png, jpg, jpeg');
            die(json_encode($res));
        }

        $new_name = md5(time()) . ".$ext";
        $uploadFile = $uploadDir . $new_name;

        if (@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadFile)) {

            if ($name === 'single') {
                $_SESSION['single'] = $new_name;
            } else {
                $_SESSION['multi'][] = $new_name;
            }

            self::resize($uploadFile, $uploadFile, $wMax, $hMax, $ext);
            $res = array('file' => $new_name);
            die(json_encode($res));
        }
    }


    public static function resize($target, $dest, $wMax, $hMax, $ext)
    {
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig;

        if (($wMax / $hMax) > $ratio) {
            $wMax = $hMax * $ratio;
        } else {
            $hMax = $wMax / $ratio;
        }

        $img = '';

        switch ($ext) {
            case('gif'):
                $img = imagecreatefromgif($target);
                break;
            case('png'):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }

        $newImg = imagecreatetruecolor($wMax, $hMax);

        if ($ext == 'png') {
            imagesavealpha($newImg, true);
            $transPng = imagecolorallocatealpha($newImg, 0, 0, 0, 127);
            imagefill($newImg, 0, 0, $transPng);
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wMax, $hMax, $w_orig, $h_orig);

        switch ($ext) {
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }

    public function saveImg($old_img)
    {
        if (!empty($_SESSION['single'])) {
            $this->attrebutes['img'] = $_SESSION['single'];
            unset($_SESSION['single']);
        } else {
            $this->attrebutes['img'] = $old_img;
        }
    }

    public function saveGallery($id)
    {
        if (!empty($_SESSION['multi'])) {
            $sql_part = '';
            foreach ($_SESSION['multi'] as $v) {
                $sql_part .= "('$v', $id),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO `gallery`(`img`, `product_id`) VALUES $sql_part");
            unset($_SESSION['multi']);
        }
    }

    public function deleteSingle($url)
    {
        if (!empty($_SESSION['single'])) {
            $file = WWW . '/images/' . $url;
            if (is_file($file)) {
                unlink($file);
                unset($_SESSION['single']);
            }
        }
    }

    public function deleteMulti($url)
    {
        foreach ($url as $item) {
            $file = WWW . '/images/' . $item;
            if (is_file($file)) {
                unlink($file);
                unset($_SESSION['multi'][$item]);
            }

        }
    }

    public function deleteImg($url, $id)
    {

        if (empty($id)) {
            $file = WWW . '/images/' . $url;
            if (is_file($file)) {
                unlink($file);
                foreach ($_SESSION['multi'] as $k => $v) {
                    if ($v === $url) unset($_SESSION['multi'][$k]);
                }
            }
        } else {
            $file = WWW . '/images/' . $url;
            if (is_file($file)) {
                unlink($file);
                \R::exec("DELETE FROM `gallery` 
                WHERE `product_id` = ? AND `img` = ?", [$id, $url]);
            }
        }
    }

    public function deleteOldImg($id)
    {
        $old_product = \R::load('product', $id);
        $ord_img = $old_product->img;
        if (!empty($_SESSION['single'])) {
            $file = WWW . '/images/' . $ord_img;
            if (is_file($file) && (trim($ord_img, ' ') !== 'pattern/no_image.jpg')) unlink($file);
        }
        return $ord_img;
    }

    public function deleteContentImg($content, $dir)
    {
        preg_match_all("#<img.*?/>#si", $content, $matches);
        foreach ($matches[0] as $url) {
            preg_match('#"/.*?(jpg|gif|png|jpeg)"#i', $url, $img);
            $file = ROOT . trim($img[0], '"');
            if (is_file($file)) unlink($file);
        }
        if (is_dir($dir)) rmdir($dir);
    }

    public static function delTree($dir)
    {
        if (is_dir($dir)) {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
    }

    public function checkedImgContent($content, $dirname)
    {
        preg_match("#<img.*?src=\".+?\".*?/>#si", $content, $matches);
        if (!$matches) {
            $dir = WWW . '/images/images/' . $dirname;
            self::delTree($dir);
        }

    }
}