<?php

/**
 * This is the model class for table "spottings".
 *
 * The followings are the available columns in table 'spottings':
 * @property string $id
 * @property integer $added_by
 * @property string $date_spotted
 * @property string $date_added
 * @property string $location
 * @property integer $points
 * @property string $comment
 * @property integer $country_id
 * @property integer $vehicle_id
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Users $addedBy
 */
class Spottings extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Spottings the static model class
     */
    public static function model($className = __CLASS__){
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
	return 'spottings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('added_by, points, country_id, vehicle_id, deleted', 'numerical', 'integerOnly' => true),
	    array('location', 'length', 'max' => 200),
	    array('date_spotted, date_added, comment', 'safe'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, added_by, date_spotted, date_added, location, points, comment, country_id, vehicle_id, deleted', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'addedBy' => array(self::BELONGS_TO, 'Users', 'added_by'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
	return array(
	    'id'	   => 'ID',
	    'added_by'     => 'Added By',
	    'date_spotted' => 'Date Spotted',
	    'date_added'   => 'Date Added',
	    'location'     => 'Location',
	    'points'       => 'Points',
	    'comment'      => 'Comment',
	    'country_id'   => 'Country',
	    'vehicle_id'   => 'Vehicle',
	    'deleted'      => 'Deleted',
	);
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search(){
	// Warning: Please modify the following code to remove attributes that
	// should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id, true);
	$criteria->compare('added_by', $this->added_by);
	$criteria->compare('date_spotted', $this->date_spotted, true);
	$criteria->compare('date_added', $this->date_added, true);
	$criteria->compare('location', $this->location, true);
	$criteria->compare('points', $this->points);
	$criteria->compare('comment', $this->comment, true);
	$criteria->compare('country_id', $this->country_id);
	$criteria->compare('vehicle_id', $this->vehicle_id);
	$criteria->compare('deleted', $this->deleted);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

    /**
     * The id of the vehicle to get the spottings on
     */
    public function getVehicleSpottings($id){
	$connection = Yii::app()->db;
	$sql	= "SELECT u.id as user_id,
u.username as user_name,
date_spotted,
date_added,
location,
c.name as country_name,
s.comment
FROM spottings s
LEFT JOIN users u ON
s.added_by = u.id
LEFT JOIN countries c ON
c.id = s.country_id
WHERE vehicle_id = :vehicleId
ORDER BY date_spotted DESC";
	$command    = $connection->createCommand($sql);
	$command->bindParam(":vehicleId", $id, PDO::PARAM_INT);
	$spottings  = $command->queryAll();
	return $spottings;
    }
    
    
        public function getlast5Spottings(){
	$connection = Yii::app()->db;
	$sql	= "
SELECT u.id as user_id,
u.username as user_name,
s.date_spotted,
s.date_added,
s.vehicle_id,
v.bodywork as vehicle_bodywork,
v.registration as vehicle_registration,
v.fleet_number as vehicle_fleet_number,
vmm.make as vehicle_make,
vmm.model as vehicle_model,
s.location,
c.name as country_name,
s.comment
FROM spottings s
LEFT JOIN users u ON
s.added_by = u.id
LEFT JOIN countries c ON
c.id = s.country_id
LEFT JOIN vehicles v ON
v.id = s.vehicle_id
LEFT JOIN vehicles_make_models vmm ON
vmm.id = v.make_model_id
ORDER BY date_added DESC
LIMIT 5";
	$command    = $connection->createCommand($sql);
	$spottings  = $command->queryAll();
	return $spottings;
    }
}