<?php /* @var $this Controller */ ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap/css/bootstrap.min.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap/css/bootstrap-responsive.min.css" />
            <title><?php echo CHtml::encode($this->pageTitle); ?></title>
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    </head>
    <body>
        <script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/bootstrap/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/scripts/knockout-2.2.1.js'></script>
        <div class="container" id="page">
            <div class="row-fluid">
                <div class="span8">
                    <div style="width: 728px; height: 90px; border: 1px solid; top: 10px; position: relative; background: none repeat scroll 0% 0% silver;"></div>
                </div>
                <?php if (Yii::app()->user->isGuest) { ?>
                    <div class="span4" style="background:#F2F2F2;border: 1px solid white;border-radius: 0px 0px 5px 5px;border-top:0px;">
                        <div style="padding:10px;">
                            <span class="icon-user"></span> <?php echo CHtml::link('Login / Register', array('site/login')); ?>
                        </div>
                    </div>
                <?php } else { ?>
                <div class="span4" style="background:#F2F2F2;border: 1px solid white;border-radius: 0px 0px 5px 5px;border-top:0px;">
                        <div style="padding:10px;">
                            <div style="float:left;">
                                <img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim(Users::model()->findByPk(Yii::app()->user->id)->email))); ?>?s=40&d=mm" />
                            </div> 
                            <div style="position: relative; left: 7px;">
                            <?php echo Users::model()->findByPk(Yii::app()->user->id)->email ?> 
                            <br/>
                               <?php echo CHtml::link('Edit Profile'); ?>  | 
                                <?php echo CHtml::link('Logout', array('/site/logout')); ?> 
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="mainmenu" class="navbar" style="margin-top:20px;">
                <div class="navbar-inner">
                    <a class="brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Home', 'url' => array('/site/index')),
                            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => 'Contact', 'url' => array('/site/contact')),
                            array('label' => 'Stats', 'url' => array('/site/page', 'view' => 'stats'))
                        ),
                        'htmlOptions' => array('class' => 'nav')
                    ));
                    ?>
                </div>
            </div>
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?>
            <?php endif ?>
            <?php echo $content; ?>
            <div class="bottomBar">
                <hr  style="margin-bottom: 4px;"/>
                <div class="row-fluid">
                    <div class="span4">
                        <span class="muted">Created by <a href="http://uk.linkedin.com/pub/matthew-turner/51/a07/a02/" target="_blank">Matt Turner (2013)</a></span>
                    </div>
                    <div class="span5 offset3">
                        <div style="float:right;">
                            Open source / w3c logos here
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.bstooltip').tooltip();
            });
        </script>
    </body>
</html>
