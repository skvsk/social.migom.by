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
class NewsComments extends Comments
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NewsComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news_comments';
	}
        
        public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
                    'parent' => array(self::BELONGS_TO, 'NewsComments', 'parent_id'),
		);
	}
}