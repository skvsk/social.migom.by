<?php

class AuthController extends ApiController {

    private $salt = 'al&hhGFFDYbeHappy';

    /**
     * Auth method
     * @method POST
     * @param string $key
     * @param string $type
     */
    public function actionLogin($key, $type = Render::TYPE_JSON) {
        $keys = $this->module->keys;
//        var_dump($keys);
//        var_dump($key);
//        dd(Yii::app()->request->userHostAddress);
//        die;
        $render = $this->render();
        $type = strtolower($type);
        if (!$render->isValidType($type)) {
            $render->setStatus(render::STATUS_BAD_REQUEST)->sendResponse(array('message' => Yii::t('Api', 'Invalid type ' . $type)));
        }
        $render->setContentType($type);
        
        if (array_key_exists($key, $keys) && $keys[$key] == CHttpRequest::getUserHostAddress()) {
            $suid = md5($key . $this->salt . $keys[$key] . $type);
            Yii::app()->cache->set($suid, array('type' => $type));
            $render->sendResponse(array('suid' => $suid));
            return true;
        } else {
            $render->setStatus(render::STATUS_BAD_REQUEST)->sendResponse(array('message' => Yii::t('Api', 'Not auth')));
        }
        
    }
}