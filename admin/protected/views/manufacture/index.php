<?php
$this->breadcrumbs=array(
	'Manufactures',
);

$this->menu=array(
	array('label'=>'Create Manufacture', 'url'=>array('create')),
	array('label'=>'Manage Manufacture', 'url'=>array('admin')),
);
?>

<h1>Manufactures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
