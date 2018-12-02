<?php
$this->breadcrumbs=array(
	'FIlm'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Film',
);

$this->menu=array(
	array('label'=>'List Films', 'url'=>array('index')),
	array('label'=>'Create Film', 'url'=>array('create')),
	array('label'=>'View Film', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Films', 'url'=>array('admin')),
);
?>

<h1>Update Film <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'relate'=>$relate,'filmstyle'=>$filmstyle)); ?>