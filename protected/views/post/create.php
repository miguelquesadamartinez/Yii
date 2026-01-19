<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
    'Posts'=>array('index'),
    'Crear',
);

$this->menu=array(
    array('label'=>'Listar Posts', 'url'=>array('index')),
);
?>

<h1>Crear Post</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
