<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="view">

    <?php if($data->image): ?>
        <div style="float: left; margin-right: 15px; margin-bottom: 10px;">
            <img src="<?php echo $data->getImageUrl(); ?>" alt="<?php echo CHtml::encode($data->title); ?>" style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #ddd;" />
        </div>
    <?php endif; ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
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

    <div style="clear: both;"></div>

</div>
