<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<h1>Search</h1>
<form action="<?php echo Yii::app()->createUrl('site/search');?>">
    <div class="row">
	<div class="span12 highlightBox">
	    <div style="padding:10px;">
		<div class="span3">
		    <div class="control-group">
			<label class="control-label" for="make">Make</label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('make', '', CHtml::listData(VehiclesMakeModels::model()->findAll(array('order' => 'make DESC')), 'make', 'make'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchMake'));?>
			</div>
		    </div>	
		</div>
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="model">Model</label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('model', '', CHtml::listData(VehiclesMakeModels::model()->findAll(array('order' => 'model DESC')), 'model', 'model'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchModel'));?>
			</div>
		    </div>

		</div>
		<div class="span3">
		    <div class="control-group">
			<label class="control-label" for="bodywork">Bodywork</label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('bodywork', '', CHtml::listData(Vehicles::model()->findAll(array('order' => 'bodywork DESC')), 'bodywork', 'bodywork'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchBodywork'));?>
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
    <div class="row">
	<div class="span12 highlightBox">
	    <div style="padding:10px;">
		<div class="span3">
		    <div class="control-group">
			<label class="control-label" for="country">Country</label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('country', '', CHtml::listData(Countries::model()->findAll(array('order' => 'name DESC')), 'name', 'name'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchCountry'));?>
			</div>
		    </div>
		</div>
		<div class="span4">
		    <div class="control-group">
			<label class="control-label" for="operator">Operator</label>
			<div class="controls">
			    <?php echo CHtml::dropDownList('operator', '', CHtml::listData(Operators::model()->findAll(array('order' => 'name DESC')), 'name', 'name'), array('prompt'    => 'Select...', 'data-bind' => 'value: searchOperator'));?>
			</div>
		    </div>
		</div>
		<div class="span3">
		    <div class="control-group">
			<label class="control-label" for="location">Operating Location</label>
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
		<input type="submit" value="Search" class="btn rightLink btn-primary" style="margin-bottom:10px;"/>
	    </div>
	</div>
    </div>
</form>

<ul class="nav nav-tabs" id="searchRes">
<li class="active"><a href="#vehicles">Vehicles <span class="badge">0</span></a> </li>
<li><a href="#profile">Profile <span class="badge">0</span></a></li>
<li><a href="#messages">Messages <span class="badge">0</span></a></li>
<li><a href="#settings">Settings <span class="badge">0</span></a></li>
</ul>
 
<div class="tab-content">
<div class="tab-pane active" id="vehicles">...</div>
<div class="tab-pane" id="profile">...</div>
<div class="tab-pane" id="messages">...</div>
<div class="tab-pane" id="settings">...</div>
</div>
<script type="text/javascript">
    function ViewModel() {
    	
	// The search section on the page
	self.searchMake =ko.observable("<?php echo $make; ?>");
	self.searchModel =ko.observable("<?php echo $model; ?>");
	self.searchBodywork =ko.observable("<?php echo $bodywork; ?>");
	self.searchCountry =ko.observable("<?php echo $country; ?>");
	self.searchOperator =ko.observable("<?php echo $operator; ?>");
	self.searchLocation =ko.observable("<?php echo $location; ?>");
	self.modalBody = ko.observable("");
	self.modalHeader = ko.observable("");	
	self.latestAdded = ko.observableArray();
	self.commentsIndBus = ko.observableArray();
    }
    
    $(document).ready(function() {
	$('#searchRes a').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
	})
    });
    
    ko.applyBindings(new ViewModel());
</script>