<?php

/**
 * Work with user comment
 * @package api
 */
class CommentsController extends ApiController {

    public function actionGetComment($id) {}
    public function actionGetUserList($id, $limit, $start = null) {}
    public function actionGetEntityList($entity, $id, $limit = null, $start = null) {
        $res = array();
        $class = ucfirst($entity) . 'Comments';
       
        $criteria = new CDbCriteria;
        $criteria->condition = '`t`.`entity_id` = :entity_id and `t`.`status` = :status';
        $criteria->params = array(':entity_id' => $id, 
                                  ':status' => Comments::STATUS_PUBLISHED);
        if ($limit) {
            $criteria->limit = $limit;
        }

        if ($start) {
            $criteria->offset = $start;
        }
        $rawData = $class::model()->with(array('users'=>array('together'=>true)))->findAll($criteria);
//        $dataProvider=new CArrayDataProvider($rawData);
//        $res = $dataProvider->getData();
//        foreach ($res as $value) {
//            $value->user =  $value->users;
//        }
////        $comments = array();
////        foreach ($res as $value) {
////            
////            $comments[] = $value;
////        }
//       
//        dd(CJSON::encode($rawData));
//         dd($rawData);
        $content = array('comments' => $rawData, 'count' => count($rawData));
        $this->render()->sendResponse($content);
    }
    
    public function actionPostComment($value, $user_id, $entity, $parent = 0) {}
    
    public function actionDeliteComment($id, $entity, $recursive = true) {}
    
    public function actionPutComment($id, $entity, $params = array()) {}
    
}