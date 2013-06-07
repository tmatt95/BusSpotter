<?php

/**
 * This is the model class for table "operators".
 *
 * The followings are the available columns in table 'operators':
 * @property integer $id
 * @property string $name
 * @property integer $deleted
 * @property integer $added_by
 * @property string $wikipedia_link
 * @property string $date_added
 *
 * The followings are the available model relations:
 * @property OperatingLocations[] $operatingLocations
 * @property Users $addedBy
 */
class Operators extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Operators the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'operators';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name', 'required'),
            array('deleted, added_by', 'numerical', 'integerOnly' => true),
            array('name, wikipedia_link', 'length', 'max' => 200),
            array('date_added', 'safe'),
            array('name, deleted, added_by, wikipedia_link, date_added', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'operatingLocations' => array(
                self::HAS_MANY,
                'OperatingLocations',
                'operator_id'
            ),
            'addedBy' => array(
                self::BELONGS_TO,
                'Users',
                'added_by'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'deleted' => 'Deleted',
            'added_by' => 'Added By',
            'wikipedia_link' => 'Wikipedia Link',
            'date_added' => 'Date Added',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('deleted', $this->deleted);
        $criteria->compare('added_by', $this->added_by);
        $criteria->compare('wikipedia_link', $this->wikipedia_link, true);
        $criteria->compare('date_added', $this->date_added, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}