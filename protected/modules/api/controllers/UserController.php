<?php
/**
 * Work with user
 * @package api
 */
class UserController extends ApiController {

    /**
     * Check Login
     * @todo Реализовать проверку авторозованности
     * @param string $puid
     */
    public function actionGetAuth() {
        $puid = $_GET['puid'];
        $user = Yii::app()->cache->get('user_' . $puid);
        if($user){
            $content = array(ApiComponent::CONTENT_MESSAGE => Yii::t('Api', 'User is auth'), 
                             ApiComponent::CONTENT_ID => $user['id'],
                             'auth' => true,
                             ApiComponent::CONTENT_SUCCESS => true);
        }else{
            $content = array(ApiComponent::CONTENT_MESSAGE => Yii::t('Api', 'User is not auth'),
                             'auth' => false,
                             ApiComponent::CONTENT_SUCCESS => true);
        }
        $this->render()->sendResponse($content);
    }

    /**
     * Logout
     * @todo Реализовать логаут
     * @param string $key - puid
     */
    public function actionDeleteAuth($puid) {
        Yii::app()->cache->delete('user_' . $puid);
        $this->render()->sendResponse(array(ApiComponent::CONTENT_MESSAGE => Yii::t('Api', 'User logout'),
                                               ApiComponent::CONTENT_SUCCESS => true));
    } 

    /**
     * Login
     * @todo Реализовать логин
     * @param string $login
     * @param string $paswd
     */
    public function actionPostAuth() {
        $login = $_POST['login']; 
        $paswd = $_POST['paswd'];
        if($login == 'login' && $paswd == 'paswd'){
            $puid = 'asd';
            Yii::app()->cache->set('user_' . $puid, array('id' => 100));
            
            $content = array(ApiComponent::CONTENT_MESSAGE => Yii::t('Api', 'User is auth'),
                             ApiComponent::CONTENT_PUID => $puid);
        }else{
            $content = array(ApiComponent::CONTENT_MESSAGE => Yii::t('Api', 'User is not auth'));
        }
        $this->render()->sendResponse($content);
    }

}