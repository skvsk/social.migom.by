<?php

class ApiException extends CComponent {

    public function init(){}

    /**
     * @param string $message
     */
        public function __construct($message) {
            Yii::app()->controller->module->render->sendResponse(array('message'=>$message));
            Yii::app()->end();
        }

}
