<?php
$this->breadcrumbs=array(
	'Manufactures'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Manufacture', 'url'=>array('index')),
	array('label'=>'Create Manufacture', 'url'=>array('create')),
	array('label'=>'Update Manufacture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Manufacture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Manufacture', 'url'=>array('admin')),
);
?>

<h1>View Manufacture #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'date_added',
		'date_modified',
		'active',
	),
)); ?>
