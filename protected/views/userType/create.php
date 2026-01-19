<?php
/* @var $this UserTypeController */
/* @var $model UserType */

$this->breadcrumbs=array(
    'Tipos de Usuario'=>array('index'),
    'Crear',
);

$this->menu=array(
    array('label'=>'Listar Tipos de Usuario', 'url'=>array('index')),
);
?>

<h1>Crear Tipo de Usuario</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
