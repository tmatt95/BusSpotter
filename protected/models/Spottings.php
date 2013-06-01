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
 * @property integer $location_id
 *
 * The followings are the available model relations:
 * @property Users $addedBy
 * @property Locations $location0
 */
class Spottings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Spottings the static model class
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
		return 'spottings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('added_by, points, location_id', 'numerical', 'integerOnly'=>true),
			array('location', 'length', 'max'=>200),
			array('date_spotted, date_added, comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, added_by, date_spotted, date_added, location, points, comment, location_id', 'safe', 'on'=>'search'),
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
			'location0' => array(self::BELONGS_TO, 'Locations', 'location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'added_by' => 'Added By',
			'date_spotted' => 'Date Spotted',
			'date_added' => 'Date Added',
			'location' => 'Location',
			'points' => 'Points',
			'comment' => 'Comment',
			'location_id' => 'Location',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('added_by',$this->added_by);
		$criteria->compare('date_spotted',$this->date_spotted,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('points',$this->points);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('location_id',$this->location_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}