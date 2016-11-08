<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\share\models\category;
use humhub\modules\share\models\SharedObject;
use humhub\compat\CActiveForm;
use yii\helpers\Html;

/**
 * View to add or modify an object
 *
 * @var Category[] $categories
 * @var SharedObject $object
 * @var \humhub\modules\content\models\ContentContainer $contentContainer
 */


?>

<div class="panel panel-default">
    <!-- Header-->
    <?php if ($object->isNewRecord) : ?>
        <div class="panel-heading"><strong>Ajouter un truc partageable !</strong></div>
        <?php $backUrl = $contentContainer->createUrl('/share/share/index');//Back go to index if it's a new object ?>
    <?php else: ?>
        <div class="panel-heading"><strong>Editer votre truc partageable :</strong></div>
        <?php $backUrl = $contentContainer->createUrl('/share/share/object-page', ['object_id' => $object->id, 'searchCategory' => -1]);//Back go to the object page if  the user is editing?>
    <?php endif; ?>

    <!-- Body -->
    <div class="panel-body">
        <?php
        // Form
        $form = CActiveForm::begin();
        $form->errorSummary($object);
        ?>
        <div class="form-group">
            <?php echo $form->field($object, 'name')->textInput()->label('Nom'); ?>

            <?php
            //Formatting the categories into a simple array (id=>name) for the dropdown
            $catDropArray = array();
            foreach ($categories as $cat) {
                $catDropArray[$cat->id] = $cat->name;
            }

            //Category choice dropd own
            echo $form->field($object, 'category')->dropDownList($catDropArray)->label('Catégorie');

            //Description text bow ( a MarkDown Editor widget)
            echo $form->textArea($object, 'description', array('id' => 'description', 'style' => 'height:350px;padding:10px', 'rows' => '15', 'placeholder' => "La description de votre truc"));
            echo humhub\widgets\MarkdownEditor::widget(array('fieldId' => 'description'));
            echo "<br>";

            //Address
            echo $form->field($object, 'address')->textInput()->label('Adresse');

            //Phone
            echo $form->field($object, 'phone')->textInput()->label('Téléphone');

            //Errors if fields are not correctly filled  by the user
            echo $form->error($object, 'name'); ?>
        </div>


        <?php echo Html::submitButton('Sauvegarder', array('class' => 'btn btn-primary')); ?>

        <a href="<?php echo $backUrl ?>">
            <?php echo Html::button('Annuler', array('class' => 'btn btn-default')); ?>
        </a>
        <?php CActiveForm::end();

        ?>
    </div>
</div>