<?php

namespace humhub\modules\share\models;

use Yii;

/**
 * This is the model class for table "share_object".
 *
 * @package humhub.modules.share.models
 * The followings are the available columns in table 'share_object':
 * @property integer $id
 * @property integer $user
 * @property string $name
 * @property string $description
 * @property integer $category
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
            'user' => $this->user,
            'description'=>$this->description,
            'category'=>$this->category
        );
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return 'share_object';
    }

    /**
     * @param $contCont
     * @param $category
     * @return Object[]
     */
    public static function fromCategory($contCont,$category){
        return Object::find()->contentContainer($contCont)->where(array('share_object.category' => $category))->all();
    }

}
