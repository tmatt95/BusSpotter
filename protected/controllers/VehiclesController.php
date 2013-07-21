<?php

/**
 * Contains all vehicle related interations with the system  
 */
class VehiclesController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'GetLatestAdded', 'GetVehicleInfo'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'addVehicle'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Find information on a specific vehicle
     * @param integer $id the ID of the model to be displayed
     */
    public function actionGetVehicleInfo($id) {
        $vehicle = Vehicles::model()->getBasicInfo($id);
        $operatingLocations = OperatingLocations::model()->getOperatingLocationsForVehicle($id);
        $preservationLocations = PreservationLocation::model()->getPreservationLocsForVehicle($id);
        $array = array(
            'vehicle' => $vehicle,
            'operating_locations' => $operatingLocations,
            'preserved_locations' => $preservationLocations
        );
        $this->jsonReturn($array);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionGetLatestAdded() {
        $data = Vehicles::model()->getLast5Added();
        $this->jsonReturn($data);
    }

    /**
     * Add a vehicle to the system 
     */
    public function actionAddVehicle() {
        // Do all validation first
        
        // Check to see if vehicle in system
        $vCheckArray = array(
            'condition' => 'fleet_number = :fleetNumber AND registration = :registration',
            'params' => array(
                ':fleetNumber' => $_POST['Vehicles']['fleet_number'],
                ':registration' => $_POST['Vehicles']['registration']
            )
        );

        // If none found then we can add the vehicle to the system
        if (count(Vehicles::model()->findAll($vCheckArray)) == 0) {

            // Check and see if make and model present. If not add it
            // get its id. 
            $mCheckArray = array(
                'condition' => 'UPPER(make) = :make AND UPPER(model) = :model',
                'params' => array(
                    ':make' => strtoupper(trim($_POST['Vehicles']['make'])),
                    ':model' => strtoupper(trim($_POST['Vehicles']['model']))
                )
            );
            $makeModel = VehiclesMakeModels::model()->find($mCheckArray);
            $makeModelId = 0;
            if (count($makeModel) == 0) {
                $newMake = new VehiclesMakeModels;
                $newMake->make = trim($_POST['Vehicles']['make']);
                $newMake->model = trim($_POST['Vehicles']['model']);
                $newMake->save();
                $makeModelId = $newMake->id;
            } else {
                $makeModelId = $makeModel->id;
            }

            // Save vehicle information - get id
            $vehicle = new Vehicles;
            $vehicle->make_model_id = $makeModelId;
            $vehicle->bodywork = trim($_POST['Vehicles']['bodywork']);
            $vehicle->registration = trim($_POST['Vehicles']['registration']);
            $vehicle->fleet_number = trim($_POST['Vehicles']['fleet_number']);
            $vehicle->date_built = trim($_POST['Vehicles']['date_built']);
            $vehicle->date_scrapped = trim($_POST['Vehicles']['date_scrapped']);
            $vehicle->date_added = date("Y-m-d H:i:s");
            $vehicle->added_by = Yii::app()->user->id;
            $vehicle->save();
            $vehicleId = $vehicle->id;

            // Location information
            $noOfOperators = count($_POST['OperatorLocation']['operating_name']);
            $opNo = 0;
            while ($opNo < $noOfOperators) {
                $operatorsName = trim($_POST['OperatorLocation']['operating_name'][$opNo]);
                $country = trim($_POST['OperatorLocation']['country'][$opNo]);
                $location_name = trim($_POST['OperatorLocation']['location_name'][$opNo]);
                $from = trim($_POST['OperatorLocation']['from'][$opNo]);
                $to = trim($_POST['OperatorLocation']['to'][$opNo]);

                $lengthOfOpItems = strlen($operatorsName) + strlen($country) + strlen($location_name) + strlen($from) + strlen($to);
                if ($lengthOfOpItems > 0) {
                    // check to see if operator in system get id
                    $oCheckArray = array(
                        'condition' => 'name = :name',
                        'params' => array(
                            ':name' => $operatorsName,
                        )
                    );
                    $operator = Operators::model()->find($oCheckArray);
                    $operatorId = 0;
                    if (count($operator) == 0) {
                        $nOperator = new Operators;
                        $nOperator->name = $operatorsName;
                        $nOperator->date_added = date("Y-m-d H:i:s");
                        $nOperator->added_by = Yii::app()->user->id;
                        $nOperator->save();
                        $operatorId = $nOperator->id;
                    } else {
                        $operatorId = $operator->id;
                    }

                    // Check to see if locations in system
                    $lCheckArray = array(
                        'condition' => 'name = :name AND country_id = :countryId',
                        'params' => array(
                            ':name' => $operatorsName,
                            ':countryId' => $country
                        )
                    );
                    $location = Locations::model()->find($lCheckArray);
                    $locationId = 0;
                    if (count($location) == 0) {
                        $nlocation = new Locations;
                        $nlocation->country_id = $country;
                        $nlocation->name = $location_name;
                        $nlocation->save();
                        $locationId = $nlocation->id;
                    } else {
                        $locationId = $location->id;
                    }

                    // Add operating location
                    $nOperatingLocation = new OperatingLocations;
                    $nOperatingLocation->date_from = $from;
                    $nOperatingLocation->date_to = $to;
                    $nOperatingLocation->operator_id = $operatorId;
                    $nOperatingLocation->preservation = 0;
                    $nOperatingLocation->vehicle_id = $vehicleId;
                    $nOperatingLocation->date_added = date("Y-m-d H:i:s");
                    $nOperatingLocation->added_by = Yii::app()->user->id;
                    $nOperatingLocation->location_id = $locationId;
                    $nOperatingLocation->save();
                }
                $opNo++;
            }

            // Preservation information
            $opNo = 0;
            $noOfPreservations = count($_POST['PreservationLocation']['owner_name']);
            $presNo = 0;
            while ($presNo < $noOfPreservations) {
                $ownersName = "";
                $from = "";
                $to = "";

                if (isset($_POST['PreservationLocation']['owner_name'][$presNo]))
                    $ownersName = trim($_POST['PreservationLocation']['owner_name'][$presNo]);

                if (isset($_POST['PreservationLocation']['from'][$presNo]))
                    $from = trim($_POST['PreservationLocation']['from'][$presNo]);

                if (isset($_POST['PreservationLocation']['to'][$presNo]))
                    $to = trim($_POST['PreservationLocation']['to'][$presNo]);

                $presLoc = new PreservationLocation;
                $presLoc->vehicle_id = $vehicleId;
                $presLoc->owners_name = $ownersName;
                $presLoc->date_from = $from;
                $presLoc->date_to = $to;
                $presLoc->date_added = date("Y-m-d H:i:s");
                $presLoc->save();

                $presNo++;
            }
        }
        else {
            echo 'vehicle already in system';
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array('id' => $id));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        // Used to check form before saving
        $model = new Vehicles;
        $this->performAjaxValidation($model);

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Vehicles'])) {
            $model->attributes = $_POST['Vehicles'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Vehicles('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Vehicles']))
            $model->attributes = $_GET['Vehicles'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Vehicles the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Vehicles::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Vehicles $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'vehicles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
