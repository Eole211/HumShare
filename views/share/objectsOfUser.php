<?php

humhub\modules\share\Assets::register($this);
use humhub\modules\user\models\User;
use humhub\modules\share\models\Object;
use humhub\modules\user\models\Profile;

/**
 * @param Profile $profil
 */

$noUserTd=true;
?>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Les trucs de <?php echo $profil->firstname . " " . $profil->lastname ?></strong>
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