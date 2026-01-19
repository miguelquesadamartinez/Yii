<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Usuarios'=>array('index'),
    'Crear',
);

$this->menu=array(
    array('label'=>'Listar Usuarios', 'url'=>array('index')),
);
?>

<h1>Crear Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
