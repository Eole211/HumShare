<?php

namespace humhub\modules\share\controllers;


use Yii;
use yii\web\HttpException;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\share\models\Object;
use humhub\modules\share\models\Category;

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

    public function actionEditCategories()
    {
        return $this->render('editCategories',[
            'contentContainer' => $this->contentContainer,
            'categories'=>Category::getAll($this->contentContainer)
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
        $o->user=Yii::$app->user->id;
        if($o->save()){
            return $this->redirect($this->contentContainer->createUrl('/share/share'));
        }
        else{
            throw new HttpException(404, Yii::t('LinklistModule.base', 'Erreur avec le vomit de paul'));
        }
    }






    /* PERMISSIONS */
    /**
     * @return boolean can manage wiki sites?
     */
    public function canCreateCategory()
    {
        return $this->contentContainer->permissionManager->can(new \humhub\modules\share\permissions\CreateCategory());
    }


}

?>
