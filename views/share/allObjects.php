<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\share\models\category;
use humhub\modules\share\models\object;
use humhub\compat\CActiveForm;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;
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
        if(count($objects)>0) { ?>
            <table>
                <tr>
                    <th>Objet</th>
                    <th>propriétaire</th>
                </tr>
                <?php
                foreach ($objects as $obj) {
                    $user = User::find()->where(['id' => $obj->user])->one();
                    $profil = Profile::find()->where(['user_id' => $obj->user])->one();
                    echo "<tr><td>$obj->name</td><td style='padding-left: 10px'>";

                    if ($user != null && $profil != null) {
                        echo "<a href='index.php?r=user%2Fprofile%2Fhome&uguid={$user->guid}'>{$profil->firstname} {$profil->lastname}</a>";
                    }
                    echo "</td></tr>";
                } ?>
            </table>
        <?php
        }
        else{
            echo "Catégorie vide !";
        }
    }


    ?>

</div>
 </div>
    </div>