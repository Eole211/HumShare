<?php
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;

/**
 * @var Object[] $objects
 * @var \humhub\modules\content\models\ContentContainer $contentContainer
 *
 * Used to display a list of object
 */

//parameters of the search
isset($terms)?$searchTerms=$terms:$searchTerms=null;
isset($categoryId)?$searchCategory=$categoryId:$searchCategory=null;


//Do we show users names ?
$showUsers = !(isset($noUserTd) && $noUserTd);

if (count($objects) > 0) {
    ?>
    <table class="ui celled table"">
    <thead>
        <tr>
            <th>Objet</th>
            <?php
    if ($showUsers) {
        ?>
        <th>Propriétaire</th><?php
    }
    ?>

        </tr>
        </thead>
    <tbody>
    <?php

    $isAdmin = $contentContainer->permissionManager->can(new \humhub\modules\share\permissions\CreateCategory());

    foreach ($objects as $obj) :?>
        <tr>
            <?php
            //Object name with link to the object page
            echo "<td><a href='" . $contentContainer->createUrl('/share/share/object-page', ['object_id' => $obj->id ,'searchTerms'=>$searchTerms,'searchCategory'=>$searchCategory]) . "'>
               <b>$obj->name</b></a>
             </td>";

            //Owner's name if we need to show it
            if ($showUsers) {
                //We obtain the user and its profile (the profile contains the first name and last namme) (TODO :  put it  in the controller)
                $user = User::find()->where(['id' => $obj->user])->one();
                $profil = Profile::find()->where(['user_id' => $obj->user])->one();
                echo "<td>";
                if ($user != null && $profil != null) {
                    echo "<a target='_blank' href='{$user->getUrl()}'>{$profil->firstname} {$profil->lastname}</a>";
                }
                echo "</td>";
            }?>

        </tr>

    <?php endforeach ?>

</tbody>

</table>
<?php
} else { ?>
    <div style ='text-align:center'><b style='color:darkred'>Aucun truc trouvé !</b></div>
<?php
} ?>

