<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle = Yii::app()->name . ' - Login';
?>
<div class="row">
    <div class="span6">
        <legend>Register</legend>
    <div class="alert alert-info">
        <b> Did you know?</b> <br/> Registering is free and allows you to contribute your knowledge to the web site.
    </div>
        <p>Move register to bottom and check scaling of page</p>
        <div data-bind="if:registerSuccessful() == 'False'">
            <?php
            $rform = $this->beginWidget('CActiveForm', array(
                'id' => 'register-form',
                'enableClientValidation' => true,
                'errorMessageCssClass' => 'text-error',
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => 'form-horizontal')
            ));
            ?>
            <fieldset>
                <div class="control-group">
                    <?php echo $rform->labelEx($registerForm, 'username', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $rform->textField($registerForm, 'username'); ?>
                        <?php echo $rform->error($registerForm, 'username'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $rform->labelEx($registerForm, 'email', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $rform->textField($registerForm, 'email'); ?>
                        <?php echo $rform->error($registerForm, 'email'); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="control-group">
                    <?php echo $rform->labelEx($registerForm, 'password', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $rform->passwordField($registerForm, 'password'); ?>
                        <?php echo $rform->error($registerForm, 'password'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <?php echo $rform->labelEx($registerForm, 'passAgain', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $rform->passwordField($registerForm, 'passAgain'); ?>
                        <?php echo $rform->error($registerForm, 'passAgain'); ?>
                    </div>
                </div>
                <?php if (CCaptcha::checkRequirements()): ?>
                    <div class="control-group">
                        <?php echo $rform->labelEx($registerForm, 'verifyCode', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php $rform->widget('CCaptcha'); ?> <br/>
                            <?php echo $rform->textField($registerForm, 'verifyCode'); ?>
                            <div class="muted">Please enter the letters as they are shown in the image above.
                                <br/>Letters are not case-sensitive.</div>
                            <?php echo $rform->error($registerForm, 'verifyCode'); ?>
                        </div>
                        
                    </div>
                <?php endif; ?>
            </fieldset>
            <div class="control-group">
                <div class="controls">
                    <?php echo CHtml::submitButton('Register', array('class' => 'btn btn-primary', 'data-bind' => 'click:registerUser')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
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
        // =====================================================================
        // REGISTER
        // =====================================================================

        // Register status
        self.registerSuccessful = ko.observable('False');

        // Register a new user to the system
        self.registerUser = function() {
            $.ajax({
                type: "POST",
                url: $('#register-form').prop('action'),
                data: $('#register-form').serialize()
            }).done(function(msg) {
                if (msg !== 'Added') {
                    $('#register-form').html($('#register-form', msg).html());
                } else {
                    self.registerSuccessful('True');
                }
            });
            return false;
        };
    }
    ko.applyBindings(new ViewModel());
</script>