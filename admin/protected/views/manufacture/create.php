<?php
$this->breadcrumbs=array(
	'Manufactures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Manufacture', 'url'=>array('index')),
	array('label'=>'Manage Manufacture', 'url'=>array('admin')),
);
?>

<h1>Create Manufacture</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'man_lang' => $man_lang, 'action' => $action,'language'=>$language)); ?>