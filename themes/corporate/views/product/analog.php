<div id="short_descr">
 <?php foreach ($analogs as $product): ?> 
   <div id="item">
    <? if ((!empty($product->prod_image))&&($product->prod_image[0]->main==1))
           echo CHtml::image(Yii::app()->params['image_products'].$product->prod_image[0]->file);
       else
           echo CHtml::image(Yii::app()->params['image_products'].'noimage.jpg');
    ?>   
    <div class="item_descr">
        <h3><?=CCHtml::link($product->product->articul.' . '.$product->name,array('/instrument/'.
                Translite::rusencode($product->name).'-'.$product->id_prod))?></h3>
    </div>
	<?if ((Yii::app()->params['lang_id']==4)&&(Yii::app()->params['table_suffix']=='')) :?>
	  <div class="price">
	  <p><?=$product->product->price?> руб.</p>
	  </div>
	<? endif; ?>
        <div style="width:150px; margin-top:0;" class="but">
        <? if ($product->product->available!=0): ?>
            <h3 style="float:right; margin-top:2px;"><?=Yii::t('main','in stock');?> <span style="font-size:16px; color:#2E71D8; font-weight:bold;"></span></h3> 
        <? else :?>
            <h3 style="float:right; margin-top:2px;"><?=Yii::t('main','out of stock');?></h3> 
        <? endif; ?>
            <div style="clear:both;"></div>    
            <div class="but_more"><?=CCHtml::link(Yii::t('main','More'),array('/instrument/'.
                Translite::rusencode($product->name).'-'.$product->id_prod))?></div>
        <?if ((Yii::app()->params['lang_id']==4)&&(Yii::app()->params['table_suffix']=='')) :?>
        <div class="but_buy">
            <form method="POST" action="#">
                <?=CHtml::hiddenField('count', 0)?>
                <?= CHtml::ajaxSubmitButton(Yii::t('main','Buy'), array('product/buy','id'=>$product->id_prod),array("update"=>"#cart_list"),array('id'=>'buy'.$product->id_prod,'name'=>'buy','style'=>"padding: 5px;font-size: 12px;",
                                    'class'=>'button button-orange'))?>
            </form>
        </div>
        <? endif; ?>
        </div>
   </div>
  <? endforeach; ?>
</div>

