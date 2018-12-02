<?php
$this->breadcrumbs=array(
	'Offers',
);

$this->menu=array(
	array('label'=>'Create Offer', 'url'=>array('create')),
	array('label'=>'Manage Offer', 'url'=>array('admin')),
);
?>

<h1>Offers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
