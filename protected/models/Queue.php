<?php

/**
 * This is the model class for table "sys_job".
 *
 * The followings are the available columns in table 'sys_job':
 * @property string $id
 * @property string $what
 * @property string $param
 * @property string $next_date
 * @property string $date_interval
 * @property integer $flag_force
 * @property integer $action
 * @property string $daystr
 * @property string $timestr
 * @property integer $priority
 * @property integer $state
 * @property string $state_message
 * @property string $last_date
 * @property string $last_message
 * @property string $start_date
 * @property string $att
 * @property string $f_kill
 * @property string $sid
 */
class Queue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Queue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flag_force, action, priority, state', 'numerical', 'integerOnly'=>true),
			array('date_interval', 'length', 'max'=>11),
			array('daystr', 'length', 'max'=>12),
			array('timestr, state_message', 'length', 'max'=>255),
			array('att', 'length', 'max'=>3),
			array('f_kill', 'length', 'max'=>1),
			array('sid', 'length', 'max'=>10),
			array('what, param, next_date, last_date, last_message, start_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, what, param, next_date, date_interval, flag_force, action, daystr, timestr, priority, state, state_message, last_date, last_message, start_date, att, f_kill, sid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'what' => 'What', 
			'param' => 'Param',
			'next_date' => 'Next Date',
			'date_interval' => 'Date Interval',
			'flag_force' => 'Flag Force',
			'action' => 'Action',
			'daystr' => 'Daystr',
			'timestr' => 'Timestr',
			'priority' => 'Priority',
			'state' => 'State',
			'state_message' => 'State Message',
			'last_date' => 'Last Date',
			'last_message' => 'Last Message',
			'start_date' => 'Start Date',
			'att' => 'Att',
			'f_kill' => 'F Kill',
			'sid' => 'Sid',
		);
	}
        
        protected function beforeSave() {
            if(is_array($this->param)){
                $this->param = CommandService::createParamsString($this->param);
            }
            return parent::beforeSave();
        }
}