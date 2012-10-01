<?php

class CommentsApi extends API {

    const STATUS_UNMODERATED = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 2;
    const STATUS_DELETED = 3;

    public function attributeNames() {
        return array();
    }

}