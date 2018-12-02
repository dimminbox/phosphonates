<?php
$this->breadcrumbs=array(
	'Manufactures'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Manufacture', 'url'=>array('index')),
	array('label'=>'Create Manufacture', 'url'=>array('create')),
	array('label'=>'View Manufacture', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Manufacture', 'url'=>array('admin')),
);
?>

<h1>Update Manufacture <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'man_lang' => $man_lang, 'action' => $action,'language'=>$language)); ?>