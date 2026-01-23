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

<?php
Yii::app()->clientScript->registerScript('search', "
var focusedElement = null;
var cursorPosition = 0;
function attachGridFilters() {
    $('#user-grid .filters input[type=text]').off('keyup.filter focus.filter').on('focus.filter', function(){
        focusedElement = this;
    }).on('keyup.filter', function(){
        var grid = $('#user-grid');
        focusedElement = this;
        cursorPosition = this.selectionStart;
        if(grid.data('keyupTimeout')) {
            clearTimeout(grid.data('keyupTimeout'));
        }
        grid.data('keyupTimeout', setTimeout(function(){
            grid.yiiGridView('update', {
                data: $('#user-grid .filters :input').serialize()
            });
        }, 300));
    });
    $('#user-grid .filters select').off('change.filter').on('change.filter', function(){
        $('#user-grid').yiiGridView('update', {
            data: $('#user-grid .filters :input').serialize()
        });
    });
    if(focusedElement) {
        var elem = $('#user-grid .filters input[name=\"' + $(focusedElement).attr('name') + '\"]');
        if(elem.length) {
            elem.focus();
            if(elem[0].setSelectionRange && cursorPosition) {
                elem[0].setSelectionRange(cursorPosition, cursorPosition);
            }
        }
    }
}
attachGridFilters();
", CClientScript::POS_READY);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'enableSorting'=>true,
    'afterAjaxUpdate'=>'function(id, data){ attachGridFilters(); }',
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
