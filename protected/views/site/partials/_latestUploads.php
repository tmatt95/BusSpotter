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
<div data-bind="if: spottedLatest().length == 0">
<p class="muted" >No one has spotted anything.</p>
</div>
<div data-bind="if: spottedLatest().length > 0">
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
    </div>
    <div class="tab-pane active" id="lAdded">
	<div class="row">
	    <div class="span10"><h2>Last 5 Added</h2></div>
	</div>
<div data-bind="if: latestAdded().length == 0">
<p class="muted" >No vehicles in system. Add one, you know you want to!</p>
</div>
<div data-bind="if: latestAdded().length > 0">
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
    </div>
    <div class="tab-pane" id="lComments">
	<h2>Last 5 Comments</h2>
<div data-bind="if: commentsIndBus().length == 0">
<p class="muted" >There are no comments. Be the first!</p>
</div>
<div data-bind="if: commentsIndBus().length > 0">
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
</div>