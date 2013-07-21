<?php
/* @var $this VehiclesController */
/* @var $model Vehicles */
/* @var $form CActiveForm */
?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'vehicles-form',
        'errorMessageCssClass' => 'text-error',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('class' => 'form-horizontal', 'data-bind' => 'submit: addNewVehicle', 'autocomplete' => 'off')
    ));
    ?>
    <div class="row">
        <div class="span5">
            <div>
                <div class="control-group">
                    <?php echo CHtml::label('<span class="bstooltip" data-toggle="tooltip" title="Make of vehicle ( e.g Volvo )">Make *</span>', 'Vehicles_make', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'make', array('placeholder' => 'Make (e.g \'Volvo\')', 'data-required' => 'true')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo CHtml::label('<span class="bstooltip" data-toggle="tooltip" title="Model of vehicle ( e.g Olympian )">Model *</span>', 'Vehicles_model', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'model', array('placeholder' => 'Model (e.g \'Olympian\')', 'data-required' => 'true')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo CHtml::label('<span class="bstooltip" data-toggle="tooltip" title="Vehicles bodywork ( e.g Alexander RL )">Bodywork *</span>', 'Vehicles_bodywork_id', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'bodywork', array('placeholder' => 'Bodywork (e.g \'Alexander RL\')', 'data-required' => 'true')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo CHtml::label('<span class="bstooltip" data-toggle="tooltip" title="Vehicles registration without spaces ( e.g R127EVX )">Registration *</span>', 'Vehicles_registration', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'registration', array('size' => 60, 'maxlength' => 100, 'data-bind' => 'event: { change: checkUniqueBus}', 'placeholder' => 'Registration (e.g \'R127 EVX\')', 'data-required' => 'true')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo CHtml::label('<span class="bstooltip" data-toggle="tooltip" title="Vehicles fleet number ( e.g 16127 )">Fleet Number *</span>', 'Vehicles_fleet_number', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'fleet_number', array('size' => 20, 'maxlength' => 20, 'data-bind' => 'event: { change: checkUniqueBus}', 'placeholder' => 'Fleet Number (e.g \'16127\')', 'data-required' => 'true')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo CHtml::label('<span class="bstooltip" data-toggle="tooltip" title="Year the vehicle was built ( e.g 1997 )">Year Built * </span>', 'Vehicles_date_built', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'date_built', array('size' => 4, 'maxlength' => 4, 'class' => 'yearBox', 'data-required' => 'true', 'data-type' => 'number', 'data-min' => '1900', 'data-max' => date("Y"))); ?>
                    </div>
                </div>
            </div>
            <div class="span4">

            </div>
        </div>
    </div>

    <h2>Operating Locations</h2>
    <div class="row">
        <div class="span3">
            <p>
                <span class="bstooltip colheader" data-toggle="tooltip" 
                      title="The name of the company operated the vehicle">
                    Operators Name
                </span>
            </p>
        </div>
        <div class="span3">
            <p><span class="bstooltip colheader" data-toggle="tooltip" title="The country the vehicle was operated in">Country</span></p>
        </div>
        <div class="span3">
            <p> <span class="bstooltip colheader" data-toggle="tooltip" title="The operating location the vehicle ran in ( e.g In The Cotswolds )">Operating Location</span></p>
        </div>
        <div class="span1">
            <p><span class="bstooltip colheader" data-toggle="tooltip" title="The year the bus started operating in this location">From</span></p>
        </div>
        <div class="span2">
            <p><span class="bstooltip colheader" data-toggle="tooltip" title="The year the bus finished operating in this location. Leave blank if still operating here">To</span></p>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <input type="text" name="OperatorLocation[operating_name][]" data-bind="value: newOperatingName"/>
        </div>
        <div class="span3">
            <?php echo CHtml::dropDownList('OperatorLocation[country][]', '', CHtml::listData(Countries::model()->findAll(array('order' => 'name DESC')), 'id', 'name'), array('prompt' => 'Select...', 'data-bind' => 'value: newOperatingCountry')); ?>
        </div>
        <div class="span3">
            <input type="text" name="OperatorLocation[location_name][]" data-bind="value: newOperatingLocation"/>
        </div>
        <div class="span1">
            <input type="text" name="OperatorLocation[from][]" maxlength="4" size="4" data-type="number" data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" class="yearBox" data-bind="value: newFrom"/>
        </div>
        <div class="span2">
            <input type="text" name="OperatorLocation[to][]" maxlength="4" size="4" data-type="number" data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" class="yearBox" data-bind="value: newTo"/>
            <a href="#" class="btn" data-bind="click: addLocation"><span class="icon-plus"></span> Another</a>
        </div>
    </div>
    <div data-bind="foreach: operatingLocations">
        <div class="row" style="margin-top: 10px;">
            <div class="span3">
                <input type="text" name="OperatorLocation[operating_name][]" data-bind="value: operatingName"/>
            </div>
            <div class="span3">
                <?php echo CHtml::dropDownList('OperatorLocation[country][]', '', CHtml::listData(Countries::model()->findAll(array('order' => 'name DESC')), 'id', 'name'), array('prompt' => 'Select...', 'data-bind' => 'value: operatingCountry')); ?>
            </div>
            <div class="span3">
                <input type="text" name="OperatorLocation[location_name][]" data-bind="value: operatingLocation"/>

            </div>
            <div class="span1">
                <input type="text" name="OperatorLocation[from][]" data-min='1900' data-type="number" data-error-message="Invalid Entry" data-max="<?php echo date("Y"); ?>" maxlength="4" size="4" data-bind="value: from" class="yearBox"/>

            </div>
            <div class="span2">
                <input type="text" name="OperatorLocation[to][]" maxlength="4" data-type="number" data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" size="4" data-bind="value: to" class="yearBox"/>
                <a href="#" class="btn" data-bind="click: $parent.deleteLocation"><span class="icon-minus"></span> Remove</a>
            </div>
        </div>
    </div>
    <h2>Preservation</h2>
    <div class="row">
        <div class="span3">
            <p><span class="bstooltip colheader" data-toggle="tooltip" title="The name of the owner">Owner</span></p>
        </div>
        <div class="span1">
            <p><span class="bstooltip colheader" data-toggle="tooltip" title="The year the vehicle was kept in the location from">From</span></p>
        </div>
        <div class="span2">
            <p><span class="bstooltip colheader" data-toggle="tooltip" title="The year the vehicle was kept in the location to">To</span></p>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <input type="text" name="PreservationLocation[owner_name][]" data-bind="value: presOperatorsNameNew"/>
        </div>
        <div class="span1">
            <input type="text" name="PreservationLocation[from][]" maxlength="4" size="4"  data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" class="yearBox" data-bind="value: presFromNew"/>
        </div>
        <div class="span1">
            <input type="text" name="PreservationLocation[to][]" maxlength="4" size="4"  data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" class="yearBox" data-bind="value: presToNew"/>
        </div>
        <div class="span2">
            <a href="#" class="btn" data-bind="click: addPreservation"><span class="icon-plus"></span> Another</a>
        </div>
    </div>
    <div data-bind="foreach: preservationLocations">
        <div class="row-fluid" style="margin-top: 10px;">
            <div class="span3">
                <input type="text" name="PreservationLocation[owner_name][]" data-bind="value: presOperatorsName"/> 
            </div>
            <div class="span1">
                <input type="text" name="PreservationLocation[from][]" maxlength="4" size="4"  data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" data-bind="value: presFrom" class="yearBox"/>

            </div>
            <div class="span1">
                <input type="text" name="PreservationLocation[to][]" class="yearBox"  data-error-message="Invalid Entry" data-min='1900' data-max="<?php echo date("Y"); ?>" data-bind="value: presTo"/>
            </div>
            <div class="span2">
                <a href="#" class="btn" data-bind="click: $parent.deletePres"><span class="icon-minus"></span> Remove</a>
            </div>
        </div>
    </div>
    <h2>Scrapped</h2>
    <div class="row">
        <div class="control-group">
            <?php echo $form->labelEx($model, 'date_scrapped', array('class' => 'control-label bstooltip', 'data-toggle' => 'tooltip', 'title' => 'The year the vehicle was scrapped. Leave blank if not scrapped')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'date_scrapped', array('size' => 4, 'maxlength' => 4, 'class' => 'yearBox', 'data-min' => '1900', 'data-max' => date("Y"))); ?>
                <?php echo $form->error($model, 'date_scrapped', array('class' => 'help-inline')); ?>
            </div>
        </div>
    </div>
    <h2>Save Information</h2>
    <div class="row">
        <div class="span3">
            <input type="submit" data-returnAfterSav="false" style="float:right;" class="btn btn-primary" value="Add vehicle"/>
        </div>
        <div class="span6">Save and leave</div>
    </div>
    <div class="row">
        <div class="span4" style="text-align:center;">
            or
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <input type="submit" data-returnAfterSav="true" style="float:right;" class="btn btn-primary" value="Add vehicle and return"/>
        </div>
        <div class="span6">Save and populate form to add another of this type</div>
    </div>

    <?php $this->endWidget(); ?>
</div>