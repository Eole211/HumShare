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

            <?php echo $form->labelEx($object, 'category'); ?>


            <?php echo $form->field($object,'category')->dropDownList([1=>'test',2=>'bites']); ?>

            <?php echo $form->error($object, 'name'); ?>
        </div>



        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>

        <?php CActiveForm::end();

?>
    </div>
</div>