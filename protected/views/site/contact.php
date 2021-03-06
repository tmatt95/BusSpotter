<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
$this->pageTitle = Yii::app()->name . ' - Contact Us';
?>
<h1>Contact Us</h1>
<img src="<?php echo Yii::app()->baseUrl; ?>/images/Dash.jpg" />
<?php if (Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else: ?>
    <div class="form form-horizontal" style="margin-top:23px;">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => true,
            'errorMessageCssClass' => 'text-error',
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'name'); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'email'); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'subject', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
                <?php echo $form->error($model, 'subject'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'body', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
                <?php echo $form->error($model, 'body'); ?>
            </div>
        </div>
        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'verifyCode', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php $this->widget('CCaptcha'); ?> <br/>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                    <div class="muted">Please enter the letters as they are shown in the image above.
                        <br/>Letters are not case-sensitive.</div>
                <?php echo $form->error($model, 'verifyCode'); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="control-group">
            <div class="controls">
                <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
<?php endif; ?>