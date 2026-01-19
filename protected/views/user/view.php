<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Usuarios'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'Listar Usuarios', 'url'=>array('index')),
    array('label'=>'Crear Usuario', 'url'=>array('create')),
    array('label'=>'Actualizar Usuario', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Eliminar Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este usuario?')),
);
?>

<h1>Ver Usuario #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'username',
        'email',
        'first_name',
        'last_name',
        array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
        array(
            'name'=>'user_type_id',
            'value'=>$model->userType ? $model->userType->name : '-',
        ),
        'created_at',
        'updated_at',
    ),
)); ?>
