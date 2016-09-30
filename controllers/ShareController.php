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
     * Action that renders the view to add or edut a category.<br />
     * The request has to provide the id of the category to edit in the url parameter 'category_id'.
     * @see views/share/addCategory.php
     * @throws HttpException 404, if the logged in User misses the rights to access this view.
     */
    public function actionAddCategory()
    {
        if(!$this->canCreateCategory()){
            throw new HttpException(404, "Vous n'avez pas les droits pour éditer les catégories, sacripant !");
        }

        $category_id = (int) Yii::$app->request->get('category_id');
        $category = Category::find()->contentContainer($this->contentContainer)->where(array('share_category.id' => $category_id))->one();

        if ($category == null) {
            $category = new Category;
            $category->content->container = $this->contentContainer;
        }

        //We get the post parameters
        $post=Yii::$app->request->post();

        //If we do have a Category, we check it and save it, then redirection to index
        if(isset($post['Category'])) {
            $category->name = $post["Category"]['name'];
            if ($category->validate() && $category->save()) {
                $this->redirect($this->contentContainer->createUrl('/share/share/edit-categories'));
            }
        }

        return $this->render('addCategory', array(
            'category' => $category,
        ));
    }


    /**
     * Action that deletes a given category.<br />
     * The request has to provide the id of the category to delete in the url parameter 'category_id'.
     * @throws HttpException 404, if the logged in User misses the rights to access this view.
     */
    public function actionDeleteCategory()
    {
        if(!$this->canCreateCategory()){
            throw new HttpException(404, "Vous n'avez pas les droits pour éditer les catégories, sacripant !" );
        }


        $category_id = (int) Yii::$app->request->get('category_id');
        $category = Category::find()->contentContainer($this->contentContainer)->where(array('share_category.id' => $category_id))->one();

        if ($category == null) {
            throw new HttpException(404, "La catégorie demandée est introuvable, et c'est bien dommage");
        }

        $category->delete();

        $this->redirect($this->contentContainer->createUrl('/share/share/edit-categories    '));
    }



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
