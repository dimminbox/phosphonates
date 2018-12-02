<?php
$this->breadcrumbs=array(
	'Preferences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Preference', 'url'=>array('index')),
	array('label'=>'Manage Preference', 'url'=>array('admin')),
);
?>

<h1>Create Preference</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>