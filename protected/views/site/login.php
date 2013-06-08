<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle = Yii::app()->name . ' - Login';
?>
<div class="row">
    <div class="span6">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'register-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <legend>Register</legend>
        <div data-bind="if:registerSuccessful() == 'False'">
            <?php $this->endWidget(); ?>
            <p>Register form</p>
            <p>Add captcha here!</p>
        </div>
        <div data-bind="if:registerSuccessful() == 'True'">
            <div class="alert alert-success">
                <h2>Welcome Aboard!</h2>
                <p>Please check your e-mail for a link to activate your account</p>
            </div>
        </div>
    </div>
    <div class="span6">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'errorMessageCssClass' => 'text-error',
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')
        ));
        ?>
        <legend>Login</legend>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'username', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'username'); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model, 'password'); ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe', array('style' => 'display: inline;position: relative; top: 3px;')); ?>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script type="text/javascript">
    function ViewModel() {
        // Register
        self.registerSuccessful = ko.observable('False');
    }
    ko.applyBindings(new ViewModel());
</script>