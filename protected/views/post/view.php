<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
    'Posts'=>array('index'),
    $model->title,
);

$this->menu=array(
    array('label'=>'Listar Posts', 'url'=>array('index')),
    array('label'=>'Crear Post', 'url'=>array('create')),
    array('label'=>'Actualizar Post', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Eliminar Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este post?')),
);
?>

<h1>Ver Post #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'title',
        'content:html',
        array(
            'name'=>'category_id',
            'value'=>$model->category ? $model->category->name : 'Sin categoría',
            'label'=>'Categoría',
        ),
        array(
            'name'=>'author_id',
            'value'=>$model->author->username,
            'label'=>'Autor',
        ),
        'created_at',
        'updated_at',
    ),
)); ?>
