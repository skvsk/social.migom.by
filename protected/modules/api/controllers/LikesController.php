<?php

/**
 * Entity like
 * @package api
 */
class LikesController extends ApiController {
    
    const CONTENT_IS_UPDATE = 'update';

    /**
     * 
     * @param string $entity
     * @param array $id array of int array(1,23,34)
     */
    public function actionGetEntityList($entity){
        $model = $this->_getModelName($entity);
        $id = $_GET['id'];
        $criteria = new EMongoCriteria();
        $criteria->entity_id('in', implode(',', $id));
        
        /* @var $res Likes*/
        $res = $model::model()->findAll($criteria);
        
        $content = array( ApiComponent::CONTENT_ITEMS => $res, ApiComponent::CONTENT_COUNT => count($res));
        $this->render()->sendResponse($content);
    }
    
    public function actionGetEntity($entity, $id){
        $model = $this->_getModelName($entity);
        
        /* @var $res Likes*/
        $res = $model::model()->findAll(array('entity_id' => $id));
        
        $content = array( ApiComponent::CONTENT_ITEM => $res);
        $this->render()->sendResponse($content);
    }

        /**
     * Like entity
     * @param string $entity
     * @param int $id
     * @param int $user_id
     * @access (is_int($id))
     */
    public function actionPostLike($entity, $id) {
        $res = $this->_likeUpdate($id, $entity, 1);
        $this->render()->sendResponse(array(self::CONTENT_IS_UPDATE => $res));
    }
    
    /**
     * Like disentity
     * @param string $entity
     * @param int $id
     * @param int $user_id
     * @access (is_int($id))
     */
    public function actionPostDislike($entity, $id) {
        $res = $this->_likeUpdate($id, $entity, -1);
        $this->render()->sendResponse(array(self::CONTENT_IS_UPDATE => $res));
    }
    
    private function _likeUpdate($entity_id, $entity, $weight) {
        assert(is_int($entity_id));
        
        $userId = (int)$_POST['user_id'];
        $model = $this->_getModelName($entity);
        
        $criteria = new EMongoCriteria();
        $criteria->entity_id('==', $entity_id);
        
        /* @var $likes Likes*/
        if($likes = $model::model()->find($criteria)){
            foreach ($likes->users as $user) {
                if($user->id == $userId) {
                    return false;
                }
            }
        }else{
            $likes = new $model();
            $likes->entity_id = $entity_id;
        }
        
        $user =  new LikesUsers();
        $user->id = $userId;
        $user->weight = $weight;

        $likes->users[] = $user;
        $likes->setWeightInc($weight);
        $likes->save();
        return true;
    }
    
    /**
     * Create model name above inner rule
     * @param type $entity
     * @return string
     */
    private function _getModelName($entity){
        $connection = Yii::app()->cache->get($this->key);

        $class =  ucfirst($this->getId()) . '_' . ucfirst($connection['name']) . '_' . ucfirst($entity);
        if (@class_exists($class) !== true) {
            throw new ApiException(Yii::t('Likes', "Entity '{entity}' is not exist", array('{entity}' => $entity)));
        }
          
        return $class;
    }
    
}