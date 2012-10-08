<?php
class NewsComments extends Comments
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