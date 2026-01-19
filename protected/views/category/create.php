<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categorías'=>array('index'),
    'Crear',
);

$this->menu=array(
    array('label'=>'Listar Categorías', 'url'=>array('index')),
);
?>

<h1>Crear Categoría</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
