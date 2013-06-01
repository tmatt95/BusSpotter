<?php

/**
 * This is the model class for table "operating_locations".
 *
 * The followings are the available columns in table 'operating_locations':
 * @property integer $id
 * @property integer $vehicle_id
 * @property integer $operator_id
 * @property integer $location_id
 * @property string $date_from
 * @property string $date_to
 * @property string $owners_name
 * @property integer $preservation
 * @property integer $deleted
 * @property string $date_added
 * @property integer $added_by
 *
 * The followings are the available model relations:
 * @property Vehicles $vehicle
 * @property Locations $location
 * @property Operators $operator
 * @property VehicleRevisions[] $vehicleRevisions
 */
class OperatingLocations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OperatingLocations the static model class
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
		return 'operating_locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id, date_from, date_to', 'required'),
			array('vehicle_id, operator_id, location_id, preservation, deleted, added_by', 'numerical', 'integerOnly'=>true),
			array('date_from, date_to', 'length', 'max'=>4),
			array('owners_name', 'length', 'max'=>200),
			array('date_added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, operator_id, location_id, date_from, date_to, owners_name, preservation, deleted, date_added, added_by', 'safe', 'on'=>'search'),
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
			'vehicle' => array(self::BELONGS_TO, 'Vehicles', 'vehicle_id'),
			'location' => array(self::BELONGS_TO, 'Locations', 'location_id'),
			'operator' => array(self::BELONGS_TO, 'Operators', 'operator_id'),
			'vehicleRevisions' => array(self::HAS_MANY, 'VehicleRevisions', 'operating_location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_id' => 'Vehicle',
			'operator_id' => 'Operator',
			'location_id' => 'Location',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'owners_name' => 'Owners Name',
			'preservation' => 'Preservation',
			'deleted' => 'Deleted',
			'date_added' => 'Date Added',
			'added_by' => 'Added By',
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
		$criteria->compare('vehicle_id',$this->vehicle_id);
		$criteria->compare('operator_id',$this->operator_id);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('owners_name',$this->owners_name,true);
		$criteria->compare('preservation',$this->preservation);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('added_by',$this->added_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Gets operation information for a vehicle.
	 * 
	 * Note this does not get the preservation information. For this, use the
	 * PreservationLocation model function.
	 * 
	 * @param int $id The id of the vehicle
	 * @return array of vehicle operating locations / information 
	 */
	public function getOperatingLocationsForVehicle($id){
	    	// Operating Locations
	$connection	 = Yii::app()->db;
	$sql		= "
SELECT o.name as operatingName,
c.name as country_name,
c.id as country_id,
l.name as operatingLocation,
ol.date_from,
ol.date_to
FROM operating_locations ol
LEFT JOIN locations l ON
l.id = ol.location_id
LEFT JOIN operators o ON
o.id = ol.operator_id
LEFT JOIN countries c ON
c.id = l.country_id
WHERE vehicle_id = :vehicleId
AND preservation = 0
ORDER BY date_from ASC";
	$command	    = $connection->createCommand($sql);
	$command->bindParam(":vehicleId", $id, PDO::PARAM_INT);
	$operatingLocations = $command->queryAll();
	
	return $operatingLocations;
	}
}