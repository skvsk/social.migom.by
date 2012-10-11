<?php

class CommandService {
    
    public static function createParamsString(array $params = array()){
        $paramString = '';
        foreach($params as $k => $v){
            $paramString .= ' --' . $k . '=' . $v;
        }
        return $paramString;
    }
}
