<?php

/**
 * @ignore
 */
class ApiModule extends CWebModule {

    public $keys;
    private $urlManager = array(
        'GET' => array(
            'api' => 'default/index',
            'api/<controller:\w+>/<action:\w+>/<id:\d+>' => 'api/<controller>/get<action>',
            'api/<controller:\w+>/<action:\w+>/<key:\w+>' => 'api/<controller>/get<action>',
            'api/<controller:\w+>/<_a:(list)>' => 'api/<controller>/get<_a>',
        ),
        'POST' => array(
            'api/<controller:\w+>/<action:\w+>/<key:\w+>' => 'api/<controller>/post<action>',
        ),
        'PUT' => array(
            'api/<controller:\w+>/<_a:(update)>/<key:\w+>' => 'api/<controller>/put<_a>',
        ),
        'DELETE' => array(
            'api/<controller:\w+>/<action:\w+>/<puid:\w+>' => 'api/<controller>/delete<action>',
        ),
    );

    /**
     * this method is called when the module is being created
     * you may place code here to customize the module or the application
     *  import the module-level models and components
     */
    public function init() {
//        var_dump($_SERVER["REDIRECT_URL"], $_SERVER["REQUEST_METHOD"]);
//        var_dump($_POST);
        $this->setImport(array(
//            'api.models.*',
            'api.components.*',
        ));
        Yii::app()->log->routes->enabled=false;
        $this->setComponents(array(
                                'render'=>array('class'=>'Render'),
            ), true);
        
        Yii::app()->urlManager->addRules($this->urlManager[CHttpRequest::getRequestType()], false);
        
        Yii::app()->getErrorHandler()->errorAction = 'api/default/pageNotFound';
    }

    public function beforeControllerAction($controller, $action) {
        $className = get_class($controller);
        if ($className != 'AuthController' && $className != 'DefaultController') {
            if (!$this->isAuth()) {
                return false;
            }
        }
//        var_dump($className);
//        var_dump($action);
//        die('------');
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    private function isAuth() {
        $key = Yii::app()->getRequest()->getParam('key');
        if (!$key) {
            return true;
        }
        $cache = Yii::app()->cache->get($key);
        if ($cache === false) {
            new ApiException(Yii::t('Api', 'Auth error'));
            return false;
        }
        Yii::app()->controller->module->render->setContentType($cache['type']);
        return true;
    }

}
