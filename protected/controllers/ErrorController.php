<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class ErrorController extends CController {

    /**
     * Index action is the default action in a controller.
     */
    public function actionIndex() {
        if ($error = Yii::app()->errorHandler->error) {
//            echo CJSON::encode(array('code', $error['code'], 'type', $error['type']));
            print_r($error);
        }
    }

}