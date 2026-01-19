<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categorías'=>array('index'),
    $model->name,
);

$this->menu=array(
    array('label'=>'Listar Categorías', 'url'=>array('index')),
    array('label'=>'Crear Categoría', 'url'=>array('create')),
    array('label'=>'Actualizar Categoría', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Eliminar Categoría', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar esta categoría?')),
);
?>

<h1>Ver Categoría #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'name',
        'description:html',
        'created_at',
        'updated_at',
    ),
)); ?>

<h2>Posts en esta categoría</h2>
<?php if($model->posts): ?>
    <ul>
    <?php foreach($model->posts as $post): ?>
        <li><?php echo CHtml::link(CHtml::encode($post->title), array('post/view', 'id'=>$post->id)); ?></li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay posts en esta categoría.</p>
<?php endif; ?>
