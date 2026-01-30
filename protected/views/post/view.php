<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
    'Posts'=>array('index'),
    $model->title,
);

$this->menu=array(
    array('label'=>'Listar Posts', 'url'=>array('index')),
    array('label'=>'Crear Post', 'url'=>array('create')),
    array('label'=>'Actualizar Post', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Eliminar Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Está seguro de eliminar este post?')),
);
?>

<h1>Ver Post #<?php echo $model->id; ?></h1>

<?php if($model->image): ?>
    <div style="margin-bottom: 20px;">
        <img src="<?php echo $model->getImageUrl(); ?>" 
             alt="<?php echo CHtml::encode($model->title); ?>" 
             style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; cursor: pointer;" 
             onclick="openImageModal('<?php echo $model->getImageUrl(); ?>')" 
             title="Click para ver en tamaño completo" />
    </div>
<?php endif; ?>

<!-- Modal para la imagen -->
<div id="imageModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.8);" onclick="closeImageModal()">
    <div style="position: relative; margin: auto; max-width: 800px; padding: 20px; top: 50%; transform: translateY(-50%);">
        <span style="position: absolute; top: 10px; right: 25px; color: #fff; font-size: 35px; font-weight: bold; cursor: pointer;" onclick="closeImageModal()">&times;</span>
        <img id="modalImage" src="" style="width: 800px; height: auto; display: block; margin: auto;" />
    </div>
</div>

<script type="text/javascript">
function openImageModal(imageUrl) {
    document.getElementById('imageModal').style.display = 'block';
    document.getElementById('modalImage').src = imageUrl;
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Cerrar el modal con la tecla Escape
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
    }
});
</script>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'title',
        'slug',
        'content:html',
        array(
            'name'=>'image',
            'value'=>$model->image ? 'Imagen cargada' : 'Sin imagen',
            'label'=>'Imagen',
        ),
        array(
            'name'=>'category_id',
            'value'=>$model->category ? $model->category->name : 'Sin categoría',
            'label'=>'Categoría',
        ),
        array(
            'name'=>'author_id',
            'value'=>$model->author->username,
            'label'=>'Autor',
        ),
        'created_at',
        'updated_at',
    ),
)); ?>
