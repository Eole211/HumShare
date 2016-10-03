<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\user\models\User;
use humhub\modules\share\models\Object;
use humhub\modules\user\models\Profile;

/**
 * @var Object $object
 * @var \humhub\modules\share\models\Category $category
 * Used to display a list of object
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?php echo $contentContainer->createUrl('/share/share/all-objects',['category'=>$object->category])?>">
            <?php echo $category->name ?>
        </a>
        <br>
        <strong><?php echo $object->name ?></strong></div>
    <div class="panel-body">

            <div class="markdown-render">
                <?php echo \humhub\widgets\MarkdownView::widget(['markdown' => $object->description]); ?>
            </div>

    </div>
</div>
