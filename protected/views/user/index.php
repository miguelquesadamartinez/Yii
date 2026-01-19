<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Usuarios',
);

$this->menu=array(
    array('label'=>'Crear Usuario', 'url'=>array('create')),
);
?>

<h1>Gestión de Usuarios</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'username',
        'email',
        array(
            'name'=>'first_name',
            'value'=>'$data->getFullName()',
        ),
        array(
            'name'=>'user_type_id',
            'value'=>'$data->userType ? $data->userType->name : "-"',
            'filter'=>CHtml::listData(UserType::model()->findAll(), 'id', 'name'),
        ),
        array(
            'name'=>'status',
            'value'=>'$data->getStatusText()',
            'filter'=>array('1'=>'Activo', '0'=>'Inactivo'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
