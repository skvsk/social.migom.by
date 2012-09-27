<?php
class NewsComments extends Comment
{	
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'news_comments';
    }
}