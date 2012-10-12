<?php

/**
 * This is the model class for table "user_providers".
 *
 * The followings are the available columns in table 'user_providers':
 * @property integer $id
 * @property integer $user_id
 * @property integer $provider_id
 * @property integer $soc_id
 */
class UserProviders extends CActiveRecord
{
        public static $providers = array(1 => 'google_oauth', 2 => 'vkontakte', 3 => 'facebook');
        private static $providersModel = array('google_oauth' => 'UserProvidersGoogleOauth', 'vkontakte' => 'UserProvidersVkontakte', 'facebook' => 'UserProvidersFacebook');
        public $provider_id;
        
        public function tableName()
	{
		return 'user_providers_google_oauth'; // default table
	}
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProviders the static model class
	 */
	public static function model($className=__CLASS__)
	{
                if($className != __CLASS__){
                    $className = self::$providersModel[$className];
                }
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, soc_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
                        array('soc_id', 'length', 'max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, soc_id', 'safe', 'on'=>'search'),
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
                    'user' => array(self::BELONGS_TO, 'Users', 'user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'soc_id' => 'Soc',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('soc_id',$this->soc_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function beforeSave() {
            parent::beforeSave();
            if($this->provider_id){
                $this->getTableSchema()->rawName = '`user_providers_' . self::$providers[$this->provider_id] . '`';
                unset($this->provider_id);
            }
            return true;
        }
        
        public function addSocialToUser($identity, $user_id){
            $userProviders = new UserProviders();
            $userProviders->soc_id          = $identity->getAttribute('soc_id');
            $userProviders->user_id         = $user_id;
            $userProviders->provider_id = array_search($identity->getProviderName(), UserProviders::$providers);
            if($userProviders->validate()){
                $userProviders->save();
                Profile::updateByProvider($userProviders->user, $identity);
            }
        }
}