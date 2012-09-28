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
        
        //TODO Как то не правельно related элименты так получать
        foreach ($rawData as $value) {
            $row = array();
            foreach ($value as $key => $attr) {
                $row[$key] = $attr;
                
            }
            foreach ($value->users as $key => $attr) {
                $row['users'][$key] = $attr;
            }
            $res[] = $row;
        }
        
        $content = array('comments' => $res, 'count' => count($res));
        $this->render()->sendResponse($content);
    }
    
    public function actionPostComment($value, $user_id, $entity, $parent = 0) {}
    
    public function actionDeliteComment($id, $entity, $recursive = true) {}
    
    public function actionPutComment($id, $entity, $params = array()) {}
    
}