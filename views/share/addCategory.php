<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\share\models\category;
use humhub\compat\CActiveForm;
use yii\helpers\Html;

/**
 * View to add or edit a category
 * @var Category $category;
 */
?>


<div class="panel panel-default">
    <?php if ($category->isNewRecord) : ?>
        <div class="panel-heading"><strong>Create</strong> new category</div>
    <?php else: ?>
        <div class="panel-heading"><strong>Edit</strong> category</div>
    <?php endif; ?>

    <div class="panel-body">

        <?php
        $form = CActiveForm::begin();
        $form->errorSummary($category);
        ?>

        <div class="form-group">
            <?php
            //Field with the category's name
            echo $form->labelEx($category, 'name');
            echo $form->textField($category, 'name', array('class' => 'form-control'));
            echo $form->error($category, 'name'); ?>
        </div>


        <?php echo Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>

        <?php CActiveForm::end();

        ?>
    </div>
</div>