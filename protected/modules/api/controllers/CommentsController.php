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
        return $entity;
    }

    /**
     * @ignore
     * @param type $id
     */
    public function actionGetComment($id)
    {
        
    }

    /**
     * @ignore
     * @param type $id
     * @param type $limit
     * @param type $start
     */
    public function actionGetUserList($id, $limit, $start = null)
    {
        
    }

    /**
     * @ignore
     * @param type $entity
     * @param type $id
     * @param type $limit
     * @param type $start
     */
    public function actionGetEntityList($entity, $id, $limit = null, $start = null)
    {
        $res = array();
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
        $rawData = Comments::model($entity)->with('user')->findAll($criteria);

        //TODO Как то не правельно related элименты так получать
        foreach ($rawData as $value) {

            $row = array();
            foreach ($value as $key => $attr) {
                $row[$key] = $attr;
            }
            foreach ($value->user as $key => $attr) {
                $row['user'][$key] = $attr;
            }
//            foreach ($value->profile as $key => $attr) {
//                $row['users']['profile'][$key] = $attr;
//            }

            $res[] = $row;
        }

        $content = array(self::CONTENT_COMMENTS => $res, ApiComponent::CONTENT_COUNT => count($res));
        $this->render()->sendResponse($content);
    }
    
    /**
     * @ignore
     * @param string $entity
     * @param int $id
     * @param int $iser_id
     */
    public function actionGetEntityUserList($entity, $id)
    {
        $userId = (int)Yii::app()->request->getParam('user_id');
        $res = array();
        $criteria = new CDbCriteria;
        $criteria->condition = '`t`.`user_id` = :user_id and `t`.`entity_id` = :entity_id and `t`.`status` != :status';
        $criteria->params = array(':entity_id' => $id,
                                  ':status' => Comments::STATUS_DELETED,
                                  ':user_id' => $userId);
        $rawData = Comments::model($entity)->with('user')->findAll($criteria);

        //TODO Как то не правельно related элименты так получать
        foreach ($rawData as $value) {
            $row = array();
            foreach ($value as $key => $attr) {
                $row[$key] = $attr;
            }
            foreach ($value->user as $key => $attr) {
                $row['user'][$key] = $attr;
            }
            $res[] = $row;
        }

        $content = array(self::CONTENT_COMMENTS => $res, ApiComponent::CONTENT_COUNT => count($res));
        $this->render()->sendResponse($content);
    }

    public function actionPostEntity($entity)
    {
        $class = 'Comments_' . $entity;
        $comment = new $class(); //Comments::model($entity);
        $comment->attributes = $_POST;
        $comment->parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'] > 0) ? $_POST['parent_id'] : 0;
        $comment->save();

        $content = array(self::CONTENT_COMMENT => $comment->attributes);
        $this->render()->sendResponse($content);
    }

    /**
     * @ignore
     * @param type $id
     * @param type $entity
     * @param type $recursive
     */
    public function actionDeliteComment($id, $entity, $recursive = true)
    {
        
    }

    /**
     * @ignore
     * @param type $id
     * @param type $entity
     * @param type $params
     */
    public function actionPutComment($id, $entity, $params = array())
    {
        
    }

}