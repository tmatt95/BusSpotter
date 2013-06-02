<?php

/**
 * This is the model class for table "v_search".
 *
 * The followings are the available columns in table 'v_search':
 * @property string $make
 * @property string $model
 * @property string $bodywork
 * @property integer $operator_id
 * @property string $country_id
 * @property string $name
 */
class VSearch extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VSearch the static model class
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
		return 'v_search';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bodywork', 'required'),
			array('operator_id', 'numerical', 'integerOnly'=>true),
			array('make, model, bodywork, name', 'length', 'max'=>200),
			array('country_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('make, model, bodywork, operator_id, country_id, name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'make' => 'Make',
			'model' => 'Model',
			'bodywork' => 'Bodywork',
			'operator_id' => 'Operator',
			'country_id' => 'Country',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('make',$this->make,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('bodywork',$this->bodywork,true);
		$criteria->compare('operator_id',$this->operator_id);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('name',$this->name,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}