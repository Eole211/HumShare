<?php

use humhub\modules\space\widgets\Menu;
use humhub\modules\user\widgets\ProfileMenu;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\modules\space\widgets\Sidebar;

return [
    'id' => 'share',
    'class' => 'humhub\modules\share\Module',
    'namespace' => 'humhub\modules\share',
    'events' => [
        array('class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => array('humhub\modules\share\Module', 'onSpaceMenuInit')),
    ],
];
?>
