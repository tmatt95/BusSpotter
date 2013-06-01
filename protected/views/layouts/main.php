<?php /* @var $this Controller */?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/scripts/bootstrap/css/bootstrap.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/scripts/bootstrap/css/bootstrap-responsive.min.css" />
	<title><?php echo CHtml::encode($this->pageTitle);?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/main.css" />
    </head>
    <body>
	<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl;?>/scripts/bootstrap/js/bootstrap.min.js'></script>
	<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl;?>/scripts/knockout-2.2.1.js'></script>
	<div class="container" id="page">
	    <div id="mainmenu" class="navbar" style="margin-top:20px;">
		<div class="navbar-inner">
		    <a class="brand" href="#"><?php echo CHtml::encode(Yii::app()->name);?></a>
		<?php
		$this->widget('zii.widgets.CMenu', array(
		    'items' => array(
			array('label' => 'Home', 'url'   => array('/site/index')),
			array('label' => 'About', 'url'   => array('/site/page', 'view' => 'about')),
			array('label' => 'Contact', 'url'   => array('/site/contact')),
			array('label' => 'Login', 'url'   => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url'   => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
		    ),
		    'htmlOptions' => array('class'=>'nav')
		));
		?>
		</div>
	    </div><!-- mainmenu -->
	    <?php if(isset($this->breadcrumbs)):?>
		<?php
		$this->widget('zii.widgets.CBreadcrumbs', array(
		    'links' => $this->breadcrumbs,
		));
		?><!-- breadcrumbs -->
	    <?php endif?>
	    <?php echo $content;?>
	    <div class="clear"></div>
	</div><!-- page -->
    </body>
</html>
