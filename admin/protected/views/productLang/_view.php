<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_prod')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_prod), array('view', 'id'=>$data->id_prod)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lang')); ?>:</b>
	<?php echo CHtml::encode($data->id_lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_descr')); ?>:</b>
	<?php echo CHtml::encode($data->meta_descr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->meta_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extra_text')); ?>:</b>
	<?php echo CHtml::encode($data->extra_text); ?>
	<br />


</div>