<?php

/**
 * This is the model class for table "users".
 * 
 * Contains all the users
 *
 * The followings are the available columns in table 'users':
 * @property integer $id the id of the user
 * @property string $username Username
 * @property string $email E-mail address
 * @property string $password Password
 * @property string $date_joined Date the user joined
 * @property integer $left Whether the user has left
 * @property string $left_date Date they left the site
 * @property integer $banned If the user is banned
 *
 * The followings are the available model relations:
 * @property Locations[] $locations
 * @property OperatingLocationRevisions[] $operatingLocationRevisions
 * @property Operators[] $operators
 * @property Spottings[] $spottings
 * @property VehicleComments[] $vehicleComments
 * @property VehicleRevisions[] $vehicleRevisions
 * @property Vehicles[] $vehicles
 */
class Users extends CActiveRecord {

    var $passAgain;
    public $verifyCode;

    /**
     * Generate a random salt in the crypt(3) standard Blowfish format.
     *
     * @param int $cost Cost parameter from 4 to 31.
     *
     * @throws Exception on invalid cost parameter.
     * @return string A Blowfish hash salt for use in PHP's crypt()
     */
    function blowfishSalt($cost = 13) {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new Exception("cost parameter must be between 4 and 31");
        }
        $rand = array();
        for ($i = 0; $i < 8; $i += 1) {
            $rand[] = pack('S', mt_rand(0, 0xffff));
        }
        $rand[] = substr(microtime(), 2, 6);
        $rand = sha1(implode('', $rand), true);
        $salt = '$2a$' . sprintf('%02d', $cost) . '$';
        $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
        return $salt;
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,email', 'unique'),
            array('username, password,email,passAgain', 'required'),
            array('password', 'length','allowEmpty'=>false,'max'=>100,'min'=>'4'),
            array('email', 'email'),
            array('id, left, banned', 'numerical', 'integerOnly' => true),
            array('username', 'length', 'max' => 50),
            array('email', 'length', 'max' => 250),
            array('password', 'length', 'max' => 100),
            array('date_joined, left_date', 'safe'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, email, date_joined, left, left_date, banned', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'locations' => array(self::HAS_MANY, 'Locations', 'added_by'),
            'operatingLocationRevisions' => array(self::HAS_MANY, 'OperatingLocationRevisions', 'added_by'),
            'operators' => array(self::HAS_MANY, 'Operators', 'added_by'),
            'spottings' => array(self::HAS_MANY, 'Spottings', 'added_by'),
            'vehicleComments' => array(self::HAS_MANY, 'VehicleComments', 'added_by'),
            'vehicleRevisions' => array(self::HAS_MANY, 'VehicleRevisions', 'added_by'),
            'vehicles' => array(self::HAS_MANY, 'Vehicles', 'added_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'date_joined' => 'Date Joined',
            'left' => 'Left',
            'left_date' => 'Left Date',
            'banned' => 'Banned',
            'passAgain' => 'Password Again'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('date_joined', $this->date_joined, true);
        $criteria->compare('left', $this->left);
        $criteria->compare('left_date', $this->left_date, true);
        $criteria->compare('banned', $this->banned);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}