<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\share\permissions;

use Yii;
use humhub\modules\space\models\Space;

/**
 * CreateTask Permission
 */
class CreateCategory extends \humhub\libs\BasePermission
{

    /**
     * @inheritdoc
     */
    protected $defaultAllowedGroups = [
        Space::USERGROUP_OWNER,
        Space::USERGROUP_ADMIN,
    ];
    
    /**
     * @inheritdoc
     */
    protected $fixedGroups = [
        Space::USERGROUP_GUEST,
        Space::USERGROUP_OWNER,
        Space::USERGROUP_ADMIN,
    ];

    /**
     * @inheritdoc
     */
    protected $title = "Create category";

    /**
     * @inheritdoc
     */
    protected $description = "Allows the user to create new category";

    /**
     * @inheritdoc
     */
    protected $moduleId = 'share';

}
