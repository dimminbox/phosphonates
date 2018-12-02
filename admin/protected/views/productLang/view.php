<?php
$this->breadcrumbs=array(
	'Product Langs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProductLang', 'url'=>array('index')),
	array('label'=>'Create ProductLang', 'url'=>array('create')),
	array('label'=>'Update ProductLang', 'url'=>array('update', 'id'=>$model->id_prod)),
	array('label'=>'Delete ProductLang', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_prod),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductLang', 'url'=>array('admin')),
);
?>

<h1>View ProductLang #<?php echo $model->id_prod; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_prod',
		'id_lang',
		'name',
		'title',
		'meta_descr',
		'meta_keywords',
		'extra_text',
	),
)); ?>
