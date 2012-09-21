<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class UserController extends ApiController {

    /**
     * Index action is the default action in a controller.
     */
    public function actionIsAuth() {
        Yii::app()->render->sendResponse('Welcome to migom API');
    }

}