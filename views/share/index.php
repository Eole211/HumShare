<?php

use humhub\compat\CActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\share\models\SharedObject;
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
    <div class="panel-body">

        <?php
        //Formatting the categories into a simple array (id=>name) for the dropdown
        $catDropArray = array();
        $catDropArray[0] = "Toutes les catégories";
        foreach ($categories as $cat) {
            $catDropArray[$cat->id] = $cat->name;
        } ?>

        <!-- Search Form -->
        <div class="form-group"> <?php
            $form = CActiveForm::begin();

            //object to handle form datas and validation
            $searchForm = new SearchForm();

            //handling parameters
            if (!isset($categoryId) || $categoryId == null) {
                $categoryId = 0;
            }
            if (isset($terms) && $terms != null) {
                $searchForm->terms = $terms;
            }

            $searchForm->category=$categoryId;

            echo $form->field($searchForm, 'terms')->textInput()->input('Recherche', ['placeholder' => "Tous les trucs"])->label('Votre recherche');

            echo $form->field($searchForm, 'category')
                ->dropDownList(
                    $catDropArray
                )->label('Catégorie');

            ?><div style='text-align:center'><?php
            echo Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Rechercher  ', array('class' => 'btn btn-primary', 'style'=>'width:330px;'));
           ?> </div><?php
            CActiveForm::end();
            ?>
        </div>

        <?php
        //Show the list of objects if necessary
        if (isset($objects)) {
            require(__DIR__ . '/objectsList.php');
        }
        ?>
        <hr>

        <!-- Buttons -->
        <div style='text-align:center'>
            <?php
            echo
                //Button add an Object
                " <a href='" .
                $contentContainer->createUrl('/share/share/add-object') .
                "'>" .
                Html::button('Ajouter un trucs à partager', array('class' => 'btn btn-default')) .

                //Button your objects
                " <a href='" .
                $contentContainer->createUrl('/share/share/objects-of-user', ['userId' => Yii::$app->user->id]) .
                "'>" .
                "<button class='btn btn-default'><i class='glyphicon glyphicon-user'></i> Vos trucs</button>" .
                "</a><br>";

            //Button modify categories, only for admins
            if ($this->context->canCreateCategory()) {
                echo "<br><a href='" .
                    $contentContainer->createUrl('/share/share/edit-categories') . "' />" .
                    Html::button('Modifier les catégories', array('class' => 'btn btn-danger')) .
                    "</a><br>";
            }
            ?>
        </div>

    </div>
</div>
