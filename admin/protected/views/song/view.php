<?php
$this->breadcrumbs=array(
	'Song'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Songs', 'url'=>array('index')),
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'Update Song', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Song', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Song', 'url'=>array('admin')),
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
                        'label'=>'Language',
                        'type'=>'html',
                        'value'=>CHtml::image($value['language'],$value['language'],
                                                array('width'=>'30px;')),
                    ),
                    array(
                        'label'=>'Image',
                        'type'=>'image',
                        'value'=>CHtml::image($value['image'],$value['image'],
                                                array('width'=>'30%;')),

                    ),
                'name',
                'description',
	),
));
    } ?>
