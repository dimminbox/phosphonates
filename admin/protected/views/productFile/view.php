<?php
$this->breadcrumbs=array(
	'Product Files'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProductFile', 'url'=>array('index')),
	array('label'=>'Create ProductFile', 'url'=>array('create')),
	array('label'=>'Update ProductFile', 'url'=>array('update', 'id'=>$model->id_file)),
	array('label'=>'Delete ProductFile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_file),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductFile', 'url'=>array('admin')),
);
?>

<h1>View ProductFile #<?php echo $model->id_file; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_file',
		'id_prod',
		'id_lang',
		'title',
		'name',
		'active',
		'sort',
	),
)); ?>
