<?php
$this->breadcrumbs=array(
	'Offers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Offer', 'url'=>array('index')),
	array('label'=>'Create Offer', 'url'=>array('create')),
	array('label'=>'Update Offer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Offer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Offer', 'url'=>array('admin')),
);
?>

<h1>View Offer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'active',
		'date_begin',
		'date_end',
		'date_added',
		'date_modified',
	),
)); ?>
