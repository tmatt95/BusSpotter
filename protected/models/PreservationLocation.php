<?php

/**
 * This is the model class for table "preservation_location".
 *
 * The followings are the available columns in table 'preservation_location':
 * @property integer $id
 * @property string $owners_name
 * @property string $date_added
 * @property integer $vehicle_id
 * @property string $date_from
 * @property string $date_to
 *
 * The followings are the available model relations:
 * @property Vehicles $vehicle
 */
class PreservationLocation extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PreservationLocation the static model class
     */
    public static function model($className = __CLASS__){
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
	return 'preservation_location';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('vehicle_id', 'numerical', 'integerOnly' => true),
	    array('owners_name', 'length', 'max' => 200),
	    array('date_from, date_to', 'length', 'max' => 45),
	    array('date_added', 'safe'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, owners_name, date_added, vehicle_id, date_from, date_to', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	    'vehicle' => array(self::BELONGS_TO, 'Vehicles', 'vehicle_id'),
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
	return array(
	    'id'	  => 'ID',
	    'owners_name' => 'Owners Name',
	    'date_added'  => 'Date Added',
	    'vehicle_id'  => 'Vehicle',
	    'date_from'   => 'Date From',
	    'date_to'     => 'Date To',
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
	$criteria->compare('owners_name', $this->owners_name, true);
	$criteria->compare('date_added', $this->date_added, true);
	$criteria->compare('vehicle_id', $this->vehicle_id);
	$criteria->compare('date_from', $this->date_from, true);
	$criteria->compare('date_to', $this->date_to, true);

	return new CActiveDataProvider($this, array(
		    'criteria' => $criteria,
		));
    }

    /**
     * Gets all the preservation locations a vehicle has been in
     * @param int $id The id of the vehicle
     * @return array 
     */
    public function getPreservationLocsForVehicle($id){
	// Operating Locations
	$connection	    = Yii::app()->db;
	$sql		   = "	SELECT owners_name,
date_added,
vehicle_id,
date_from,
date_to 
FROM preservation_location pl
WHERE vehicle_id = :vehicleId
ORDER BY date_from ASC";
	$command	       = $connection->createCommand($sql);
	$command->bindParam(":vehicleId", $id, PDO::PARAM_INT);
	$preservationLocations = $command->queryAll();
	return $preservationLocations;
    }
}