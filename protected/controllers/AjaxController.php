<?php

class AjaxController extends Controller
{
        
//        public function filters()
//	{
//		return array(
//			'accessControl',
//		);
//	}
//
//	/**
//	 * Specifies the access control rules.
//	 * This method is used by the 'accessControl' filter.
//	 * @return array access control rules
//	 */
//	public function accessRules()
//	{
//		return array(
//                        array('allow', // allow readers only access to the view file
//                            'actions'=>array('edit', 'deletenew'),
//                            'roles' => array('user', 'moderator', 'administrator')
//                        ),
//                        array('allow', // allow readers only access to the view file
//                            'actions'=>array(),
//                            'users' => array('*')
//                        ),
//                        array('deny',   // deny everybody else
//                            'users' => array('*')
//                        ),
//		);
//	}
    
        public function init() {
            if(!Yii::app()->request->isAjaxRequest){
                $this->redirect('/user/index');
            }
        }
        
        public function actionUserNews(){
            $criteria = new EMongoCriteria();
            $criteria->addCond('user_id', 'equals', Yii::app()->user->id); 
            $news = News::model()->find($criteria);
            if(!$news){
                $news = new News();
                $news->user_id = Yii::app()->user->id;
            }
            if(isset($news->disable_entities[Yii::app()->request->getParam('filter')])){
                unset($news->disable_entities[Yii::app()->request->getParam('filter')]);
            } else {
                $news->disable_entities[Yii::app()->request->getParam('filter')] = Yii::app()->request->getParam('filter');
            }
            $news->save();
            $this->renderPartial('userNews', array('news' => $news));
        }
}