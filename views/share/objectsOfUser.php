<?php

use humhub\modules\user\models\User;
use humhub\modules\share\models\SharedObject;
use humhub\modules\user\models\Profile;
use yii\helpers\Html;

 /**
 * @param Profile $profil
 */

humhub\modules\share\Assets::register($this);

$noUserTd=true;

//This indicate that's it's not a search but the user's objects
$categoryId=-1;
?>
<div class="panel panel-default">
    <div style="float:right;padding: 5px"><a href="<?= $contentContainer->createUrl('/share/share/index')?> ">
            <?= Html::button('Retour', array('class' => 'btn btn-default')) ?>
        </a>
    </div>

    <div class="panel-heading"><strong>Les trucs de <?= $profil->firstname . " " . $profil->lastname ?></strong>
    </div>
    <div class="panel-body">
        <?php
        if (isset($objects)) {
            if (count($objects) > 0) {
                require(__DIR__ . '/objectsList.php');
            } else {
                echo "Pas de trucs ici !";
            }
        }
        ?>
    </div>
</div>
