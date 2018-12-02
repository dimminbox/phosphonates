<script type="text/javascript">
$(document).ready(function() { 
    $('#code').keyup( function() {
        var $this = $(this);
        if($this.val().length > 5)
            $this.val($this.val().substr(0, 5));          
    });
    
    });
</script>
<form action="#" method="post">
        <div id="chunk" >
            <label>Введите номер карточки для получения скидки:</label>
            <br>
            <?php echo CHtml::textField('code','',array('name'=>'code','id'=>'code','size'=>'5')); ?>
            <?= CCHtml::ajaxSubmitButton("Применить", array('product/discount'),array("update"=>"#itog"),array('id'=>'code1','name'=>'code','style'=>"clear:both;margin-left:5px;margin-top: 10px;font-size: 12px;width:auto;",
                                'class'=>'button button_code button-blue',))?>
            <br>
            <span id="error_cart" class="error_cart"><?=$error_code?></span>
        </div>           
</form>
<h2 style="margin:0px;"><?=Yii::t('main','Order payment')?></h2>

<p id="delivery_info"><?echo Yii::app()->params['delivery_info']?></p>
<div id="itog_cost">
    <div>
        
    </div>
    <div class="label_delivery"><?=Yii::t('main','Cost of the instruments')?>:</div><div class="cost_delivery"><?=$product_cost?><?=Yii::t('main','RUB')?>.</div>
    <? if (!(($delivery_cost==0)&&($samovyvoz==0))) :?>
    <div class="label_delivery" id="cost">
        <div><?=Yii::t('main','Delivery cost')?> :</div>
        <div id="delivery_method">(<?=$method?>)</div>
    </div>
    <div class="cost_delivery"><?=$delivery_cost?> <?=Yii::t('main','RUB')?>.</div>
    <? endif;?>
    <div class="label_delivery"><?=Yii::t('main','Total')?>:</div><div class="cost_delivery"><?=$itog_cost?> <?=Yii::t('main','RUB')?>.</div>
</div>

<div style="clear:both;"></div>

<? if (($delivery_cost==0)&&($samovyvoz==0)) :?>
    <p id="delivery_info"><?=Yii::t('main','You can\'t issue the order without a choice of a method of delivery')?>.</p>
<?else : ?>
<form action="/order/add" method="GET" >
    <input type="submit" class="button button-orange" style="margin: 0px;font-size: 14px;font-weight: bold;" name="finish" id="finish" value="Оплатить"/>
</form>
<? endif; ?>