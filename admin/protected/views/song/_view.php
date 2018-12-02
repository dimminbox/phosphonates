<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>	<br />
	<?php echo CHtml::link(CHtml::image($this->image_path.$data->image,$data->image,array('width'=>'150px;')),array('view', 'id'=>$data->id)); ?>
	<br />


</div>