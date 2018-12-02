<?php
$this->breadcrumbs=array(
	'Set Attributes',
);

$this->menu=array(
	array('label'=>'Create SetAttribute', 'url'=>array('create')),
	array('label'=>'Manage SetAttribute', 'url'=>array('admin')),
);
?>

<h1>Set Attributes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
