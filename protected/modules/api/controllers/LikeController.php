<?php

/**
 * Entity like
 * @package api
 */
class LikeController extends ApiController {

    public function actionPostLike($id, $entity) {
        $this->likeUpdate($id, $entity, 1);
    }
    
    public function actionPostDislike($id, $entity) {
        $this->likeUpdate($id, $entity, -1);
    }
    
    private function likeUpdate($id, $entity, $value) {}
}