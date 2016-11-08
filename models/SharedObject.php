<?php

namespace humhub\modules\share\models;

use humhub\modules\content\models\ContentContainer;
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
 * @property string $address
 * @property string $phone
 */
class SharedObject extends \humhub\modules\content\components\ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{

    static $wordInTitleWeight=2;
    static $wordInDescriptionWeight=1;
    static $sentenceInTitleWeight=4;
    static $sentenceInDescriptionWeight=2;





    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        return array(
            'name' => $this->name,
            'user' => $this->user,
            'description' => $this->description,
            'category' => $this->category,
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
     * @param ContentContainer $contentContainer
     * @param int $category
     * @param string $terms
     * @return Object[]
     */

    public static function search($contentContainer,$category, $terms){
        if($category==0 || $category=="0") {
            $objects = SharedObject::getAll($contentContainer);
        }
        else{
            $objects=SharedObject::fromCategory($contentContainer,$category);
        }

        //triming space and splitting the search terms
        $terms=strtolower(trim($terms));

        if($terms!="") {
            $termArr = explode(" ", $terms);
            foreach ($termArr as $k => $term) {
                $termArr[$k] = trim($term);
            }

            $objectsSearched = array();
            global $g_shareObjweights;
            $g_shareObjweights = array();

            foreach ($objects as $obj) {
                /**   @param Object $obj */

                $lowDescr = strtolower($obj->description);
                $lowName = strtolower($obj->name);


                //Calculating weight of the objects depending of the occurence of terms in its name and description
                $weight = 0;
                $weight += substr_count($lowName, $terms) * SharedObject::$sentenceInTitleWeight;
                $weight += substr_count($lowDescr, $terms) * SharedObject::$sentenceInDescriptionWeight;
                foreach ($termArr as $term) {
                    $weight += substr_count($lowName, $term) * SharedObject::$wordInTitleWeight;
                    $weight += substr_count($lowDescr, $term) * SharedObject::$wordInDescriptionWeight;
                }

                if ($weight > 0) {
                    $g_shareObjweights[$obj->id] = $weight;
                    array_push($objectsSearched, $obj);
                }
            }

            usort($objectsSearched, function ($a, $b) {
                global $g_shareObjweights;
                return $g_shareObjweights[$a->id] > $g_shareObjweights[$b->id];
            });

            return $objectsSearched;
        }
        else{
            return SharedObject::fromCategory($contentContainer,$category);
        }
    }

    public static function fromCategory($contCont, $category)
    {
        if($category==0||$category=='0'){
            return SharedObject::getAll($contCont);
        }
        return SharedObject::find()->contentContainer($contCont)->where(array('share_object.category' => $category))->orderBy(['name' => SORT_ASC])->all();
    }

    public static function fromUser($contCont, $userId){
        return SharedObject::find()->contentContainer($contCont)->where(array('share_object.user' => $userId))->orderBy(['name' => SORT_ASC])->all();
    }

    public static function getAll($contCont){
        return SharedObject::find()->contentContainer($contCont)->orderBy(['name' => SORT_ASC])->all();
    }


    public function rules()
    {
        return array(
            [['name'], 'required','message' => "Le nom de l'objet est obligatoire!"]
        );
    }

}
