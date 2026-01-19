<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Usuarios',
);

$this->menu=array(
    array('label'=>'Crear Usuario', 'url'=>array('create')),
);
?>

<h1>Gestión de Usuarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
