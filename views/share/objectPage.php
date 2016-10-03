<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\user\models\User;
use humhub\modules\share\models\Object;
use humhub\modules\user\models\Profile;
use yii\bootstrap\Html;

/**
 * @var Object $object
 * @var \humhub\modules\share\models\Category $category
 * @var Profile $profile
 * @var User $user
 * Used to display a list of object
 */

$isAdmin = $contentContainer->permissionManager->can(new \humhub\modules\share\permissions\CreateCategory());
?>

<div class="panel panel-default">
    <!-- Edit Button -->
    <?php if ($object->user == Yii::$app->user->id || $isAdmin):?>
        <div style="float:right;padding: 5px"><a href="<?php echo $contentContainer->createUrl('/share/share/delete-object', ['object_id' => $object->id])?> ">
             <?php echo  Html::button('Supprimer', array('class' => 'btn btn-danger')) ?>
            </a>
        </div>
        <div style="float:right;padding: 5px"><a href="<?php echo $contentContainer->createUrl('/share/share/add-object', ['object_id' => $object->id])?> ">
                <?php echo  Html::button('Modifier', array('class' => 'btn btn-warning')) ?>
            </a>
        </div>
    <?php endif ?>

    <div class="panel-heading">
        <a href="<?php echo $contentContainer->createUrl('/share/share/all-objects', ['category' => $object->category]) ?>">
          <i> <?php echo $category->name ?></i>
        </a>
        <br>
        <strong><?php echo $object->name ?></strong></div>
    <div class="panel-body">

        <div class="markdown-render">
            <?php echo \humhub\widgets\MarkdownView::widget(['markdown' => $object->description]); ?>
        </div>

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        Prêteur :
        <strong>
            <?php echo "<a href='index.php?r=user%2Fprofile%2Fhome&uguid={$user->guid}'>" ?>
          <?php echo "{$profile->firstname} {$profile->lastname}" ?>
            <img style="width:30px;height:30px" src=" <?php echo $user->getProfileImage()->getUrl() ?>"/>
            </a>
        </strong>
<br>

        E-mail : <?php echo "<a href='mailto:{$user->email}'>$user->email</a>"; ?>

    </div>
</div>