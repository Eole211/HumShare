<?php

namespace humhub\modules\share;

use Yii;

use humhub\modules\share\models\Link;
use humhub\modules\share\models\Category;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\content\components\ContentContainerModule;

class Module extends ContentContainerModule
{

    /**
     * @inheritdoc
     */
    public function getContentContainerTypes()
    {
        return [
            User::className(),
            Space::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getContentContainerConfigUrl(ContentContainerActiveRecord $container)
    {
        return $container->createUrl('/share/share/config');
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        parent::disable();
    }




    /**
     * On build of a Space Navigation, check if this module is enabled.
     * When enabled add a menu item
     *
     * @param type $event        	
     */
    public static function onSpaceMenuInit($event)
    {

        $space = $event->sender->space;
        if ($space->isModuleEnabled('share') && $space->isMember()) {
            $event->sender->addItem(array(
                'label' => Yii::t('ShareModule.base', 'share'),
                'url' => $space->createUrl('/share/share'),
                'icon' => '<i class="fa fa-link"></i>',
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'share')
            ));
        }
    }


}
