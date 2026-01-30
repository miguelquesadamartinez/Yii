<?php
/* @var $this PostController */
/* @var $data Post */
?>

<?php if($data->author_id == Yii::app()->user->id): ?>
    <div class="view" style="transition: background-color 0.2s; padding: 15px; margin-bottom: 15px; border: 1px solid #eee; border-radius: 4px;"
         onmouseover="this.style.backgroundColor='#f5f5f5';" 
         onmouseout="this.style.backgroundColor='white';">
<?php else: ?>
    <div class="view" style="transition: background-color 0.2s; padding: 15px; margin-bottom: 15px; border: 1px solid #eee; border-radius: 4px; cursor: pointer;"
         onclick="window.location.href='<?php echo $this->createUrl('view', array('slug'=>$data->slug)); ?>';"
         onmouseover="this.style.backgroundColor='#f5f5f5';" 
         onmouseout="this.style.backgroundColor='white';">
<?php endif; ?>

    <?php if($data->image): ?>
        <div style="float: left; margin-right: 15px; margin-bottom: 10px;">
            <img src="<?php echo $data->getImageUrl(); ?>" alt="<?php echo CHtml::encode($data->title); ?>" style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #ddd;" />
        </div>
    <?php endif; ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::encode($data->id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
    <?php echo CHtml::encode(substr($data->content, 0, 200)); ?>...
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
    <?php echo CHtml::encode($data->category ? $data->category->name : 'Sin categoría'); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
    <?php echo CHtml::encode($data->author->username); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
    <?php echo CHtml::encode($data->created_at); ?>
    <br />

    <?php if($data->author_id == Yii::app()->user->id): ?>
        <div style="margin-top: 10px;">
            <?php echo CHtml::link('Ver', array('view', 'slug'=>$data->slug), array('class'=>'btn btn-info btn-sm')); ?>
            <?php echo CHtml::link('Editar', array('update', 'id'=>$data->id), array('class'=>'btn btn-warning btn-sm')); ?>
            <?php echo CHtml::link('Eliminar', array('delete', 'id'=>$data->id), array(
                'class'=>'btn btn-danger btn-sm',
                'submit'=>array('delete', 'id'=>$data->id),
                'confirm'=>'¿Estás seguro de que quieres eliminar este post?'
            )); ?>
        </div>
    <?php else: ?>
        <div style="margin-top: 10px;">
            <span style="color: #999; font-size: 12px;">Post de <?php echo CHtml::encode($data->author->username); ?> - Click para ver</span>
        </div>
    <?php endif; ?>

    <div style="clear: both;"></div>

</div>
