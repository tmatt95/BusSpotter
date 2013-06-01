<?php Yii::app()->clientScript->registerCoreScript('jquery')?>
<div class="row">
    <div class="span10"><h1>Vehicle Info</h1></div>
    <div class="span2 rightMenu">
	<?php echo CHtml::link('<span class="icon-pencil"></span> Edit Information', array('vehicles/create'), array('class' => 'btn rightLink'));?>
    </div>
</div>
<div class="form">
    <?php
    $form   = $this->beginWidget('CActiveForm', array(
	'id'		   => 'vehicles-form',
	'enableAjaxValidation' => true,
	'htmlOptions'	  => array('class' => 'form-horizontal')
	    ));
    ?>
    <div class="row">
	<div class="span5">
	    <div class="control-group">
		<div class="control-label">Make</div>
		<div class="controls">
		    <div class="formText" data-bind="text:vehicleMake"></div>
		</div>
	    </div>
	    <div class="control-group">
		<div class="control-label">Model</div>
		<div class="controls">
		    <div class="formText" data-bind="text:vehicleModel"></div>
		</div>
	    </div>
	    <div class="control-group">
		<div class="control-label">Bodywork</div>
		<div class="controls">
		    <div class="formText" data-bind="text:vehicleBodywork"></div>
		</div>
	    </div>
	    <div class="control-group">
		<div class="control-label">Registration</div>
		<div class="controls">
		    <div class="formText" data-bind="text:vehicleRegistration"></div>
		</div>
	    </div>
	    <div class="control-group">
		<div class="control-label">Fleet Number</div>
		<div class="controls">
		    <div class="formText" data-bind="text:vehicleFleetNumber"></div>
		</div>
	    </div>
	    <div class="control-group">
		<div class="control-label">Year Built</div>
		<div class="controls">
		    <div class="formText" data-bind="text:vehicleDateBuilt"></div>
		</div>
	    </div>
	</div>
    </div>

    <h2>Operating Locations</h2>
    <div class="muted" data-bind="if: operatingLocations().length == 0">
	No operating locations recorded against this vehicle
    </div>
    <div data-bind="if: operatingLocations().length > 0">
	<div class="row">
	    <div class="span3">
		<span class="bstooltip colheader" data-toggle="tooltip" 
		      title="The name of the company operated the vehicle">
		    Operators Name
		</span>
	    </div>
	    <div class="span3">
		<span class="bstooltip colheader" data-toggle="tooltip" title="The country the vehicle was operated in">Country</span>
	    </div>
	    <div class="span3">
		<span class="bstooltip colheader" data-toggle="tooltip" title="The operating location the vehicle ran in ( e.g In The Cotswolds )">Operating Location</span>
	    </div>
	    <div class="span1">
		<span class="bstooltip colheader" data-toggle="tooltip" title="The year the bus started operating in this location">From</span>
	    </div>
	    <div class="span2">
		<span class="bstooltip colheader" data-toggle="tooltip" title="The year the bus finished operating in this location. Leave blank if still operating here">To</span>
	    </div>
	</div>
    </div>
    <div data-bind="foreach: operatingLocations">
	<div class="row">
	    <div class="span3">
		<span data-bind="text: operatingName"></span>
	    </div>
	    <div class="span3">
		<span data-bind="text: country_name"></span>
	    </div>
	    <div class="span3">
		<span data-bind="text: operatingLocation"></span>
	    </div>
	    <div class="span1">
		<span data-bind="text: date_from" class="yearBox"></span>
	    </div>
	    <div class="span2">
		<span data-bind="text: date_to"></span>
	    </div>
	</div>
    </div>
    <div data-bind="if: preservationLocations().length > 0">
	<h2>Preservation</h2>
	<div class="row">
	    <div class="span3 colheader">
		Owners Name
	    </div>
	    <div class="span1 colheader">
		From
	    </div>
	    <div class="span2 colheader">
		To
	    </div>
	</div>
	<div data-bind="foreach: preservationLocations">
	    <div class="row">
		<div class="span3">
		    <span data-bind="text: owners_name"></span> 
		</div>
		<div class="span1">
		    <span data-bind="text: date_from"></span>
		</div>
		<div class="span2">
		    <span data-bind="text: date_to"></span>
		</div>
	    </div>
	</div>
    </div>
    <h2>Scrapped</h2>
    <div class="row">
	<div data-bind="if: vehicleDateScrapped() == null">
	    <div class="span4 muted">Still on the road!</div>
	</div>
	<div data-bind="if: vehicleDateScrapped() != null">
	    <div class="control-group">
		<div class="control-label">Date Scrapped</div>
		<div class="controls">		    
		    <div class="formText" data-bind="text:vehicleDateScrapped"></div>
		</div>
	    </div>
	</div>
    </div>
    <?php $this->endWidget();?>
</div>

<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#home">Comments</a></li>
    <li><a href="#spottings">Spottings</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="home">	
	<div class="row">
	    <div class="span10">
		<textarea id="newComment" placeholder="Add Comment" rows="2" data-bind="value: commentText" style="width:100%"></textarea>
	    </div>
	    <div class="span2">
		<input type="button" class="btn btn-block btn-primary" type="button" style="margin-top:34px" data-bind="click: addComment, enable: self.commentText().length > 0" value="Add Comment" />
	    </div>
	</div>
	<hr/>
	<div class="muted" data-bind="if: comments().length == 0">
	    There are no comments against this vehicle
	</div>
	<div class="muted" data-bind="if: comments().length > 0">
	    <div class="row">
		<div class="span2 colheader">Date</div>
		<div class="span2 colheader">User</div>
		<div class="span8 colheader">Comment</div>
	    </div>
	</div>
	<div data-bind="foreach: comments">
	    <div class="row">
		<div class="span2" data-bind="text: date_added"></div>
		<div class="span1" data-bind="text: username">User</div>
		<div class="span8">
		    <pre><span data-bind="text: comment"></span> </pre>
		</div>
		<a href="#" class="span1" data-bind="click: deleteComment">
		    X
		</a>
	    </div>
	</div>
    </div>
    <div class="tab-pane" id="spottings">
	<div class="muted" data-bind="if: spottings().length == 0">
	    No one has seen this vehicle yet
	</div>
    </div>
</div>

<script type="text/javascript">
    function ViewModel() {
	
	// Makes the  tabs work
	$('#myTab a').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
	})
	
	// Needed to get the enabled to change on keyup instead of when the
	// text area is left
	$('#newComment').keyup(function (e) {
	    self.commentText($(this).val());
	})
	
	// Vehicle details
	self.vehicleMake = ko.observable("");
	self.vehicleModel = ko.observable("");
	self.vehicleBodywork = ko.observable("");
	self.vehicleRegistration = ko.observable("");
	self.vehicleFleetNumber = ko.observable("");
	self.vehicleDateBuilt = ko.observable("");
	self.vehicleDateScrapped = ko.observable("");
	
	// Comment area
	self.comments = ko.observableArray([]);
	self.commentText = ko.observable("");
	self.addComment = function() {  
	    $.ajax({
		type: "POST",
		dataType: 'json',
		url: "<?php echo Yii::app()->createUrl('VehicleComments/AddVehicleCommentInd')?>",
		data:{vehicle_id:'<?php echo $id;?>',comment:self.commentText()}
	    }).done(function(data) {
		commentText('');
		self.updateVehicleComments();
	    });
	}	
	self.deleteComment = function (item){
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: "<?php echo Yii::app()->createUrl('VehicleComments/DelVehicleCommentInd')?>",
		data:{comment_id:item.comment_id}
	    }).done(function() {
		self.updateVehicleComments();
	    });
	}
	
	// operating information
	self.operatingLocations = ko.observableArray([]);
	
	// Preservation information
	self.preservationLocations = ko.observableArray([]);	
	self.spottings = ko.observableArray([]);
	
	self.updateVehicleComments = function(){	
	    $.ajax({
		type: "GET",
		dataType: 'json',
		url: "<?php echo Yii::app()->createUrl('VehicleComments/GetVehicleCommentInd')?>",
		data:{id:'<?php echo $id;?>'}
	    }).done(function( data ) {
		self.comments(data);
	    });
	
	}
	
	$.ajax({
	    type: "GET",
	    dataType: 'json',
	    url: "<?php echo Yii::app()->createUrl('vehicles/GetVehicleInfo')?>",
	    data:{id:'<?php echo $id;?>'}
	}).done(function( data ) {
	    self.vehicleMake(data.vehicle.make);
	    self.vehicleModel(data.vehicle.model);
	    self.vehicleBodywork(data.vehicle.bodywork);
	    self.vehicleRegistration(data.vehicle.registration);
	    self.vehicleFleetNumber(data.vehicle.fleet_number);
	    self.vehicleDateBuilt(data.vehicle.date_built);
	    self.vehicleDateScrapped(data.vehicle.date_scrapped);    
	    self.operatingLocations(data.operating_locations);
	    self.preservationLocations(data.preserved_locations);
	});
	
	self.updateVehicleComments();
    }
    
    ko.applyBindings(new ViewModel());
    
    jQuery(document).ready(function($) {
	$('.bstooltip').tooltip();
    });
</script>
