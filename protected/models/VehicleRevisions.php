<?php

/**
 * This is the model class for table "vehicle_revisions".
 * 
 * It contains information which has changed about a vehicle enabling a history
 * to be kept of all the changes.
 *
 * The followings are the available columns in table 'vehicle_revisions':
 * @property integer $id Unique id of the record
 * @property string $make Make of the vehicle
 * @property string $model Model of the vehicle
 * @property string $bodywork Bodywork of the vehicle
 * @property string $registration Registration of the vehicle
 * @property string $year_built Date the vehicle was built
 * @property string $fleet_number Fleet nukmber of the vehicle
 * @property string $date_scrapped Date scrapped (if no longer around)
 * @property string $date_added Date the revision was added
 * @property integer $added_by The user who made the revision
 * @property string $comments A comment to describe the revision
 *
 * The followings are the available model relations:
 * @property OperatingLocationRevisions[] $operatingLocationRevisions
 * @property Vehicles $vehicle
 * @property OperatingLocations $operatingLocation
 * @property Users $addedBy
 */
class VehicleRevisions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VehicleRevisions the static model class
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
		return 'vehicle_revisions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('added_by, operating_location_id', 'numerical', 'integerOnly'=>true),
			array('make, model, bodywork', 'length', 'max'=>200),
			array('registration', 'length', 'max'=>100),
			array('year_built, date_scrapped', 'length', 'max'=>4),
			array('fleet_number', 'length', 'max'=>20),
			array('date_added, comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, make, model, bodywork, registration, year_built, fleet_number, date_scrapped, date_added, added_by, comments', 'safe', 'on'=>'search'),
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
			'operatingLocationRevisions' => array(self::HAS_MANY, 'OperatingLocationRevisions', 'vehicle_revision_id'),
			'addedBy' => array(self::BELONGS_TO, 'Users', 'added_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'make' => 'Make',
			'model' => 'Model',
			'bodywork' => 'Bodywork',
			'registration' => 'Registration',
			'year_built' => 'Date Built',
			'fleet_number' => 'Fleet Number',
			'date_scrapped' => 'Date Scrapped',
			'date_added' => 'Date Added',
			'added_by' => 'Added By',
			'comments' => 'Comments',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter 
	 * conditions.
	 * @return CActiveDataProvider the data provider that can return the 
	 * models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('make',$this->make,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('bodywork',$this->bodywork,true);
		$criteria->compare('registration',$this->registration,true);
		$criteria->compare('year_built',$this->year_built,true);
		$criteria->compare('fleet_number',$this->fleet_number,true);
		$criteria->compare('date_scrapped',$this->date_scrapped,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('added_by',$this->added_by);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}