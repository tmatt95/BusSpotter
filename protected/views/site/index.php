<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php echo $this->renderPartial('partials/_mediaOfTheMonth'); ?>
<div id="sectSearch">
    <div class="row">
        <div class="span12">
            <h2>Search</h2>
        </div>
    </div>
    <?php echo $this->renderPartial('partials/_search'); ?>
</div>
<?php echo $this->renderPartial('partials/_latestUploads'); ?>
<script type="text/javascript">
    function ViewModel() {
        // The search section on the page
        self.searchMake = ko.observable("");
        self.searchModel = ko.observable("");
        self.searchBodywork = ko.observable("");
        self.searchCountry = ko.observable("");
        self.searchOperator = ko.observable("");
        self.searchLocation = ko.observable("");

        // Popup Window
        self.modalBody = ko.observable("");
        self.modalHeader = ko.observable("");

        // General
        self.viewVehicle = function(item) {
            window.location = '<?php echo Yii::app()->createUrl('vehicles/view'); ?>/id/' + item.vehicle_id;
        };

        // Latest Added
        self.latestAdded = ko.observableArray();
        self.getLast5Uploaded = function() {
            // Loads the latest added
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo Yii::app()->createUrl('vehicles/GetLatestAdded') ?>'
            }).done(function(msg) {
                self.latestAdded(msg);
            });
        };

        // Latest Comments
        self.commentsIndBus = ko.observableArray();
        self.getLast5CommentsInd = function() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo Yii::app()->createUrl('VehicleComments/GetLast5IndComments') ?>'
            }).done(function(msg) {
                self.commentsIndBus(msg);
            });
        };

        // Latest Spotted
        self.spottedLatest = ko.observableArray();
        self.getLast5Spottings = function() {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo Yii::app()->createUrl('Spottings/GetLast5Spottings') ?>'
            }).done(function(msg) {
                self.spottedLatest(msg);
            });
        };
        self.getLast5Spottings();
    }

    $(document).ready(function() {
        self.getLast5Uploaded();
        self.getLast5CommentsInd();
    });
    ko.applyBindings(new ViewModel());
</script>