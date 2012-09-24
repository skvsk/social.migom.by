<?php
class UserMainWidget extends CWidget {

    public $model;
    
    public function run()
    {
        $this->render('UserMain', array('model' => $this->model));
    }
    
}