<p class="muted"> Filters can be used by themselves or in combination with others. <a>To find out about
searching the system, click here</a></p>
<form action="<?php echo Yii::app()->createUrl('site/search');?>">
    <div class="row-fluid">
	<div class="span12 highlightBox">
	    <div style="padding:10px;">
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="make">
                            <span class="bstooltip" data-original-title="The vehicles make">
                            Make
                            </span>
                        </label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('make', '', CHtml::listData(VehiclesMakeModels::model()->findAll(array('order' => 'make DESC')), 'make', 'make'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchMake'));?>
			</div>
		    </div>	
		</div>
		<div class="span4">
		    <div class="control-group">
			<label for="model">
                            <span class="bstooltip" data-original-title="The vehicles model">
                            Model
                            </span>
                        </label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('model', '', CHtml::listData(VehiclesMakeModels::model()->findAll(array('order' => 'model DESC')), 'model', 'model'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchModel'));?>
			</div>
		    </div>

		</div>
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="bodywork">
                            <span class="bstooltip" data-original-title="The vehicles bodywork">
                            Bodywork
                            </span>
                        </label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('bodywork', '', CHtml::listData(Vehicles::model()->findAll(array('order' => 'bodywork DESC')), 'bodywork', 'bodywork'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchBodywork'));?>
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
    <div class="row-fluid">
	<div class="span12 highlightBox">
	    <div style="padding:10px;">
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="country">
                            <span class="bstooltip" data-original-title="The country the vehicle has been in at some point in its life">
                            Country
                            </span>
                        </label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('country', '', CHtml::listData(Countries::model()->findAll(array('order' => 'name DESC')), 'id', 'name'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchCountry'));?>
			</div>
		    </div>
		</div>
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="operator">
                            <span class="bstooltip" data-original-title="The vehicles operator">
                            Operator
                            </span>
                        </label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('operator', '', CHtml::listData(Operators::model()->findAll(array('order' => 'name DESC')), 'id', 'name'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchOperator'));?>
			</div>
		    </div>
		</div>
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="location">
                            <span class="bstooltip" data-original-title="The location the vehicle has been in at some point in its life">
                            Location
                            </span>                 
                        </label>
			<div class="controls">
			    <input type="text" id="location" name="location" placeholder="Location" data-bind="value: searchLocation">
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
    <div class="row">
	<div class="span12 highlightBox">
	    <div style="padding:10px;">
		<input type="submit" id="searchSub" value="Search" class="btn rightLink btn-primary searchBoxButton" style="margin-bottom:10px;"/>
	    </div>
	</div>
    </div>
</form>