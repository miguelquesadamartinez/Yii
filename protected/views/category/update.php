<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categorías'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Actualizar',
);

$this->menu=array(
    array('label'=>'Listar Categorías', 'url'=>array('index')),
    array('label'=>'Crear Categoría', 'url'=>array('create')),
    array('label'=>'Ver Categoría', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Actualizar Categoría #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
