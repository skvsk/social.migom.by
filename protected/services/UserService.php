<?php

class UserService {
    
    public static $images_mime = array('image/jpeg' => 'jpg');
    
    public static function uploadAvatarFromService($user_id, $file_url){
        $imageSize = getimagesize($file_url);
        if($imageSize){
            $path = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '..';
            $destination = $path . Users::AVATAR_PATH . DIRECTORY_SEPARATOR . $user_id;
            @mkdir($destination, 0777, true);
            if(copy($file_url, $destination . DIRECTORY_SEPARATOR . 'avatar.' . UserService::$images_mime[$imageSize['mime']])){
                return Users::AVATAR_PATH . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . 'avatar.' . UserService::$images_mime[$imageSize['mime']];
            }
            return false;
        }
    }
    
    public static function uploadAvatar($user_id, $file){
        $image = Yii::app()->image->load($file['avatar']);
        $image->resize(50, 50, Image::NONE)->quality(75);
        $path = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . '..';
        $destination = $path . Users::AVATAR_PATH . DIRECTORY_SEPARATOR . $user_id;
        @mkdir($destination, 0777, true);
        return $image->save($destination . DIRECTORY_SEPARATOR. 'avatar.jpg');
    }
    
    public static function printAvatar($id, $login){
        return CHtml::link(
            CHtml::image(Yii::app()->getBaseUrl().'/images/users/'.$id.'/avatar.jpg', $login, array('style' => 'width:50px; height:50px; border: 1px solid black', 'class' => 'avatar', 'border' => 0)),
            ($id != Yii::app()->user->id) ? array('/user/index', 'id' => $id) : array('/user/index')
            
        );
    }
}
