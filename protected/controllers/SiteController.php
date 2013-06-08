<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions(){
	return array(
	    // captcha action renders the CAPTCHA image displayed on the contact page
	    'captcha' => array(
		'class'     => 'CCaptchaAction',
		'backColor' => 0xFFFFFF,
	    ),
	    // page action renders "static" pages stored under 'protected/views/site/pages'
	    // They can be accessed via: index.php?r=site/page&view=FileName
	    'page'      => array(
		'class' => 'CViewAction',
	    ),
	);
    }

    /**
     * The main page of the application
     */
    public function actionIndex(){
	$this->pageTitle = Yii::app()->name;
	$this->render('index');
    }
    
    public function actionSearch(){
	
	$make = "";
	if($_GET['make'] <> '')
	   $make =  $_GET['make'];
	
	$model = "";
	if($_GET['model'] <> '')
	   $model =  $_GET['model'];
	
	$bodywork = "";
	if($_GET['bodywork'] <> '')
	   $bodywork =  $_GET['bodywork'];
	
	$country = "";
	if($_GET['country'] <> '')
	   $country =  $_GET['country'];
	
	$operator = "";
	if($_GET['operator'] <> '')
	   $operator =  $_GET['operator'];
	
	$location = "";
	if($_GET['location'] <> '')
	   $location =  $_GET['location'];
	
	$this->pageTitle = Yii::app()->name;
	$this->render('search',array('make'=>$make,'model'=>$model, 'bodywork'=>$bodywork,'country'=>$country,'operator'=>$operator,'location'=>$location));
    }
    
    public function actionSearchVehicles(){
	$model=new VSearch('search');
        $model->unsetAttributes(); 
	$model->make = 'Volvo';
	$test = $model->search();
	
	$resArray = array();
	$item = 0;
	
	foreach ($test->data as $a){
	    $resArray[$item]['make'] = $a->make;
	    $resArray[$item]['model'] = $a->model;
	    $resArray[$item]['bodywork'] = $a->bodywork;
	    $resArray[$item]['name'] = $a->name;
	    $item ++;
	}
	print_r($resArray);    
    }

    public function actionAddVehicle(){
	$this->render('addVehicle');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError(){
	if($error = Yii::app()->errorHandler->error){
	    if(Yii::app()->request->isAjaxRequest)
		echo $error['message'];
	    else
		$this->render('error', $error);
	}
    }

    /**
     * Displays the contact page
     */
    public function actionContact(){
	$model = new ContactForm;
	if(isset($_POST['ContactForm'])){
	    $model->attributes = $_POST['ContactForm'];
	    if($model->validate()){
		$name    = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
		$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
		$headers = "From: $name <{$model->email}>\r\n" .
			"Reply-To: {$model->email}\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-type: text/plain; charset=UTF-8";

		mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
		Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
		$this->refresh();
	    }
	}
	$this->render('contact', array('model' => $model));
    }
    
    public function actionCreateUrl($location){
        echo Yii::app()->createUrl($location);
    }

    /**
     * Displays the login page
     */
    public function actionLogin(){	
                $model = new LoginForm;
        $registerForm = new Users;

	// if it is ajax validation request
	if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
            echo CActiveForm::validate($model);
	    Yii::app()->end();
	}
        
        // If registering add record
        if(isset($_POST['Users'])){
            $registerForm = new Users;
	    $registerForm->attributes = $_POST['Users'];
            $registerForm->password = crypt($registerForm->password,$registerForm->password);
	    // validate user input and redirect to the previous page if valid
	    $registerForm->save();
            $registerForm->password = "";
            $registerForm->passAgain = "";
            
            if(count($registerForm->getErrors()) == 0){
                echo 'Added';
                yii::app()->end();
            }
	}

	// collect user input data
	if(isset($_POST['LoginForm'])){
	    $model->attributes = $_POST['LoginForm'];
	    // validate user input and redirect to the previous page if valid
	    if($model->validate() && $model->login())
		$this->redirect(Yii::app()->user->returnUrl);
	}
	$this->render('login', array('model' => $model,'registerForm'=>$registerForm));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout(){
	Yii::app()->user->logout();
	$this->redirect(Yii::app()->homeUrl);
    }
}