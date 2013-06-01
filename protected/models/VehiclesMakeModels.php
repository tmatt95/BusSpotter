<?php

/**
 * This is the model class for table "vehicles_make_models".
 * 
 * It contains general information on all the makes / models of bus which are 
 * recorded in the database. For information on specific vehicles (e.g R127 EVX)
 * please look at the vehicles table.
 *
 * The followings are the available columns in table 'vehicles_make_models':
 * @property integer $id Unique id of the record
 * @property string $make Make
 * @property string $model Model
 * @property string $wikipedia_link Link to the wikipedia article on the vehicle
 *
 * The followings are the available model relations:
 * @property VehicleComments[] $vehicleComments
 * @property Vehicles[] $vehicles
 */
class VehiclesMakeModels extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VehiclesMakeModels the static model class
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
		return 'vehicles_make_models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('make, model, wikipedia_link', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, make, model, wikipedia_link', 'safe', 'on'=>'search'),
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
			'vehicleComments' => array(self::HAS_MANY, 'VehicleComments', 'make_model_id'),
			'vehicles' => array(self::HAS_MANY, 'Vehicles', 'make_model_id'),
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
			'wikipedia_link' => 'Wikipedia Link',
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
		$criteria->compare('make',$this->make,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('wikipedia_link',$this->wikipedia_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}