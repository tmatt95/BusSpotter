<?php

/**
 * This is the model class for table "operating_location_revisions".
 *
 * The followings are the available columns in table 'operating_location_revisions':
 * @property integer $id
 * @property integer $vehicle_revision_id
 * @property string $country
 * @property string $location
 * @property string $date_from
 * @property string $date_to
 * @property string $owners_name
 * @property integer $preservation
 * @property integer $deleted
 * @property integer $added_by
 * @property string $date_added
 *
 * The followings are the available model relations:
 * @property Users $addedBy
 * @property VehicleRevisions $vehicleRevision
 */
class OperatingLocationRevisions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OperatingLocationRevisions the static model class
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
		return 'operating_location_revisions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_revision_id, preservation, deleted, added_by', 'numerical', 'integerOnly'=>true),
			array('country, location, owners_name', 'length', 'max'=>200),
			array('date_from, date_to', 'length', 'max'=>4),
			array('date_added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_revision_id, country, location, date_from, date_to, owners_name, preservation, deleted, added_by, date_added', 'safe', 'on'=>'search'),
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
			'addedBy' => array(self::BELONGS_TO, 'Users', 'added_by'),
			'vehicleRevision' => array(self::BELONGS_TO, 'VehicleRevisions', 'vehicle_revision_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_revision_id' => 'Vehicle Revision',
			'country' => 'Country',
			'location' => 'Location',
			'date_from' => 'Date From',
			'date_to' => 'Date To',
			'owners_name' => 'Owners Name',
			'preservation' => 'Preservation',
			'deleted' => 'Deleted',
			'added_by' => 'Added By',
			'date_added' => 'Date Added',
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
		$criteria->compare('vehicle_revision_id',$this->vehicle_revision_id);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('date_from',$this->date_from,true);
		$criteria->compare('date_to',$this->date_to,true);
		$criteria->compare('owners_name',$this->owners_name,true);
		$criteria->compare('preservation',$this->preservation);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('added_by',$this->added_by);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}