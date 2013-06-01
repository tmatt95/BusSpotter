<?php

/**
 * This is the model class for table "locations".
 *
 * The followings are the available columns in table 'locations':
 * @property integer $id Unique id of the location
 * @property string $name Name of the location
 * @property integer $pres_location Whether or not it is a preserved location
 * @property integer $deleted Whether the location has been deleted
 * @property integer $added_by Id of the user who added the location
 * @property string $date_added Date the location was added
 * @property string $country_id Id of the country that the location is within
 * @property integer $spotting_location Whether the location is a spotting location or that of a bus depot
 * @property string $open_street_map_link A link to the open street map item of the location
 *
 * The followings are the available model relations:
 * @property Users $addedBy
 * @property Countries $country
 * @property OperatingLocations[] $operatingLocations
 * @property Spottings[] $spottings
 */
class Locations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Locations the static model class
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
		return 'locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, pres_location, deleted, added_by, spotting_location', 'numerical', 'integerOnly'=>true),
			array('name, open_street_map_link', 'length', 'max'=>200),
			array('country_id', 'length', 'max'=>10),
			array('date_added', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, pres_location, deleted, added_by, date_added, country_id, spotting_location, open_street_map_link', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Countries', 'country_id'),
			'operatingLocations' => array(self::HAS_MANY, 'OperatingLocations', 'location_id'),
			'spottings' => array(self::HAS_MANY, 'Spottings', 'location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'pres_location' => 'Pres Location',
			'deleted' => 'Deleted',
			'added_by' => 'Added By',
			'date_added' => 'Added Date',
			'country_id' => 'Country',
			'spotting_location' => 'Spotting Location',
			'open_street_map_link' => 'Open Street Map Link',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('pres_location',$this->pres_location);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('added_by',$this->added_by);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('spotting_location',$this->spotting_location);
		$criteria->compare('open_street_map_link',$this->open_street_map_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}