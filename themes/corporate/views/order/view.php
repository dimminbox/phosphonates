<style type="text/css">
    <? echo file_get_contents($_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/css/form.css')?>
</style>
<style type="text/css">
    div#itog_cost div.label_delivery{
        width: 250px;
    }
    th {
        text-align: left;
    }
    .rekvizite{
        border-collapse: collapse;
        margin: 10px 0 10px 0;
    }
    .rekvizite td{
        border: 1px solid #000;
        font-size: 13px;
        font-weight: normal;
        padding:0 5px;
        
    }
    .title_company{
        font-size: 14px;
        font-family: Helvetica,Arial,Verdana,sans-serif;
        font-weight: bold;
        margin: 10px 0 0 5px;;
    }
    .odd td:first-child{
        font-weight: bold;
    }
 
</style>

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
<?php $type=Yii::app()->getModule('user')->user()->profile->Type_id;
        if(isset($type) && $type == 1){?>
        <div id="rekvizite">
            <div class="title_company">Наши реквизиты</div>
<table class="rekvizite">

<tbody>
<tr class="odd">
    <td>Название огранизации</td>
    <td ><?php echo Yii::app()->getModule('user')->user()->profile->Title_organization; ?></td>
</tr>
<tr class="odd" >
    <td>ИНН</td>
    <td ><?php echo Yii::app()->getModule('user')->user()->profile->Inn; ?></td>
</tr>
<tr class="odd">
    <td>КПП</td>
    <td><?php echo Yii::app()->getModule('user')->user()->profile->KPP; ?></td>
</tr>
</tbody>
</table>

        </div>
        <?php } ?>
<?php if (isset($_SESSION['code'])|| $_SESSION['code']!=0 ){
    $code = Code::model()->findbyAttributes(array('id'=>$_SESSION['code']));
   ?>   <div class="label_delivery">Скидка:</div><div class="cost_delivery"><?php echo $code ->ckidka;
   
}?>%</div>
       


<? 
if ($model->delivery_type==0){
    ?>
<div id="itog_cost">
        <div class="label_delivery">Стоимость товаров:</div><div class="cost_delivery"><?=Yii::app()->shoppingCart->getCost()?> руб.</div>
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
elseif ($model->delivery_type==1){
    ?>
<div id="itog_cost">
        <div class="label_delivery">Стоимость товаров:</div><div class="cost_delivery"><?=Yii::app()->shoppingCart->getCost()?> руб.</div>
        <div id="cost" class="label_delivery">
        <div>Стоимость доставки Major:</div>
        <div id="delivery_method">
            <? echo  Yii::t('main', 'major_address',
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
else {
?>
 <div class="label_delivery">Стоимость товаров:</div><div class="cost_delivery"><?=Yii::app()->shoppingCart->getCost()?> руб.</div>
        <div id="cost" class="label_delivery">
	  <div>Самовывоз:</div>  
	</div>
    <div class="cost_delivery">0 руб.</div>
    <div class="label_delivery">Итого:</div><div class="cost_delivery"><?=$model->summ?> руб.</div>
</div>
<?}
?>

