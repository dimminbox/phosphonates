<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_posted')); ?>:</b>
	<?php echo CHtml::encode($data->date_posted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_payment')); ?>:</b>
	<?php echo CHtml::encode($data->date_payment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_delivery')); ?>:</b>
	<?php echo CHtml::encode($data->id_delivery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summ')); ?>:</b>
	<?php echo CHtml::encode($data->summ); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_type')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_type); ?>
	<br />

	*/ ?>

</div>