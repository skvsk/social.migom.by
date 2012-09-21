<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController {

    
    /**
     * Index action is the default action in a controller.
     */
    public function actionIndex() {
       $model = new AuthApi();
       $responce = $model->getLogin('migom');
       var_dump($responce);
       echo "Front not find";
    }

    /**
     * This is the action to handle external exceptions.
     * @return JsonSerializable 
     * @todo нужен обработчик ошибок
     */
    public function actionError() {
    }

}