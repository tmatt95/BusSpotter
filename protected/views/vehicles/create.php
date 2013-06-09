<div class="row">
    <div class="span10"><h1>Add New Vehicle</h1></div>
    <div class="span2 rightMenu"><?php echo CHtml::link('Cancel', array('site/index'), array('class' => 'btn btn-danger rightLink'));?></div>
</div>
<div class="alert alert-info">
    Not sure how to fill in a section? Mouse over the labels for some help or watch this tutorial video - <a href="#">Adding a vehicle to the Bus Spotter</a>
</div>
<h2>General</h2>
<?php echo $this->renderPartial('_form', array('model' => $model));?>
<script type="text/javascript">
    // Contains all operating locations
    var operatingLocations =  ko.observableArray([]);
    
    // Contains all preservation locations
    var preservationLocations =  ko.observableArray([]);
    
    // Class to represent a row in the operating location table
    function operatingLocation(name, opCountry ,opLocation,from,to) {
	var self = this;
	self.operatingName = name;
	self.operatingCountry = opCountry;
	self.operatingLocation = opLocation;
	self.from = from;
	self.to = to;
    }
    
    // Class to represent a row in the preservation location table
    function preservationLocation(name,from,to) {
	var self = this;
	self.presOperatorsName = name;
	self.presFrom = from;
	self.presTo = to;
    }

    // Overall viewmodel for this screen, along with initial state
    function LocationsViewModel() {	
	var self = this;  
	self.saveVehicle = ko.observable(false);
	
	// Delete a location item
	self.deleteLocation  = function(item) {
	    operatingLocations.remove(item);
	    return false;
	}
	
	// Delete a preservation item
	self.deletePres = function(item) {
	    preservationLocations.remove(item);
	    return false;
	};
	
	// If there is a duplicate bus in the system this deals with it
	self.duplicateVehicle = ko.observable(false);
	self.checkUniqueBus= function() {
	    self.duplicateVehicle(true);
	    self.saveVehicle(true);
	} 

	// Editable operating data
	self.operatingLocations = operatingLocations;
	self.newOperatingName =ko.observable(""); 
	self.newOperatingLocation =ko.observable(""); 
	self.newFrom =ko.observable(""); 
	self.newTo =ko.observable(""); 
	self.newOperatingCountry = ko.observable(""); 
	
	// Editable Preservation data
	self.preservationLocations = preservationLocations;
	self.presOperatorsNameNew = ko.observable("");
	self.presFromNew = ko.observable("");
	self.presToNew = ko.observable("");
	
	// Adds a new location to the page
	self.addLocation  = function() {
	    operatingLocations.push(new operatingLocation(self.newOperatingName(),self.newOperatingCountry() ,self.newOperatingLocation(),self.newFrom(),self.newTo()));
	    self.newOperatingName('');
	    self.newOperatingCountry('');
	    self.newOperatingLocation('');
	    self.newFrom('');
	    self.newTo('');
	} 
	
	// Adds a new vehicle to the database
	self.addNewVehicle = function() {
	    // Serialize the form for posting
	    var formData = $('#vehicles-form').serialize();
	    
	    // Post form to server
	    $.ajax({
		type: "POST",
		url: "<?php echo Yii::app()->createUrl('vehicles/AddVehicle')?>",
		data: formData
	    }).done(function( msg ) {
		
		// if errors then do not continue and show error message
		
		// if complete return to menu
		alert(msg );
	    });
	    
	    // Stops the form from sending through post
	    return false;
	} 
	
	// Adds a new preservation location
	self.addPreservation = function() {
	    preservationLocations.push(new preservationLocation(self.presOperatorsNameNew(),self.presFromNew(),self.presToNew()));
	    self.presOperatorsNameNew('');
	    self.presFromNew('');
	    self.presToNew('');
	} 
    }
    
    ko.applyBindings(new LocationsViewModel());
</script>
