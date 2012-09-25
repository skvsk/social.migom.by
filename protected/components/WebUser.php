<?php
class WebUser extends CWebUser {
    private $_model = null;
    private $_id = null;

    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null && $this->id)
        {
            $this->_model = Users::model()->findByPk($this->id /*array('select' => 'role')*/);
        }
        return $this->_model;
    }
    
    public function login($identity)
    {
        dd($identity);
        dd($identity->id);
        die;
        $this->id = $identity->id;
        $user = $this->getModel();
        
        // return role name
        $this->setState('role', Users::$roles[$user->role]);
        $this->setState('name', $user->login);
        parent::login($identity);
    }
}