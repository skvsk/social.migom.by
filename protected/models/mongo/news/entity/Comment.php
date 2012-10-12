<?php
class NewsEntityComment extends EMongoEmbeddedDocument
{
    
    public $user_id;
    public $text;
    public $create_at;
    public $login;
    
    public function embeddedDocuments() {  // встроенные, суб массивы!
        return array(
            // property name => embedded document class name
            'likes' => 'NewsEntityLikes',
            'dislikes' => 'NewsEntityLikes'
        );
    }
    
    // We can define rules for fields, just like in normal CModel/CActiveRecord classes
    public function rules()
    {
        return array(
            array('user_id, create_at, text, login', 'required'),
        );
    }
}