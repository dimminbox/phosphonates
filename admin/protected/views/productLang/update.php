<?php
$this->breadcrumbs=array(
	'Product Langs'=>array('index'),
	$model->name=>array('view','id'=>$model->id_prod),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductLang', 'url'=>array('index')),
	array('label'=>'Create ProductLang', 'url'=>array('create')),
	array('label'=>'View ProductLang', 'url'=>array('view', 'id'=>$model->id_prod)),
	array('label'=>'Manage ProductLang', 'url'=>array('admin')),
);
?>

<h1>Update ProductLang <?php echo $model->id_prod; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>