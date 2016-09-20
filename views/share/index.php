<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\share\models\Object;
use humhub\modules\user\models\User;

/**
 * View to list all categories and their links.
 *
 * @uses $accesslevel the access level of the user currently logged in.
 *
 * @author Sebastian Stumpf
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
             /*
              *
              */
             $user=User::find()->where(['id' => $obj->userId])->one();


            echo "<tr><td>$obj->name</td><td>";
             if($user!=null) {
                 //var_dump($user);
                 echo "<a href='index.php?r=user%2Fprofile%2Fhome&uguid={$user->guid}'>{$user['username']}</a>";
             }
             echo "</td></tr>";

        } ?>
    </table>
</div>
