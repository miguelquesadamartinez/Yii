<?php
/* @var $this UserTypeController */
/* @var $model UserType */

$this->breadcrumbs=array(
    'Tipos de Usuario'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Actualizar',
);

$this->menu=array(
    array('label'=>'Listar Tipos de Usuario', 'url'=>array('index')),
    array('label'=>'Crear Tipo de Usuario', 'url'=>array('create')),
    array('label'=>'Ver Tipo de Usuario', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Actualizar Tipo de Usuario: <?php echo CHtml::encode($model->name); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
