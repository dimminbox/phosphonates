<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_group')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_group), array('view', 'id'=>$data->id_group)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lang')); ?>:</b>
	<?php echo CHtml::encode($data->id_lang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_prefix')); ?>:</b>
	<?php echo CHtml::encode($data->id_prefix); ?>
	<br />


</div>