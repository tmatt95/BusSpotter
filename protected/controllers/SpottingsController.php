<?php

class SpottingsController extends Controller
{
    /**
     * Adds a spotting to the system
     */
    public function actionAddSpotting(){
	date_default_timezone_set("Europe/London");

	$sDate    = DateTime::createFromFormat('d/m/Y', $_POST['spotted_datev']);
	$spotting = new Spottings();
	$spotting->comment = $_POST['spotted_commentv'];
	$spotting->location = $_POST['spotted_locationv'];
	$spotting->added_by = Yii::app()->user->id;
	$spotting->date_added = date("Y-m-d H:i:s");
	$spotting->date_spotted = $sDate->format('Y-m-d');
	$spotting->country_id = $_POST['spotted_countryv'];
	$spotting->vehicle_id = $_POST['vehicle_id'];
	$spotting->save();
    }

    /**
     * Finds all the spottings associated with a vehicle
     * @param int $vehicle_id The vehicle id
     */
    public function actionGetVehicleSpottings($vehicle_id){
	echo json_encode(Spottings::model()->getVehicleSpottings($vehicle_id));
    }

    /**
     * Returns the last 5 spottings stored in the system 
     */
    public function actionGetLast5Spottings(){
	echo json_encode(Spottings::model()->getlast5Spottings());
    }
}