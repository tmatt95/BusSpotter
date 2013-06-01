<?php

/**
 * Used to store all interactions regarding vehicle comments 
 */
class VehicleCommentsController extends Controller
{
	/**
	 * Add a comment for a individual vehicle 
	 * e.g R127 EVX 
	 */
	public function actionAddVehicleCommentInd(){	    
	    date_default_timezone_set("Europe/London");
	    
	    // Gets basic vehicle info used in the save
	    $vehicle = Vehicles::model()->getBasicInfo($_POST['vehicle_id']);
	    
	    // Adds the vehicle comment
	    $vC = new VehicleComments();
	    $vC->added_by = Yii::app()->user->id;
	    $vC->comment = $_POST['comment'];
	    $vC->date_added = date("Y-m-d H:i:s");
	    $vC->vehicle_id = $_POST['vehicle_id'];
	    $vC->make_model_id = $vehicle['make_model_id'];
	    $vC->save();
	}
	
	/**
	 * Get individual vehicle information
	 * @param int $id The id of the vehicle
	 */
	public function actionGetVehicleCommentInd($id){
	    echo json_encode(VehicleComments::model()->getForVehicleInd($id));
	}
	
	/**
	 * Deletes a comment from the system
	 * @param int $id The id of the comment
	 */
	public function actionDelVehicleCommentInd(){
	    $id = $_POST['comment_id'];
	    $c = VehicleComments::model()->findByPk($id);
	    $c->deleted = 1;
	    $c->save();
	    
	}
	
	/**
	 * Gets the last 5 comments left against individual buses
	 */
	public function actionGetLast5IndComments(){
	    echo json_encode(VehicleComments::model()->getLast5IndBus());
	}
}