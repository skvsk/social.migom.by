<?php

/**
 * Work with user comment
 * @package api
 */
class CommentsController extends ApiController
{

    const CONTENT_COMMENTS = 'comments';
    const CONTENT_COMMENT = 'comment';

    private function _getModelName($entity)
    {
        return $this->getId() . '_' . ucfirst($entity);
    }

    public function actionGetComment($id)
    {
        
    }

    public function actionGetUserList($id, $limit, $start = null)
    {
        
    }

    public function actionGetEntityList($entity, $id, $limit = null, $start = null)
    {
        $res = array();
        $class = $this->_getModelName($entity);

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
        $rawData = $class::model()->with('users')->findAll($criteria);

        //TODO Как то не правельно related элименты так получать
        foreach ($rawData as $value) {
            $row = array();
            foreach ($value as $key => $attr) {
                $row[$key] = $attr;
            }
            foreach ($value->users as $key => $attr) {
                $row['users'][$key] = $attr;
            }
//            foreach ($value->profile as $key => $attr) {
//                $row['users']['profile'][$key] = $attr;
//            }

            $res[] = $row;
        }

        $content = array(self::CONTENT_COMMENTS => $res, ApiComponent::CONTENT_COUNT => count($res));
        $this->render()->sendResponse($content);
    }

    public function actionPostEntity($entity)
    {
        $class = $this->_getModelName($entity);
        $comment = new $class();
        $comment->attributes = $_POST;
        $comment->parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'] > 0) ? $_POST['parent_id'] : 0;
        $comment->save();

        $content = array(self::CONTENT_COMMENT => $comment->attributes);
        $this->render()->sendResponse($content);
    }

    public function actionDeliteComment($id, $entity, $recursive = true)
    {
        
    }

    public function actionPutComment($id, $entity, $params = array())
    {
        
    }

}