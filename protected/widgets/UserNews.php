<?php
class UserNews extends CWidget {
    
    public $user_id;
    public $news;

    public function run()
    {
        if($this->news){
            krsort($this->news->entities);
            foreach ($this->news->entities as $key => $en){
                if(in_array($en->name, $this->news->disable_entities)){
                    unset($this->news->entities[$key]);
                }
            }
        }
        $this->render('userNews', array('news' => $this->news));
    }
}