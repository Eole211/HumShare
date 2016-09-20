<?php

namespace humhub\modules\share\models;

use Yii;

/**
 * This is the model class for table "share_object".
 *
 * @package humhub.modules.share.models
 * The followings are the available columns in table 'linklist_link':
 * @property integer $id
 * @property integer $userId
 * @property string $name
 */

class Object extends \humhub\modules\content\components\ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{
    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        return array(
            'name' => $this->name,
            'userId' => $this->userId
        );
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'share_object';
    }

}
