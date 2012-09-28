<?php

/**
 * This is the model class for table "news_comments".
 *
 * The followings are the available columns in table 'news_comments':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $entity_id
 * @property integer $user_id
 * @property string $text
 * @property integer $like
 * @property integer $dislike
 * @property integer $status
 * @property integer $level
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comments extends CActiveRecord {

    const STATUS_UNMODERATED = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHET = 2;
    const STATUS_DELETED = 3;
    
    public $owner_id = 0;
    public $level = 0;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NewsComments the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('entity_id, user_id', 'required'),
            array('parent_id, entity_id, user_id, like, dislike, status, level, created_at, updated_at', 'numerical', 'integerOnly' => true),
            array('text', 'safe'),
            array('text', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, entity_id, user_id, text, like, dislike, status, level, created_at, updated_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'profile'=>array(self::HAS_ONE,'Profile',array('id'=>'user_id'),'through'=>'users'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('Site', 'ID'),
            'parent_id' => Yii::t('Site', 'Parent'),
            'entity_id' => Yii::t('Site', 'Entity'),
            'user_id' => Yii::t('Site', 'User'),
            'text' => Yii::t('Site', 'Text'),
            'like' => Yii::t('Site', 'Likes'),
            'dislike' => Yii::t('Site', 'Dislikes'),
            'status' => Yii::t('Site', 'Status'),
            'level' => Yii::t('Site', 'Level'),
            'created_at' => Yii::t('Site', 'Created At'),
            'updated_at' => Yii::t('Site', 'Updated At'),
        );
    }

    protected function beforeSave() {
//        if ($this->getIsNewRecord()) {
//            if ($this->hasAttribute('created_at')) {
//                $this->created_at = new CDbExpression('NOW()');
//            }
//
//            if ($this->hasAttribute('user_id')) {
//                if (!(Yii::app()->user->isGuest)) {
//                    $this->user_id = Yii::app()->user->id;
//                }
//            }
//        } else {
//            if ($this->hasAttribute('updated_at')) {
//                $this->updated_at = new CDbExpression('NOW()');
//            }
//        }

        return parent::beforeSave();
    }

}