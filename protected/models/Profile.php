<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property integer $user_id
 * @property string $full_name
 * @property integer $city_id
 * @property integer $sex
 * @property integer $birthday
 */
class Profile extends CActiveRecord
{
    
        public $defaultAvatar = '/images/users/default_avatar.png';
        public $sexs = array(1 => 'male', 2 => 'female', 3 => 'children', 4 => 'unisex');
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
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
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, full_name', 'required'),
			array('user_id, city_id, birthday', 'numerical', 'integerOnly'=>true),
			array('full_name', 'length', 'max'=>255),
                        array('avatar', 'file', 'types'=>'jpg, gif, png', 'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, full_name, city_id, sex, birthday, avatar', 'safe', 'on'=>'search'),
                        array('full_name, city_id, sex, birthday', 'safe', 'on' => 'update'),
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
			'user_id' => 'User',
			'full_name' => Yii::t('Site', 'Full Name'),
			'city_id' => Yii::t('Site', 'City'),
			'sex' => Yii::t('Site', 'Sex'),
			'birthday' => Yii::t('Site', 'Birthday'),
                        'avatar' => Yii::t('Site', 'Avatar'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('city_id',$this->cuty_id);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('birthday',$this->birthday);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function updateByProvider($user, $identity){
            foreach($user->providers as $userProviders){
                if(UserProviders::$providers[$userProviders->provider_id])
                    return;
            }
            $userProviders = new UserProviders();
            $userProviders->user_id = $user->id;
            $userProviders->soc_id = $identity->getAttribute('soc_id');
            $userProviders->provider_id = array_search($identity->getProviderName(), UserProviders::$providers);
            $userProviders->save();

            foreach($user->profile->getAttributes() as $key => $val){
                if(!$val && $identity->getAttribute($key)){
                    $user->profile->{$key} = $identity->getAttribute($key);
                }
            }
            return $user->profile->save();
        }
        
        public function beforeSave() {
            parent::beforeSave();
            if(strpos($this->avatar, 'http') === 0){
                $this->avatar = UserService::uploadAvatarFromService($this->user_id, $this->avatar);
            }
            if(strlen($this->sex) > 1){
                $this->sex = array_search($this->sex, $this->sexs);
            }
            return true;
        }
}