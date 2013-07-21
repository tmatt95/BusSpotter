<div class="row">
    <div class="span10"><h1>Update Vehicle Info</h1></div>
    <div class="span2 rightMenu"><?php echo CHtml::link('Cancel', array('site/index'), array('class' => 'btn btn-danger rightLink'));?></div>
</div>
<div class="alert alert-info">
    Not sure how to fill in a section? Mouse over the labels for some help or watch this tutorial video - <a href="#">Updating a vehicle on Bus Spotter</a>
</div>
<h2>General</h2>
<?php echo $this->renderPartial('partials/_form', array('model' => $model));?>