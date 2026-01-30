<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>

<h1>Login</h1>

<p>Por favor, complete el siguiente formulario con sus credenciales:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <div style="position: relative; display: inline-block;">
            <?php echo $form->passwordField($model,'password', array('id'=>'password-field', 'style'=>'padding-right: 35px;')); ?>
            <button type="button" id="toggle-password" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; font-size: 16px; padding: 0; line-height: 1;" title="Mostrar/Ocultar contraseña">👁️</button>
        </div>
        <?php echo $form->error($model,'password'); ?>
        <p class="hint">
            Usuario: <b>admin</b> / Contraseña: <b>admin123</b><br/>
            Usuario: <b>demo</b> / Contraseña: <b>demo123</b>
        </p>
    </div>

    <script type="text/javascript">
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordField = document.getElementById('password-field');
        var button = this;
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            button.textContent = '🙈';
            button.title = 'Ocultar contraseña';
        } else {
            passwordField.type = 'password';
            button.textContent = '👁️';
            button.title = 'Mostrar contraseña';
        }
    });
    </script>

    <div class="row rememberMe">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
