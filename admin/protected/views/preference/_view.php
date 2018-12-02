<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pref')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_pref), array('view', 'id'=>$data->id_pref)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />


</div>