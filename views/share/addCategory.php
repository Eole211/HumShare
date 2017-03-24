<?php

 /**
 * View to add or edit a category
 * @var Category $category;
 */

use humhub\modules\share\models\category;
use yii\widget\ActiveForm;
use yii\helpers\Html;

humhub\modules\share\Assets::register($this);
?>


<div class="panel panel-default">
    <?php if ($category->isNewRecord) : ?>
        <div class="panel-heading"><strong>Create</strong> new category</div>
    <?php else: ?>
        <div class="panel-heading"><strong>Edit</strong> category</div>
    <?php endif; ?>

    <div class="panel-body">

        <?php
        $form = ActiveForm::begin();
        $form->errorSummary($category);
        ?>

        <div class="form-group">
            <?php
            //Field with the category's name
            echo $form->labelEx($category, 'name');
            echo $form->textField($category, 'name', array('class' => 'form-control'));
            echo $form->error($category, 'name'); ?>
        </div>


        <?= Html::submitButton('Save', array('class' => 'btn btn-primary')); ?>

        <?php ActiveForm::end();

        ?>
    </div>
</div>
