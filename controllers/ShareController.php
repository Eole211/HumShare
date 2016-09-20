<?php

namespace humhub\modules\share\controllers;

use Yii;
use yii\web\HttpException;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\share\models\Object;

/**
 * Description of shareController.
 *
 * @package humhub.modules.share.controllers
 * @author Sebastian Stumpf
 */
class ShareController extends ContentContainerController
{
    public function actionIndex()
    {
        $objects=Object::find()->contentContainer($this->contentContainer)->all();
        return $this->render('index',[
            'contentContainer' => $this->contentContainer,
            'objects'=>$objects
        ]);
    }

    /**
     * Action that deletes a given category.<br />
     * The request has to provide the id of the link to delete in the url parameter 'link_id'.
     * @throws HttpException 404, if the logged in User misses the rights to access this view.
     */
    public function actionAddObject()
    {
        $o=new Object();
        $o->content->setContainer($this->contentContainer);
        $o->name="Le vomit de Paul Gatellier";
        $o->userId=Yii::$app->user->id;
        if($o->save()){
            return $this->redirect($this->contentContainer->createUrl('/share/share'));
        }
        else{
            throw new HttpException(404, Yii::t('LinklistModule.base', 'Erreur avec le vomit de paul'));
        }
    }


}

?>
