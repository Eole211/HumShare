<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\share\permissions;

use humhub\modules\admin\libs\HumHubAPI;
use humhub\modules\space\models\Space;

/**
 * CreateTask Permission
 */
class CreateObject extends \humhub\libs\BasePermission
{

    /**
     * @inheritdoc
     */
    public $defaultAllowedGroups = [
        Space::USERGROUP_OWNER,
        Space::USERGROUP_ADMIN,
        Space::USERGROUP_MODERATOR,
        Space::USERGROUP_MEMBER
    ];
    
    /**
     * @inheritdoc
     */
    protected $fixedGroups = [
        Space::USERGROUP_USER
    ];

    /**
     * @inheritdoc
     */
    protected $title = "Create object";

    /**
     * @inheritdoc
     */
    protected $description = "Allows the user to create new object";

    /**
     * @inheritdoc
     */
    protected $moduleId = 'share';

}
