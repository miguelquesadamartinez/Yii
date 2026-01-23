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

<?php
Yii::app()->clientScript->registerScript('search', "
var focusedElement = null;
var cursorPosition = 0;
function attachGridFilters() {
    $('#user-type-grid .filters input[type=text]').off('keyup.filter focus.filter').on('focus.filter', function(){
        focusedElement = this;
    }).on('keyup.filter', function(){
        var grid = $('#user-type-grid');
        focusedElement = this;
        cursorPosition = this.selectionStart;
        if(grid.data('keyupTimeout')) {
            clearTimeout(grid.data('keyupTimeout'));
        }
        grid.data('keyupTimeout', setTimeout(function(){
            grid.yiiGridView('update', {
                data: $('#user-type-grid .filters :input').serialize()
            });
        }, 300));
    });
    $('#user-type-grid .filters select').off('change.filter').on('change.filter', function(){
        focusedElement = null;
        $('#user-type-grid').yiiGridView('update', {
            data: $('#user-type-grid .filters :input').serialize()
        });
        return false;
    });
    if(focusedElement) {
        var elem = $('#user-type-grid .filters input[name=\"' + $(focusedElement).attr('name') + '\"]');
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
    'id'=>'user-type-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'enableSorting'=>true,
    'afterAjaxUpdate'=>'function(id, data){ attachGridFilters(); }',
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
