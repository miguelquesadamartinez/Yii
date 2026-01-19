<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Usuarios'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Actualizar',
);

$this->menu=array(
    array('label'=>'Listar Usuarios', 'url'=>array('index')),
    array('label'=>'Crear Usuario', 'url'=>array('create')),
    array('label'=>'Ver Usuario', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Actualizar Usuario #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
