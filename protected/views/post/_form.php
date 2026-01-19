<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'post-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

    <p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php echo $form->textArea($model,'content',array('rows'=>10, 'cols'=>60)); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo $form->dropDownList($model,'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model,'category_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'imageFile'); ?>
        
        <?php if(!$model->isNewRecord && $model->image): ?>
            <div style="margin-bottom: 10px;">
                <img src="<?php echo $model->getImageUrl(); ?>" alt="Imagen actual" style="max-width: 300px; max-height: 200px; display: block; margin-bottom: 5px;" />
                <?php echo $form->checkBox($model,'deleteImage'); ?>
                <label for="Post_deleteImage">Eliminar imagen actual</label>
            </div>
        <?php endif; ?>
        
        <?php echo $form->fileField($model,'imageFile'); ?>
        <?php echo $form->error($model,'imageFile'); ?>
        <p class="hint">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB.</p>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
