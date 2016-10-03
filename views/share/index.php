<?php

use humhub\compat\CActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\share\models\Object;
use humhub\modules\share\models\Category;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;
use humhub\modules\share\models\forms\SearchForm;

/**
 *
 * @uses $accesslevel the access level of the user currently logged in.
 *
 * @var Object[] $objects
 * @var Category[] $categories
 * @var ContentContainer $contentContainer
 * @var User $user
 */


humhub\modules\share\Assets::register($this);
?>
<div class="panel panel-default">
    <div class="panel-heading"><strong>HumShare</strong><br>Partage de trucs</div>
    <div class="panel-body" >

        <?php

        //Formatting the categories into a simple array (id=>name) for the dropdown
        $catDropArray = array();
        $catDropArray[0]="Toutes les catégories";
        foreach ($categories as $cat) {
            $catDropArray[$cat->id] = $cat->name;
        } ?>


        <div class="form-group"> <?php
            $form = CActiveForm::begin();
            if (!isset($categoryId)) {
                $categoryId = 0;
            }
            $searchForm = new SearchForm();
            if(isset($terms)) {
                $searchForm ->terms= $terms;
            }

            echo $form->field($searchForm, 'terms')->label('Votre recherche');

            echo $form->field($searchForm, 'category')
                ->dropDownList(
                    $catDropArray,
                    ['options' =>
                        [
                            $categoryId => ['selected' => true]
                        ]
                    ]
                )->label('Catégorie');


            echo Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', array('class' => 'btn btn-primary'));

            CActiveForm::end();
            ?>
        </div>
        <?php if(isset($objects)){
                require(__DIR__ . '/objectsList.php');
        }
        ?>
        <hr>

        <div style='text-align:center'>

            <?php
        echo
            //All the objects by category
            " <br><a href=' " .
            $contentContainer->createUrl('/share/share/all-objects') .
            "'>" .
                Html::button('Tout les trucs par catégorie', array('class' => 'btn btn-default')) .
            "</a>".

            //Boutton add an Object
            " <a href='" .
            $contentContainer->createUrl('/share/share/add-object') .
            "'>" .
            Html::button('Ajouter un trucs à partager', array('class' => 'btn btn-default')) .

            //Button your objects
            " <a href='" .
            $contentContainer->createUrl('/share/share/objects-of-user', ['userId' => Yii::$app->user->id]) .
            "'>" .
            Html::button('Vos trucs', array('class' => 'btn btn-default')) .
            "</a><br>";

        //Boutton modify categories, only for admins
        if ($this->context->canCreateCategory()) {
            echo  "<br><a href='" .
                $contentContainer->createUrl('/share/share/edit-categories') ."' />".
                Html::button('Modifier les catégories', array('class' => 'btn btn-danger')).
            "</a><br>";
        }
        ?>
            </div>

    </div>
</div>
