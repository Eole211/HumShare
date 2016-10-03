<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\share\models\category;
use humhub\modules\share\models\object;
use humhub\compat\CActiveForm;
use yii\helpers\Html;

/**
 *  * @var Category[] $categories
 */



?>

<div class="panel panel-default">
        <?php if ($object->isNewRecord) : ?>
            <div class="panel-heading"><strong>Ajouter un truc partageable !</strong></div>
        <?php else: ?>
            <div class="panel-heading"><strong>Editer votre truc partageable :</strong></div>
        <?php endif; ?>
        <div class="panel-body">

            <?php
            $form = CActiveForm::begin();
            $form->errorSummary($object);
    ?>

        <div class="form-group">

            <?php echo $form->labelEx($object, 'name'); ?>
            <?php echo $form->textField($object, 'name', array('class' => 'form-control')); ?>

            <?php
            //Formating the categories into a simple array (id=>name) for the dropdown
            $catDropArray=array();
            foreach($categories as $cat){
                $catDropArray[$cat->id]=$cat->name;
            }

            //Category choice dropdown
                echo $form->field($object,'category')->dropDownList($catDropArray)->label('Catégorie');

           echo $form->textArea($object, 'description', array('id' => 'description', 'style' => 'height:350px;padding:10px', 'rows' => '15', 'placeholder' => "La description de votre truc"));
           echo humhub\widgets\MarkdownEditor::widget(array('fieldId' => 'description'));
            ?>

            <?php echo $form->error($object, 'name'); ?>
        </div>



        <?php echo Html::submitButton('Sauvegarder', array('class' => 'btn btn-primary')); ?>

            <a href="<?php echo $contentContainer->createUrl('/share/share/index') ?>">
        <?php echo Html::button('Annuler', array('class' => 'btn btn-default')); ?>
            </a>
        <?php CActiveForm::end();

?>
    </div>
</div>