<?php

class DefaultController extends ApiController {

    /**
     * 
     */
    public function actionIndex() {
        $this->render()->sendResponse('Welcome to migom API');
    }

    public function actionKeyNotFound() {
        $this->render()->setStatus(ApiComponent::STATUS_BAD_REQUEST)->sendResponse(array('message' => 'Key not found'));
    }

    public function actionPageNotFound() {
        $errors = Yii::app()->getErrorHandler()->getError();
        $this->render()->setStatus($errors['code'])->sendResponse(array(ApiComponent::CONTENT_MESSAGE => Yii::t('Api', $errors['message']),
                                                                        ApiComponent::CONTENT_SUCCESS => false));
    }

}