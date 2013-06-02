<?php

/**
 * This is the model class for table "vehicles".
 *
 * The followings are the available columns in table 'vehicles':
 * @property integer $id
 * @property integer $make_model_id
 * @property string $bodywork
 * @property string $registration
 * @property string $fleet_number
 * @property integer $date_built
 * @property string $date_scrapped
 * @property integer $deleted
 * @property string $date_added
 * @property integer $added_by
 *
 * The followings are the available model relations:
 * @property OperatingLocations[] $operatingLocations
 * @property VehicleComments[] $vehicleComments
 * @property VehicleRevisions[] $vehicleRevisions
 * @property Users $addedBy
 * @property VehiclesMakeModels $makeModel
 */
class Vehicles extends CActiveRecord
{

    var $make;
    var $model;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Vehicles the static model class
     */
    public static function model($className = __CLASS__){
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
	return 'vehicles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('make_model_id, bodywork, registration, fleet_number', 'required'),
	    array('make_model_id, date_built, deleted, added_by', 'numerical', 'integerOnly' => true),
	    array('bodywork', 'length', 'max' => 200),
	    array('registration', 'length', 'max' => 100),
	    array('fleet_number', 'length', 'max' => 20),
	    array('date_scrapped', 'length', 'max' => 4),
	    array('date_added', 'safe'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, make_model_id, bodywork, registration, fleet_number, date_built, date_scrapped, deleted, date_added, added_by', 'safe', 'on' => 'search'),
	);
    }

    /**
     * Get basic information on a vehicle
     * @param int $id The id of the vehicle to get the information on 
     * @return array of vehicle information 
     */
    public function getBasicInfo($id){
	// Basic vehicle information
	$connection = Yii::app()->db;
	$sql	= "
SELECT vmm.make,
vmm.model,
v.bodywork,
v.registration,
v.fleet_number,
v.date_built,
v.date_scrapped,
v.make_model_id
FROM vehicles v
LEFT JOIN vehicles_make_models vmm ON
vmm.id = v.make_model_id
WHERE v.id = :vehicleId";
	$command    = $connection->createCommand($sql);
	$command->bindParam(":vehicleId", $id, PDO::PARAM_INT);
	$vehicle    = $command->queryAll();
	return $vehicle[0];
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'operatingLocations' => array(self::HAS_MANY, 'OperatingLocations', 'vehicle_id'),
	    'vehicleComments' => array(self::HAS_MANY, 'VehicleComments', 'vehicle_id'),
	    'vehicleRevisions' => array(self::HAS_MANY, 'VehicleRevisions', 'vehicle_id'),
	    'addedBy' => array(self::BELONGS_TO, 'Users', 'added_by'),
	    'makeModel' => array(self::BELONGS_TO, 'VehiclesMakeModels', 'make_model_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
	return array(
	    'id'	    => 'ID',
	    'make_model_id' => 'Make Model',
	    'bodywork'      => 'Bodywork',
	    'registration'  => 'Registration',
	    'fleet_number'  => 'Fleet Number',
	    'date_built'    => 'Date Built',
	    'date_scrapped' => 'Date Scrapped',
	    'deleted'       => 'Deleted',
	    'date_added'    => 'Date Added',
	    'added_by'      => 'Added By',
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

	$criteria->compare('id', $this->id);
	$criteria->compare('make_model_id', $this->make_model_id);
	$criteria->compare('bodywork', $this->bodywork, true);
	$criteria->compare('registration', $this->registration, true);
	$criteria->compare('fleet_number', $this->fleet_number, true);
	$criteria->compare('date_built', $this->date_built);
	$criteria->compare('date_scrapped', $this->date_scrapped, true);
	$criteria->compare('deleted', $this->deleted);
	$criteria->compare('date_added', $this->date_added, true);
	$criteria->compare('added_by', $this->added_by);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

    /**
     * Gets the last 5 vehicles added to the system
     * @return array 
     */
    public function getLast5Added(){
	$connection = Yii::app()->db;
	$sql	= "
	SELECT CONCAT(CONCAT(make, ' '),model) as make_model,
v.bodywork,
v.registration as vehicle_registration,
v.date_added,
u.username,
v.id as vehicle_id
FROM vehicles v
LEFT JOIN vehicles_make_models vmm ON
vmm.id = v.make_model_id
LEFT JOIN users u ON
u.id = v.added_by
ORDER BY v.id DESC
LIMIT 5    
	";
	$dataReader = $connection->createCommand($sql)->query();
	$rows       = $dataReader->readAll();
	return $rows;
    }
}