<?php
$this->breadcrumbs=array(
	'Product Langs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductLang', 'url'=>array('index')),
	array('label'=>'Manage ProductLang', 'url'=>array('admin')),
);
?>

<h1>Create ProductLang</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>