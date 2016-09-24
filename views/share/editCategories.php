<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\share\models\Category;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;

/**
 * Category List for editing
 *
 * @uses $accesslevel the access level of the user currently logged in.
 *
 * @var Category[] $categories
 * @var ContentContainer $contentContainer
 * @var User $user
 */

humhub\modules\share\Assets::register($this);

if($this->context->canCreateCategory()){
?>
<div class="panel-body">
                <div class="media">
                    <ul>
                    <?php
                    //Show All categories
                    foreach($categories as $cat){
                        echo "<li>".$cat->name."</li>";
                    }
                    ?>
                    </ul>

<?php
                    echo "<a href='".
            $contentContainer->createUrl('/share/share/add-category').
                    "'>Ajouter une catégorie
                    </a>";
                    ?>
                   </div>
    </div>
<?php }