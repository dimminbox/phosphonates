<?php
$this->breadcrumbs=array(
	'Product Langs',
);

$this->menu=array(
	array('label'=>'Create ProductLang', 'url'=>array('create')),
	array('label'=>'Manage ProductLang', 'url'=>array('admin')),
);
?>

<h1>Product Langs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
