<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\share\models\forms\SearchForm;
use humhub\modules\user\models\User;
use humhub\modules\share\models\SharedObject;
use humhub\modules\user\models\Profile;
use yii\bootstrap\Html;

/**
 * @var Object $object
 * @var \humhub\modules\share\models\Category $category
 * @var Profile $profile
 * @var User $user
 * @var int $searchCategory
 * Used to display a list of object
 */

$isAdmin = $contentContainer->permissionManager->can(new \humhub\modules\share\permissions\CreateCategory());


//it was a search, before
if($searchCategory>=0) {

    //Parameters of the search
    $searchForm = new SearchForm();
    $searchForm->category = $searchCategory;
    if (isset($searchTerms) && $searchTerms != null) {
        $searchForm->terms = $searchTerms;
    }
    $paramBack=['SearchForm'=>$searchForm ];
    $backUrl='/share/share/index';
}
else{ //otherwise it was displaying users object
    $backUrl='/share/share/objects-of-user';
   $paramBack=['userId'=>Yii::$app->user->id];
}

//var_dump($paramsBack);

?>

<div class="panel panel-default">
    <!-- Edit and delete Button -->
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
    <!-- Back Button  -->
    <div style="float:right;padding: 5px"><a href="<?php echo $contentContainer->createUrl($backUrl,$paramBack)?> ">
            <?php echo  Html::button('Retour', array('class' => 'btn btn-default')) ?>
        </a>
    </div>


    <div class="panel-heading">
        <a href="<?php echo $contentContainer->createUrl('/share/share/index', ['SearchForm' => ['category'=>$category->id]]) ?>">
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