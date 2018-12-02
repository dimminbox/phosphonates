<?php
$this->breadcrumbs=array(
	'Set Attributes'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SetAttribute', 'url'=>array('index')),
	array('label'=>'Create SetAttribute', 'url'=>array('create')),
	array('label'=>'Update SetAttribute', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SetAttribute', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SetAttribute', 'url'=>array('admin')),
);
?>

<h1>View SetAttribute #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'date_added',
	),
)); ?>
