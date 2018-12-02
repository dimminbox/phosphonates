<?php
$this->breadcrumbs=array(
	'Film'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Films', 'url'=>array('index')),
	array('label'=>'Create Film', 'url'=>array('create')),
	array('label'=>'Update Film', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Film', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Film', 'url'=>array('admin')),
);
?>

<h1>View Film #<?php echo $model->id; ?></h1>
<?php
    foreach ($model->full_data as $key=>$value)
            {
                $this->widget('zii.widgets.CDetailView', array(
        	'data'=>$value,
                'attributes'=>array(
                    'id',
                    array(
                        'label'=>'Image',
                        'type'=>'image',
                        'value'=>$value['image'],
                        'cssClass'=>'small_image',

                    ),
                'name',
                'description',
	),
));
    } ?>
