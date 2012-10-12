<?php

class News extends EMongoDocument {

    public $user_id;
    public $entities;
    public $disable_entities;

    public function embeddedDocuments() {  // встроенные, суб массивы!
        return array(
            // property name => embedded document class name
            //  'entities' => 'NewsEntity'
        );
    }
    
    public function behaviors()
    {
      return array(
        array(
          'class'=>'ext.YiiMongoDbSuite.extra.EEmbeddedArraysBehavior',
          'arrayPropertyName'=>'entities', // name of property
          'arrayDocClassName'=>'News_Entity' // class name of documents in array
        ),
      );
    }

    /**
     * This method have to be defined in every Model
     * @return string MongoDB collection name, witch will be used to store documents of this model
     */
    public function getCollectionName() {
        return 'news';
    }

    /**
     * We can define rules for fields, just like in normal CModel/CActiveRecord classes
     * @return array
     */
    public function rules() {
        return array(
            array('user_id', 'required'),
//            array('user_id', 'integerOnly' => true),
        );
    }

    /**
     * This method have to be defined in every model, like with normal CActiveRecord
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function beforeSave() {
        return parent::beforeSave();
    }
    
    protected static function push($user_id, $entity_id, $name){
        $criteria = new EMongoCriteria();
        $criteria->addCond('user_id', '==', $user_id);
        
        $news = News::model()->find($criteria);
        if(!$news){
            $news = new News();
            $news->user_id = $user_id;
        }
        
        $entity = false;
        if($news->entities){
            foreach ($news->entities as $key => $en){
                if($en->id == $entity_id && $en->name == $name){
                    $entity = $news->entities[$key];
                    unset($news->entities[$key]);
                }
            }
        }
        
        
        return array($news, $entity);
    }
    
    public static function pushComment($user_id, $entity_id, $name, $text, $create_at, $comment, $likes = null, $dislikes = null){
        list($news, $entity) = News::push($user_id, $entity_id, $name);
        
        if(!$entity){       // если новая запись на стене
            $entity = new News_Entity();
            $entity->id = $entity_id;
            $entity->name = $name;
            $entity->create_at = $create_at;
            $entity->template = 'news';
            $entity->likes->attributes = $likes;
            $entity->dislikes->attributes = $dislikes;
        }
        // эти параметры следовало бы обновить в любом случае
        $entity->text = $text;
        $entity->template = 'news';
        $entity->comment->attributes = $comment;
        if(isset($comment['likes']) && isset($comment['dislikes'])){
            $entity->comment->likes->attributes = $comment['likes'];
            $entity->comment->dislikes->attributes = $comment['dislikes'];
        }
        
        $news->entities[] = $entity;
        return $news->save();
    }
    
//    public static function pushLikeDislike($user_id, $entity_id, $name){
//        list($news, $entity) = News::push($user_id, $entity_id, $name);
//    }
    
    public function afterFind() {
        if(!$this->disable_entities){
            $this->disable_entities = array();
        }
        return parent::afterFind();
    }
}