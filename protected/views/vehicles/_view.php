<?php
/* @var $this VehiclesController */
/* @var $data Vehicles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('make_model_id')); ?>:</b>
	<?php echo CHtml::encode($data->make_model_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bodywork_id')); ?>:</b>
	<?php echo CHtml::encode($data->bodywork_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('registration')); ?>:</b>
	<?php echo CHtml::encode($data->registration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fleet_number')); ?>:</b>
	<?php echo CHtml::encode($data->fleet_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year_built')); ?>:</b>
	<?php echo CHtml::encode($data->year_built); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_scrapped')); ?>:</b>
	<?php echo CHtml::encode($data->date_scrapped); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_added')); ?>:</b>
	<?php echo CHtml::encode($data->date_added); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added_by')); ?>:</b>
	<?php echo CHtml::encode($data->added_by); ?>
	<br />

	*/ ?>

</div>