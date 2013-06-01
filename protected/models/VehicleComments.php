<?php

/**
 * This is the model class for table "vehicle_comments".
 * 
 * This contains all comments which are recorded against either a vehicle or a 
 * specific vehicle. 
 *
 * The followings are the available columns in table 'vehicle_comments':
 * @property integer $id Unique id of the revision
 * @property string $date_added Date the comment was added
 * @property integer $added_by Id of the user who added the comment
 * @property string $comment The comment itself
 * @property integer $deleted Whether the comment has been deleted
 * @property integer $vehicle_id Id of the vehicle the comment is against
 * @property integer $make_model_id If the comment relates to a specific vehicle, then the id of it will be here
 *
 * The followings are the available model relations:
 * @property Users $addedBy
 * @property Vehicles $vehicle
 * @property VehiclesMakeModels $makeModel
 */
class VehicleComments extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VehicleComments the static model class
     */
    public static function model($className = __CLASS__){
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
	return 'vehicle_comments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
	return array(
	    array('date_added', 'required'),
	    array('id, added_by, deleted, vehicle_id, make_model_id', 'numerical', 'integerOnly' => true),
	    array('comment', 'safe'),
	    array('date_added, comment, deleted', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
	return array(
	    'addedBy' => array(self::BELONGS_TO, 'Users', 'added_by'),
	    'vehicle' => array(self::BELONGS_TO, 'Vehicles', 'vehicle_id'),
	    'makeModel' => array(self::BELONGS_TO, 'VehiclesMakeModels', 'make_model_id'),
	);
    }

    public function attributeLabels(){
	return array(
	    'id'	    => 'ID',
	    'date_added'    => 'Date Added',
	    'added_by'      => 'Added By',
	    'comment'       => 'Comment',
	    'deleted'       => 'Deleted',
	    'vehicle_id'    => 'Vehicle',
	    'make_model_id' => 'Make Model',
	);
    }

    public function getForVehicleInd($id){
	// Basic vehicle information
	$connection = Yii::app()->db;
	$sql	= "
	    SELECT
vc.date_added,
vc.added_by,
vc.comment,
u.id as user_id,
vc.id as comment_id,
u.username
FROM vehicle_comments vc
LEFT JOIN users u  ON
vc.added_by =u.id
WHERE deleted = 0
AND vehicle_id = :vehicleId ORDER BY date_added DESC";
	$command    = $connection->createCommand($sql);
	$command->bindParam(":vehicleId", $id, PDO::PARAM_INT);
	$comments   = $command->queryAll();
	return $comments;
    }
    
    /**
     * Gets the last 5 comments left against an individual bus
     * @return type 
     */
    public function getLast5IndBus(){
		$connection = Yii::app()->db;
	$sql	= "	SELECT
vc.date_added,
vc.added_by,
vc.comment,
u.id,
u.username,
v.registration,
v.fleet_number,
vc.vehicle_id, 
vmm.make as vehicle_make,
vmm.model as vehicle_model,
v.bodywork as vehicle_bodywork
FROM vehicle_comments vc
LEFT JOIN users u  ON
vc.added_by =u.id
LEFT JOIN vehicles v ON
v.id = vc.make_model_id
LEFT JOIN vehicles_make_models vmm ON
vmm.id = v.make_model_id
WHERE vc.deleted = 0
AND vc.vehicle_id IS NOT NULL
ORDER BY vc.date_added DESC
LIMIT 5";
	$command    = $connection->createCommand($sql);
	$comments   = $command->queryAll();
	return $comments;
    }
}