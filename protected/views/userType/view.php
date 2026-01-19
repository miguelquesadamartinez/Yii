<?php
/* @var $this UserTypeController */
/* @var $model UserType */

$this->breadcrumbs=array(
    'Tipos de Usuario'=>array('index'),
    $model->name,
);

$this->menu=array(
    array('label'=>'Listar Tipos de Usuario', 'url'=>array('index')),
    array('label'=>'Crear Tipo de Usuario', 'url'=>array('create')),
    array('label'=>'Actualizar Tipo de Usuario', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Eliminar Tipo de Usuario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este tipo de usuario?')),
);
?>

<h1>Ver Tipo de Usuario: <?php echo CHtml::encode($model->name); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'name',
        array(
            'name'=>'description',
            'value'=>$model->description ? $model->description : '-',
        ),
        array(
            'name'=>'created_at',
            'value'=>date('d/m/Y H:i:s', strtotime($model->created_at)),
        ),
        array(
            'name'=>'updated_at',
            'value'=>date('d/m/Y H:i:s', strtotime($model->updated_at)),
        ),
    ),
)); ?>

<h2>Usuarios con este tipo (<?php echo count($model->users); ?>)</h2>

<?php if(count($model->users) > 0): ?>
    <ul>
    <?php foreach($model->users as $user): ?>
        <li>
            <?php echo CHtml::link(CHtml::encode($user->username), array('user/view', 'id'=>$user->id)); ?>
            - <?php echo CHtml::encode($user->email); ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay usuarios asignados a este tipo.</p>
<?php endif; ?>
