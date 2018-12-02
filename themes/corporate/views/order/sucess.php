<style type="text/css">
    div#itog_cost div.label_delivery{
        width: 250px;
    }
    th {
        text-align: left;
    }
</style>
<h3>Спасибо, что Вы сделали заказ в нашем интернет-магазине!</h3>
<p>Информация о заказе отослана Вам на email</p>
<div id="shopcart">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$products,
	'cssFile'=>Yii::app()->theme->baseUrl.'/css/form.css',
        
        'summaryText'=>'',
        'enablePagination'=>false,
        'enableSorting'=>false,
	'columns'=>array(
                'name_product',
		'qty',
                'price',
                array('name'=>'Сумма','value'=>'$data->qty*$data->price')
	),
)); ?>
</div>
<? 
if ($model->delivery_type==0){
    ?>
<div id="itog_cost">
        <div class="label_delivery">Стоимость товаров:</div>
        <div class="cost_delivery">
          <?=$model->summ-$model->russianpost->attributes['cost']?> руб.
        </div>
        <div id="cost" class="label_delivery">
            <div>Стоимость доставки Почта Росии:</div>
            <div id="delivery_method">
            <? echo  Yii::t('main', 'russianpost_address',
                                    array('{country}'=>$model->russianpost->attributes['country'],
                                       '{index}'=>$model->russianpost->attributes['index'],
                                       '{city}'=>$model->russianpost->attributes['city'],
                                       '{address}'=>$model->russianpost->attributes['address'],
                                       '{cost}'=>$model->russianpost->attributes['cost'],
                                       '{method}'=>$model->russianpost->attributes['method'])); ?>
            </div>
        </div>
 <div class="cost_delivery"><?=$model->major->attributes['cost']?> руб.</div>
        <div class="label_delivery">Итого:</div><div class="cost_delivery"><?=$model->summ?> руб.</div>
</div>
<? }
else {
    ?>
<div id="itog_cost">
        <div class="label_delivery">Стоимость товаров:</div>
            <div class="cost_delivery">
                <?=$model->summ-$model->major->attributes['cost']?> руб.
            </div>
        <div id="cost" class="label_delivery">
        <div>Стоимость доставки Major:</div>
        <div id="delivery_method">
            <?  
		echo  Yii::t('main', 'major_address',
                                    array('{country}'=>$model->major->attributes['id_country'],
                                       '{city}'=>City::model()->findByPk($model->major->attributes['id_city'])->name,
                                       '{address}'=>$model->major->attributes['address'],
                                       '{cost}'=>$model->major->attributes['cost'],
                                       '{period_deliver}'=>$model->major->attributes['delivery_time'])); ?>
        </div>
    </div>
    <div class="cost_delivery"><?=$model->major->attributes['cost']?> руб.</div>
        <div class="label_delivery">Итого:</div><div class="cost_delivery"><?=$model->summ?> руб.</div>
</div>
<?
    }
?>

