<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\share\models\Object;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;

/**
 *
 * @uses $accesslevel the access level of the user currently logged in.
 *
 * @var Object[] $objects
 * @var ContentContainer $contentContainer
 * @var User $user
 */


humhub\modules\share\Assets::register($this);
?>

<div >
    <a href="<?php echo $contentContainer->createUrl('/share/share/add-object')?>">NOUVEAU VOMIT</a>
    <br><br>

    <table>
        <tr> <th>Objet</th><th>propriétaire</th> </tr>
        <?php


         foreach($objects as $obj){

             $user=User::find()->where(['id' => $obj->user])->one();
             $profil=Profile::find()->where(['user_id' => $obj->user])->one();


            echo "<tr><td>$obj->name</td><td style='padding-left: 10px'>";
             if($user!=null && $profil!=null) {
                 //var_dump($user);
                 echo "<a href='index.php?r=user%2Fprofile%2Fhome&uguid={$user->guid}'>{$profil->firstname} {$profil->lastname}</a>";
             }
             echo "</td></tr>";

        } ?>
    </table>
    <?php
    if($this->context->canCreateCategory()){
        echo "<a href='".
            $contentContainer->createUrl('/share/share/edit-categories').
            "'>Modifier catégories
           </a>";
    }
    ?>

</div>
