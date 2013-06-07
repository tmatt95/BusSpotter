<?php
/* @var $this SiteController */
/* @var $error array */
$this->pageTitle=Yii::app()->name . ' - Error';
?>
<div class="alert alert-error" style="width: 550px; margin: 0px auto;">
<h2>Error <?php echo $code; ?></h2>
<?php echo CHtml::encode($message); ?>
<hr />
<p>The problem has been logged and will be investigated ASAP. If you would like
to be contacted about the problem. Please fill in the <a href="#">contact form</a>... we wont bite!</p>
</div>