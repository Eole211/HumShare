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

if ($this->context->canCreateCategory()) {
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media">
                <table class="share-table">
                    <?php
                    //Show All categories
                    foreach ($categories as $cat) {
                        //Name of the category
                        echo "<tr><td>" . $cat->name . "</td>" .

                            //EDIT Button
                            "<td><a href='" . $contentContainer->createUrl('/share/share/add-category', ['category_id' => $cat->id]) . "'>
                       <button style='height:20px'>éditer</button></a></td>" .

                            //DELETE Button
                            "<td><a href='" . $contentContainer->createUrl('/share/share/delete-category', ['category_id' => $cat->id]) . "'>
                       <button style='height:20px;color:white;background-color:red'>supprimer</button></a></td>
                       </tr>";
                    }
                    ?>
                </table>
                <?php

                //Add a category Button
                echo "<a href='" .
                    $contentContainer->createUrl('/share/share/add-category') .
                    "'><button ><strong>Ajouter une catégorie</strong></button>
                    </a>";
                ?>
            </div>
        </div>
    </div>

<?php }