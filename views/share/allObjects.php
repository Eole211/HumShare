<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\share\models\Category;
use humhub\modules\share\models\Object;
use humhub\compat\CActiveForm;


use yii\bootstrap\Dropdown;
use yii\helpers\Html;

/**
 *  * @var Category[] $categories
 */

?>
<div class="panel panel-default">
    <div class="panel-heading">Tout les trucs</div>
    <div class="panel-body">

<?php

    //Formating the categories into a simple array (id=>name) for the dropdown
            $catDropArray=array();
            foreach($categories as $cat){
                $catDropArray[$cat->id]=$cat->name;
            }

?>
<div class="form-group"> <?php
   $form = CActiveForm::begin();

    if(!isset($categoryId)){
        $categoryId=-1;
    }
    $object=new Object();

    echo $form->field($object,'category')
        ->dropDownList(
            $catDropArray,
            //[ArrayHelper::map(User::find()->where('id' => $id)->all(), 'id', 'name')],
            ['options' =>
                [
                    $categoryId => ['selected' => true]
                ]
            ]
        )->label('Catégorie');


    echo Html::submitButton('Choisir', array('class' => 'btn btn-primary'));

     CActiveForm::end();
?> <br><br><?php

    //Display of the objects if a category is chosen
    if($categoryId>0&&isset($objects)){
        if(count($objects)>0) {
            require (__DIR__.'/objectsList.php');

        }
        else{
            echo "Catégorie vide !";
        }
    }


    ?>

</div>
 </div>
    </div>