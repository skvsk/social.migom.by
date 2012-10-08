<?php

class Likes_Devel_Comments extends Likes
{

    /**
     * This method have to be defined in every Model
     * @return string MongoDB collection name, witch will be used to store documents of this model
     */
    public function getCollectionName()
    {
        return 'likes_test_comments';
    }

}