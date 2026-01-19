<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Categorías',
);

$this->menu=array(
    array('label'=>'Crear Categoría', 'url'=>array('create')),
);
?>

<h1>Categorías</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
