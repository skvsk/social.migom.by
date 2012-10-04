<?php

class Mail extends CModel{
    
    const MAX_PRIORITY = 100;
    const MIN_PRIORITY = 1;
    
    public function attributeNames(){
        return array('template', 'params');
    }
    
    public function send(Users $user, $template, $params = array(), $fast = false){
        $queue = new Queue();
        
        if($fast){
           $queue->priority = self::MAX_PRIORITY;
        } else {
            $queue->priority = self::MIN_PRIORITY;
        }
        $queue->what = 'yiic mail send';
        $params = array_merge($params, array('user_id' => $user->id, 'template' => $template));
        $queue->param = $params;
        return $queue->save();
    }
    
    public function sendAll($users, $template, $params = array(), $fast = false){
        foreach($users as $user){
            $this->send($user, $template, $params, $fast);
        }
    }
    
}