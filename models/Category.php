<?php

namespace humhub\modules\share\models;

use Yii;

/**
 * This is the model class for table "share_object".
 *
 * @package humhub.modules.share.models
 * The followings are the available columns in table 'share_category':
 * @property integer $id
 * @property string $name
 */

class Category extends \humhub\modules\content\components\ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{
    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        return array(
            'name' => $this->name
        );
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'share_category';
    }

    public static function getAll($contCont){
        return Category::find()->contentContainer($contCont)->all();
    }
}
