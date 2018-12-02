<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('country-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Countries</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'country-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'image',
                'visited',
                array(            
                    'name'=>'products[0]->title)',
                    'value'=>'isset ($data->products[0]->title) ? count($data->products) : ""',
                    'header'=>'Ozon products',
                    'sortable'=>true,
                ),
                array(            // display 'author.username' using an expression
                    'name'=>'cat_desc->name',
                    'value'=>'$data->cat_desc->name',
                    'header'=>'Name',
                    'sortable'=>true,
                    'filter'=> CHTml::textField('name'),
                ),
                array(            // display 'author.username' using an expression
                    'name'=>'cat_desc->title',
                    'value'=>'$data->cat_desc->title',
                    'header'=>'Title',
                    'filter'=> CHTml::textField('title'),
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>