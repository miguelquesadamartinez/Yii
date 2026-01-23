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

<?php
Yii::app()->clientScript->registerScript('search', "
var focusedElement = null;
var cursorPosition = 0;
function attachGridFilters() {
    $('#category-grid .filters input[type=text]').off('keyup.filter focus.filter').on('focus.filter', function(){
        focusedElement = this;
    }).on('keyup.filter', function(){
        var grid = $('#category-grid');
        focusedElement = this;
        cursorPosition = this.selectionStart;
        if(grid.data('keyupTimeout')) {
            clearTimeout(grid.data('keyupTimeout'));
        }
        grid.data('keyupTimeout', setTimeout(function(){
            grid.yiiGridView('update', {
                data: $('#category-grid .filters :input').serialize()
            });
        }, 300));
    });
    $('#category-grid .filters select').off('change.filter').on('change.filter', function(){
        $('#category-grid').yiiGridView('update', {
            data: $('#category-grid .filters :input').serialize()
        });
    });
    if(focusedElement) {
        var elem = $('#category-grid .filters input[name=\"' + $(focusedElement).attr('name') + '\"]');
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
    'id'=>'category-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'enableSorting'=>true,
    'afterAjaxUpdate'=>'function(id, data){ attachGridFilters(); }',
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
