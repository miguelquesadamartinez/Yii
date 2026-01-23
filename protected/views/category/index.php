<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
    'Categorías',
);

$this->menu=array(
    array('label'=>'Crear Categoría', 'url'=>array('create')),
);
?>

<h1>Categorías</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'category-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'name',
        array(
            'name'=>'description',
            'value'=>'CHtml::encode(strlen($data->description) > 100 ? substr($data->description, 0, 100)."..." : $data->description)',
            'type'=>'raw',
        ),
        array(
            'name'=>'created_at',
            'value'=>'date("Y-m-d H:i", strtotime($data->created_at))',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
