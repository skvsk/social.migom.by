<?php

class Queue extends EMongoDocument {
    
    public $what;
    public $param;
    public $user_id;
    public $next_date;
    public $date_interval;
    public $flag_force;
    public $action;             // в работе
    public $priority;
    public $last_date;
    public $last_message;
    public $start_date;
    public $f_kill;             // отработано
    public $att;                // кол-во запусков

    /**
     * This method have to be defined in every Model
     * @return string MongoDB collection name, witch will be used to store documents of this model
     */
    public function getCollectionName() {
        return 'queue';
    }

    /**
     * We can define rules for fields, just like in normal CModel/CActiveRecord classes
     * @return array
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('priority, what', 'required'),
                    array('flag_force, action, priority', 'numerical', 'integerOnly'=>true),
                    array('date_interval', 'length', 'max'=>11),
                    array('f_kill', 'length', 'max'=>1),
                    array('what, param, next_date, last_date, last_message, start_date', 'safe'),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, what, param, next_date, date_interval, flag_force, action, daystr, timestr, priority, state, state_message, last_date, last_message, start_date, att, f_kill, sid', 'safe', 'on'=>'search'),
            );
    }

    /**
     * This method have to be defined in every model, like with normal CActiveRecord
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}