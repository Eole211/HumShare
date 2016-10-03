<?php
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;
/**
 * @var Object[] $objects
 * @var \humhub\modules\content\models\ContentContainer $contentContainer
 *
 * Used to display a list of object
 */
?>
<table>
                <tr>
                    <th>Objet</th>
                    <th>propriétaire</th>
                </tr>
                <?php
                foreach ($objects as $obj) {
                    $user = User::find()->where(['id' => $obj->user])->one();
                    $profil = Profile::find()->where(['user_id' => $obj->user])->one();
                    echo "<tr><td> 
<a href='".$contentContainer->createUrl('/share/share/object-page',['object_id'=>$obj->id])."'>
$obj->name</a></td><td style='padding-left: 10px'>";

                    if ($user != null && $profil != null) {
                        echo "<a href='index.php?r=user%2Fprofile%2Fhome&uguid={$user->guid}'>{$profil->firstname} {$profil->lastname}</a>";
                    }
                    echo "</td></tr>";
                } ?>
</table>

