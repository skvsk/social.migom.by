<?php
class NewsEntity extends EMongoEmbeddedDocument
{
    
    public $id;
    public $name;
    public $text;
    public $create_at;
    public $template;

    
    public $params;
    
    public function embeddedDocuments() {  // встроенные, суб массивы!
        return array(
            // property name => embedded document class name
            'comment' => 'NewsEntityComment',
            'likes' => 'NewsEntityLikes',
            'dislikes' => 'NewsEntityLikes',
        );
    }
    
    // We can define rules for fields, just like in normal CModel/CActiveRecord classes
    public function rules()
    {
        return array(
            array('id, name, template, text', 'required'),
        );
    }
    
}