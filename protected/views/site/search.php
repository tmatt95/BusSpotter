<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<h1>Search</h1>
<?php echo $this->renderPartial('partials/_search');?>
<ul class="nav nav-tabs" id="searchRes">
    <li class="active"><a href="#vehicles">Vehicles <span class="badge" data-bind="text:resVehicles.length"></span></a> </li>
    <li><a href="#spottings">Spottings <span class="badge" data-bind="text:resSpottings.length"></span></a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="vehicles">
	<h2>Vehicles</h2>
	<div data-bind="if:resVehicles.length == 0">
	    <span class="muted">No vehicle results found</span>
	</div>
    </div>
    <div class="tab-pane" id="spottings">
	<h2>Spottings</h2>
	<div data-bind="if:resSpottings.length == 0">
	    <span class="muted">No spottings found</span>
	</div>
    </div>
</div>
<script type="text/javascript">
    function ViewModel() {
	// The search section on the page
	self.searchMake =ko.observable("<?php echo $make;?>");
	self.searchModel =ko.observable("<?php echo $model;?>");
	self.searchBodywork =ko.observable("<?php echo $bodywork;?>");
	self.searchCountry =ko.observable("<?php echo $country;?>");
	self.searchOperator =ko.observable("<?php echo $operator;?>");
	self.searchLocation =ko.observable("<?php echo $location;?>");
	self.modalBody = ko.observable("");
	self.modalHeader = ko.observable("");	
	self.latestAdded = ko.observableArray();
	self.commentsIndBus = ko.observableArray();
	
	self.resVehicles = ko.observableArray([]);
	self.resSpottings = ko.observableArray([]);
    }
    
    $(document).ready(function() {
	$('#searchRes a').click(function (e) {
	    e.preventDefault();
	    $(this).tab('show');
	})
    });
    
    ko.applyBindings(new ViewModel());
</script>