<?php
$this->breadcrumbs=array(
	'Product Files',
);

$this->menu=array(
	array('label'=>'Create ProductFile', 'url'=>array('create')),
	array('label'=>'Manage ProductFile', 'url'=>array('admin')),
);
?>

<h1>Product Files</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
