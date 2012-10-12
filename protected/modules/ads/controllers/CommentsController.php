<?php

class CommentsController extends Controller
{
    public function actionIndex(){
        $this->render('index');
    }
    
    public function actionList($model){
        $modelTitle = $model;
        $model= Comments::model($modelTitle);
		$model->unsetAttributes();
        if(isset($_GET['NewsComments'])){
            $model->attributes = $_GET['NewsComments'];
        }
        
        $this->render('list', array('model' => $model, 'modelTitle' => $modelTitle));
    }
    
    public function actionTree($model, $id){
        $modelTitle = $model;
        $model= Comments::model($modelTitle);
        $model = $model->findByPk($id);
        if($model->status == Comments::STATUS_UNMODERATED){
            $model->status = Comments::STATUS_UNPUBLISHED;
            $model->moderate_id = Yii::app()->user->id;
            $model->save();
        }
        
        $this->renderPartial('tree', array('model' => $model, 'modelTitle' => $modelTitle));
    }
    
    public function actionApproove($model, $id){
        $modelTitle = $model;
        $model= Comments::model($modelTitle);
        $model = $model->findByPk($id);
        $model->status = Comments::STATUS_PUBLISHED;
        if(isset($_POST[get_class($model)])){
            $model->attributes = $_POST[get_class($model)];
        }
        $model->moderate_id = Yii::app()->user->id;
        
        if($model->save()){
            if($model->parent){
                News::pushComment(
                    $model->parent->user_id, 
                    $model->parent->id, 
                    'comment',
                    $model->parent->text, 
                    $model->parent->created_at,
                    array(
                        'user_id' => $model->user_id,
                        'login' => $model->user->login,
                        'text' => $model->text,
                        'created_at' => $model->created_at,
                        'likes' => array('count' => $model->likes),
                        'dislikes' => array('count' => $model->dislikes),
                    ),
                    array('count' => $model->parent->likes),
                    array('count' => $model->parent->dislikes)      // TODO вытянуть инфу о том кто ставил лайки на пост!!! Сейчас нет еще коллекции такой в монге
                );
            }
        }
    }
    
    public function actionSave($model, $id){
        $modelTitle = $model;
        $model= Comments::model($modelTitle);
        $model = $model->findByPk($id);
        $model->attributes = $_POST[get_class($model)];
        $model->moderate_id = Yii::app()->user->id;
        $model->save();
    }
    
    public function actionDelete($model, $id){
        $modelTitle = $model;
        $model= Comments::model($modelTitle);
        $model = $model->findByPk($id);
        $model->status = Comments::STATUS_DELETED;
        $model->moderate_id = Yii::app()->user->id;
        $model->save();
    }
}
