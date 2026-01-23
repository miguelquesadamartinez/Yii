<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'password', array('required'=>$model->isNewRecord)); ?>
        <div style="position: relative; display: inline-block; width: 100%;">
            <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'value'=>'','id'=>'password-field','style'=>'width: calc(100% - 100px);')); ?>
            <button type="button" onclick="togglePassword('password-field', this)" style="position: absolute; right: 0; top: 0; padding: 5px 10px;">Mostrar</button>
        </div>
        <?php echo $form->error($model,'password'); ?>
        <?php if(!$model->isNewRecord): ?>
            <p class="hint">Dejar en blanco para mantener la contraseña actual</p>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'password_repeat', array('required'=>$model->isNewRecord)); ?>
        <div style="position: relative; display: inline-block; width: 100%;">
            <?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>128,'value'=>'','id'=>'password-repeat-field','style'=>'width: calc(100% - 100px);')); ?>
            <button type="button" onclick="togglePassword('password-repeat-field', this)" style="position: absolute; right: 0; top: 0; padding: 5px 10px;">Mostrar</button>
        </div>
        <?php echo $form->error($model,'password_repeat'); ?>
    </div>

<script>
function togglePassword(fieldId, button) {
    var field = document.getElementById(fieldId);
    if (field.type === 'password') {
        field.type = 'text';
        button.textContent = 'Ocultar';
    } else {
        field.type = 'password';
        button.textContent = 'Mostrar';
    }
}
</script>

    <div class="row">
        <?php echo $form->labelEx($model,'first_name'); ?>
        <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'first_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'last_name'); ?>
        <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'last_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array('1'=>'Activo','0'=>'Inactivo')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'user_type_id'); ?>
        <?php echo $form->dropDownList($model,'user_type_id', UserType::getList(), array('prompt'=>'Seleccione un tipo...')); ?>
        <?php echo $form->error($model,'user_type_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
