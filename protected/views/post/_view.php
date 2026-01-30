<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="view" style="cursor: pointer; transition: background-color 0.2s;" 
     onclick="window.location.href='<?php echo $this->createUrl('view', array('slug'=>$data->slug)); ?>';"
     onmouseover="this.style.backgroundColor='#f5f5f5';" 
     onmouseout="this.style.backgroundColor='white';">

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

    <div style="clear: both;"></div>

</div>
