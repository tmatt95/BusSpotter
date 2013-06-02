<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<div id="mediaOTheMonth">
    <div class="row">
	<div class="span10">
	    <h2>Media of the Month</h2>
	    <p>Every month we will hold a competition and place the winning Youtube video in the space below!</p>
	</div>
	<div class="span2 rightMenu"><a href="#" class="rightLink" data-bind="click:openDisclaimer">Disclaimer</a></div>
    </div>
    <div class="row">
	<div class="span12" style="background: none repeat scroll 0% 0% rgb(0, 0, 0); margin-bottom: 20px;">
	    <div style="width:560px;margin:0 auto;'">
		<iframe width="560" height="315" src="http://www.youtube.com/embed/Q0k0VK74Hq8" style="border:0px;" allowfullscreen></iframe>
	    </div>
	</div>
    </div>
</div>
<div class="row">
    <div class="span12">
	<h2>Search</h2>
    </div>
</div>
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
			    <input type="text" name="location" id="location" placeholder="Location" data-bind="value: searchLocation">
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
<div style="float: right; margin-top: 5px;margin-bottom:2px;">
    <?php if(Yii::app()->user->isGuest == false){?>
	<?php echo CHtml::link('<span class="icon-plus"></span> Vehicle', array('vehicles/create'), array('class' => 'btn rightLink'));?>
    <?php }?>
</div>
<ul class="nav nav-tabs" id="latestTabs">
    <li id="last5Uploaded" class="active">
	<a href="#lAdded">Last 5 Uploaded</a>
    </li>
    <li id="last5Spotted">
	<a href="#lSpotted">Last 5 Spotted</a>
    </li>
    <li>
	<a href="#lComments">Last 5 Comments</a>
    </li>
</ul>
<div class="tab-content">
    <div  class="tab-pane" id="lSpotted">
	<div class="row">
	    <div class="span10"><h2>Last 5 Spotted</h2></div>
	</div>
	<p>The most recent vehicles to have been spotted</p>
	<table class="table table-bordered table-hover">
	    <thead>
		<tr>
		    <th>Vehicle</th>
		    <th>Date Spotted</th>
		    <th>Country</th>
		    <th>Location</th>
		    <th>Comment</th>
		    <th>Date Added</th>
		    <th>Added By</th>
		</tr>
	    </thead>
	    <tbody data-bind="foreach: spottedLatest">
		<tr>
		    <td><a href="#" data-bind="click: viewVehicle">
			    <div><span data-bind="text:vehicle_registration"></span> (<span data-bind="text:vehicle_fleet_number"></span>)</div>
			    <div><span data-bind="text:vehicle_make"></span> <span data-bind="text:vehicle_model"></span></div>
			</a></td>
		    <td data-bind="text:date_spotted"></td>
		    <td data-bind="text:country_name">Country</td>
		    <td data-bind="text:location">Location</td>
		    <td data-bind="text:comment"></td>
		    <td data-bind="text:date_added"></td>
		    <td data-bind="text:user_name"></td>
		</tr>
	    </tbody>
	</table>
    </div>
    <div class="tab-pane active" id="lAdded">
	<div class="row">
	    <div class="span10"><h2>Last 5 Added</h2></div>
	</div>
	<p>The most recent vehicles to have been added</p>
	<table class="table table-bordered table-hover">
	    <thead>
		<tr>
		    <th>Make / Model</th>
		    <th>Bodywork</th>
		    <th>Registration</th>
		    <th>Date Added</th>
		    <th>Added By</th>
		</tr>
	    </thead>
	    <tbody data-bind="foreach: latestAdded">
		<tr>
		    <td><a href="#" data-bind="text:make_model,click:viewVehicle"></a></td>
		    <td data-bind="text:bodywork"></td>
		    <td data-bind="text:vehicle_registration"></td>
		    <td data-bind="text:date_added"></td>
		    <td data-bind="text:username"></td>
		</tr>
	    </tbody>
	</table>
    </div>
    <div class="tab-pane" id="lComments">
	<h2>Last 5 Comments</h2>
	<table class="table table-bordered table-hover">
	    <thead>
		<tr>
		    <th>Vehicle</th>
		    <th>Comment</th>
		    <th>Date Added</th>
		    <th>Added By</th>
		</tr>
	    </thead>
	    <tbody data-bind="foreach: commentsIndBus">
		<tr>
		    <td><a href="#" data-bind="click: viewVehicle">
			    <div><span data-bind="text:vehicle_registration"></span> (<span data-bind="text:vehicle_fleet_number"></span>)</div>
			    <div><span data-bind="text:vehicle_make"></span> <span data-bind="text:vehicle_model"></span></div>
			</a></td>
		    <td data-bind="text:comment"></td>
		    <td data-bind="text:date_added"></td>
		    <td data-bind="text:user_name"></td>
		</tr>
	    </tbody>
	</table>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	<h3 id="myModalLabel" data-bind="text:modalHeader" ></h3>
    </div>
    <div class="modal-body" data-bind="html:modalBody"></div>
    <div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
<script type="text/javascript">
    function ViewModel() {
    	
	// The search section on the page
	self.searchMake =ko.observable("");
	self.searchModel =ko.observable("");
	self.searchBodywork =ko.observable("");
	self.searchCountry =ko.observable("");
	self.searchOperator =ko.observable("");
	self.searchLocation =ko.observable("");
	
	// Popup Window
	self.modalBody = ko.observable("");
	self.modalHeader = ko.observable("");
    	
	// General
	self.viewVehicle = function(item) {
	    window.location = '<?php echo Yii::app()->createUrl('vehicles/view');?>/id/' + item.vehicle_id;
	} 
    	
	// Latest Added
	self.latestAdded = ko.observableArray();
	self.getLast5Uploaded = function() {
	    // Loads the latest added
	    $.ajax({
		type: "POST",
		dataType: 'json',
		url: "<?php echo Yii::app()->createUrl('vehicles/GetLatestAdded')?>"
	    }).done(function( msg ) {
		self.latestAdded(msg);
	    });
	}
	
	// Latest Comments
	self.commentsIndBus = ko.observableArray();
	self.getLast5CommentsInd = function() {
	    $.ajax({
		type: "POST",
		dataType: 'json',
		url: "<?php echo Yii::app()->createUrl('VehicleComments/GetLast5IndComments')?>"
	    }).done(function( msg ) {
		self.commentsIndBus(msg);
	    });
	}
	
	// Latest Spotted
	self.spottedLatest = ko.observableArray();
	self.getLast5Spottings = function() {
	    $.ajax({
		type: "POST",
		dataType: 'json',
		url: "<?php echo Yii::app()->createUrl('Spottings/GetLast5Spottings')?>"
	    }).done(function( msg ) {
		self.spottedLatest(msg);
	    });
	}
	self.getLast5Spottings();	
	
	// Open the disclaimer popup window
	openDisclaimer =  function() {
	    $('#myModal').modal();
	    self.modalHeader('Disclaimer');
	    self.modalBody('<p>Every care is taken to ensure that we only use videos we have permission to share.</p> <p>If you own a video shown in the top box and would like it removed, please contact us through the e-mail form.</p>');
	    return false;
	} 
    }
    
    $(document).ready(function() {
    
	self.getLast5Uploaded();
	self.getLast5CommentsInd();
    
	$('#latestTabs a').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
	})
    });
    
    ko.applyBindings(new ViewModel());
</script>