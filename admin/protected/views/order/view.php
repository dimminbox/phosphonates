<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Order', 'url'=>array('index')),
	array('label'=>'Create Order', 'url'=>array('create')),
	array('label'=>'Update Order', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Order', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order', 'url'=>array('admin')),
);
?>

<h2>Заказ №<?php echo $model->id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
                array('name'=>'User',
                     'value'=>Yii::app()->getModule('user')->user($model->id_user)->profile->firstname.' '.
                     Yii::app()->getModule('user')->user($model->id_user)->profile->lastname),
		'date_created',
		'date_posted',
		'date_payment',
                array('name'=>'notification','value'=>($model->notification==0) ? 'Нет' : 'Да'),
                
		'summ',
                array(
                    'label'=>'Доставка',
                    'type'=>'raw',
                    'value'=>($model->delivery_type==0)? "Почта России" : "Major",
                ),
	)
));
?>
<h2>Продукты</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$products,
	'columns'=>array(
                'id_product',
                'name_product',
		'qty',
                'price',
                array('name'=>'Сумма','value'=>'$data->qty*$data->price')
	),
)); ?>
<?
if ($model->delivery_type==0){
    echo '<h2>Доставка (Почта России)</h2>';
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model->russianpost->attributes,
            'attributes'=>array(
                    array('name'=>'Номер','value'=>$model->russianpost->attributes['id']),
                    array('name'=>'Страна','value'=>$model->russianpost->attributes['country']),
                    array('name'=>'Вес','value'=>$model->russianpost->attributes['weight']),
                    array('name'=>'Заявленная стоимость','value'=>$model->russianpost->attributes['price']),
                    array('name'=>'Стоимость','value'=>$model->russianpost->attributes['cost']),
                    array('name'=>'Метод','value'=>$model->russianpost->attributes['method']),
                    array('name'=>'Город','value'=>$model->russianpost->attributes['city']),
                    array('name'=>'Индекс','value'=>$model->russianpost->attributes['index']),
                    array('name'=>'Адрес','value'=>$model->russianpost->attributes['address']),
            )
    ));
}
else {
echo '<h2>Доставка (Major)</h2>';
        $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model->major->attributes,
            'attributes'=>array(
                    array('name'=>'Номер','value'=>$model->major->attributes['id']),
                    array('name'=>'Страна','value'=>$model->major->attributes['id_country']),
                    array('name'=>'Город','value'=>City::model()->findByPk($model->major->attributes['id_city'])->name),
                    array('name'=>'Вес','value'=>$model->major->attributes['weight']),
                    array('name'=>'Стоимость','value'=>$model->major->attributes['cost']),
                    array('name'=>'Заявленная стоимость','value'=>$model->major->attributes['price']),
                    array('name'=>'Налог','value'=>$model->major->attributes['insurance']),
                    array('name'=>'Время доставки','value'=>$model->major->attributes['delivery_time']),
            )
    ));
}
/*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->major,
	'attributes'=>array(
		'id',
		'id_user',
		'date_created',
		'date_posted',
		'date_payment',
		'id_delivery',
		'summ',
                array(
                    'label'=>'Доставка',
                    'type'=>'raw',
                    'value'=>($model->delivery_type==0)? "Почта России" : "Major",
                ),
	)
));*/
 ?>

