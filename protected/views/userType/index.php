<?php
/* @var $this UserTypeController */
/* @var $model UserType */

$this->breadcrumbs=array(
    'Tipos de Usuario'=>array('index'),
    'Listado',
);

$this->menu=array(
    array('label'=>'Crear Tipo de Usuario', 'url'=>array('create')),
);
?>

<h1>Tipos de Usuario</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-type-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'name',
        array(
            'name'=>'description',
            'value'=>'$data->description ? Yii::app()->format->text($data->description) : "-"',
            'type'=>'html',
        ),
        array(
            'name'=>'created_at',
            'value'=>'date("d/m/Y H:i", strtotime($data->created_at))',
            'filter'=>false,
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view} {update} {delete}',
        ),
    ),
)); ?>
