<?php

class UserController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
//	public function actions()
//	{
//		return array(
//			// captcha action renders the CAPTCHA image displayed on the contact page
//			'captcha'=>array(
//				'class'=>'CCaptchaAction',
//				'backColor'=>0xFFFFFF,
//			),
//		);
//	}
    
        public $layout = 'user';
        public $title = 'User Controller Param(change in action)';
        
        public function filters()
	{
		return array(
			'accessControl',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        array('allow', // allow readers only access to the view file
                            'actions'=>array('index', 'edit'),
                            'users' => array('*')
                        ),
                        array('deny',   // deny everybody else
                            'users' => array('*')
                        ),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $id = Yii::app()->request->getParam('id', Yii::app()->user->id);
            $model = $this->loadModel($id);
            $this->render('profile', array('model' => $model));
	}
        
        public function actionEdit()
	{
            if(Yii::app()->user->getIsGuest()){
                throw new CHttpException(404,'The requested page does not exist.');
            }
            $id = Yii::app()->user->id;
            $model = $this->loadModel($id);
            $model->setScenario('general_update');
            
            if (Yii::app()->getRequest()->isAjaxRequest && Yii::app()->getRequest()->getParam('ajax') == 'generalForm') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            if (Yii::app()->getRequest()->isAjaxRequest && Yii::app()->getRequest()->getParam('ajax') == 'profileForm') {
                $model->profile->setScenario('update');
                echo CActiveForm::validate($model->profile);
                Yii::app()->end();
            }
            
            if(isset($_POST['Profile']) && $_POST['Profile']){
                $model->profile = setScenario('update');
                $model->profile->attributes = $_POST['Profile'];
                if($model->profile->validate() && $model->profile->save())
                    $this->redirect('/user/index');
            }
            
            if(isset($_POST['Users']) && $_POST['Users']){
                $model->setScenario('general_update');
                $model->attributes = $_POST['Users'];
                if($model->validate() && $model->save())
                    $this->redirect('/user/index');
            }
            
            $this->render('edit', array('model' => $model));
	}
        
        public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}