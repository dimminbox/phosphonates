<?php
$this->breadcrumbs=array(
	'Song'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Song',
);

$this->menu=array(
	array('label'=>'List Songs', 'url'=>array('index')),
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'View Song', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Songs', 'url'=>array('admin')),
);
?>

<h1>Update Song <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'relate'=>$relate)); ?>