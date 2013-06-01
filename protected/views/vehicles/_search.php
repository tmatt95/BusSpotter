<?php
/* @var $this VehiclesController */
/* @var $model Vehicles */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'make_model_id'); ?>
		<?php echo $form->textField($model,'make_model_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bodywork_id'); ?>
		<?php echo $form->textField($model,'bodywork_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'registration'); ?>
		<?php echo $form->textField($model,'registration',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fleet_number'); ?>
		<?php echo $form->textField($model,'fleet_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year_built'); ?>
		<?php echo $form->textField($model,'year_built'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_scrapped'); ?>
		<?php echo $form->textField($model,'date_scrapped',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_added'); ?>
		<?php echo $form->textField($model,'date_added'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'added_by'); ?>
		<?php echo $form->textField($model,'added_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->