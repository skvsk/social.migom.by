<?php

class UserService {
    
    public static $images_mime = array('image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif');
    
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
    
    public static function uploadAvatarFromEmail($user_id, $email = null){
        $gravatarHash = (!empty($email))? $email:  rand(0, 99999999);
        $gravatarHash = md5( strtolower( trim( $gravatarHash ) ) );

        return UserService::uploadAvatarFromService($user_id, 
                                'http://www.gravatar.com/avatar/'. $gravatarHash .'?f=y&d=identicon');
    }
}
