<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
    'Posts'=>array('index'),
    $model->title=>array('view','id'=>$model->id),
    'Actualizar',
);

$this->menu=array(
    array('label'=>'Listar Posts', 'url'=>array('index')),
    array('label'=>'Crear Post', 'url'=>array('create')),
    array('label'=>'Ver Post', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Actualizar Post #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
