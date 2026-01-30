<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Posts',
);

$this->menu=array(
    array('label'=>'Crear Post', 'url'=>array('create')),
);
?>

<h1>Posts</h1>

<div class="search-form" style="margin-bottom: 20px;">
    <?php echo CHtml::beginForm(array('post/index'), 'get', array('style'=>'display: flex; gap: 10px; align-items: center;')); ?>
        <div style="flex: 1;">
            <?php echo CHtml::textField('palabra', isset($_GET['palabra']) ? $_GET['palabra'] : '', array(
                'placeholder'=>'Buscar por título...',
                'class'=>'form-control',
                'style'=>'width: 100%; padding: 8px;'
            )); ?>
        </div>
        <div>
            <?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-primary', 'style'=>'padding: 8px 20px;')); ?>
        </div>
        <?php if(isset($_GET['palabra']) && !empty($_GET['palabra'])): ?>
            <div>
                <?php echo CHtml::link('Limpiar', array('index'), array('class'=>'btn btn-secondary', 'style'=>'padding: 8px 20px;')); ?>
            </div>
        <?php endif; ?>
    <?php echo CHtml::endForm(); ?>
</div>

<?php if(isset($_GET['palabra']) && !empty($_GET['palabra'])): ?>
    <p style="color: #666; margin-bottom: 15px;">
        Mostrando resultados para: <strong><?php echo CHtml::encode($_GET['palabra']); ?></strong>
    </p>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
