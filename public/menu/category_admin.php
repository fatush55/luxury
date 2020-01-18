<?php
$parent = isset($category['childs']);
if(!$parent){
    $delete = '<a href="' . ADMIN . '/category/delete?id=' . $id . '" class="delete_cat">
               <i class="fas fa-times text-danger" style="padding: 18px"></i></a>';
}else{
    $delete = '<i class="fas fa-times text-gray" style="padding: 18px"></i>';
}
?>
<p class="item-p">
    <a class="list-group-item" href="<?=ADMIN;?>/category/edit?id=<?=$id;?>"><?=$category['title'];?></a> <span><?=$delete;?></span>
</p>
<?php if($parent): ?>
    <div class="list-group">
        <?= $this->getMenuHtml($category['childs']); ?>
    </div>
<?php endif; ?>
