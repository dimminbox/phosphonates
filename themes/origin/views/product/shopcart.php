<script>
	$(function() {
		$( "#accordion" ).accordion({autoHeight:false});           
	});
</script>
<?if(Yii::app()->params['lang_id']==4) :?>
<?  if (isset($cart)): ?>
<div id="accordion">
    <h2><a href="#"><?=Yii::t('main','Shopping cart')?></a></h2>
    <div id="shopcart">
        <form action="cartupd" method="POST">
        <? 
        $this->widget('zii.widgets.grid.CGridView', array(
            'cssFile'=>Yii::app()->theme->baseUrl.'/css/form.css',
            'dataProvider'=>$cart,
            'hideHeader'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'type'=>'raw',
                    'id'=>'name',
                    'name'=>Yii::t('main','Instrument'),
                    'value'=>'CHtml::link($data->prod[0]->articul." . ".$data->prod[0]->prod_lang[0]->name,array("/instrument/".$data->id_cat."-".Translite::rusencode($data->prod[0]->prod_lang[0]->name)."-".$data->prod[0]->id))',
                ),
                array(
                    'type'=>'raw',
                    'id' => 'quantity',
                    'name'=>Yii::t('main','Quantity'),
                    'value'=>'"<div id=\"quantity\"><input name=\"count_".$data->prod[0]->id."\" type=\"text\" value=\"".Yii::app()->shoppingCart->itemAt("Product".$data->prod[0]->id)->getQuantity().
                              "\" /></div><div id=\"plus_min\"><div id=\"add_b\"><input id=\"add_b\" name=\"plus_".$data->prod[0]->id."\"type=\"image\" src=\"/images/add.png\"/></div>
                              <div id=\"del_b\"><input id=\"del_b\" name=\"minus_".$data->prod[0]->id."\" type=\"image\" src=\"/images/del.png\"/></div></div>"',
                ),
                array(
                    'type'=>'raw',
                    'id' => 'price',
                    'name'=>Yii::t('main','Price').'('.Yii::t('main','RUB').')',
                    //'value'=>'$data->prod[0]->price*Yii::app()->shoppingCart->itemAt("Product".$data->prod[0]->id)->getQuantity()',
                    'value'=>'$data->prod[0]->price',
                ),

                array(
                    'type'=>'raw',
                    'id' => 'rem_b',
                    'name'=>'',
                    'value'=>'"<input name=\"delete_".$data->prod[0]->id."\" type=\"image\" src=\"".Yii::app()->theme->baseUrl.Yii::app()->params["images"]."del_button1.png\">"',
                    //'value'=>'CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.Yii::app()->params["images"]."del_button1.png"),"#",array("id"=>"remc_".$data->prod[0]->id))'
                ),
                array( 
                    'name'=>'',
                    'type'=>'raw',
                    'value'=>'"<script type=\"text/javascript\">
                                jQuery(\'body\').undelegate(\'#remc_".$data->prod[0]->id."\',\'click\').delegate(\'#remc_".$data->prod[0]->id."\',\'click\',function(){jQuery.ajax({\'url\':\'/product/delcompare/".$data->prod[0]->id."\',\'cache\':false,\'success\':function(html){jQuery(\"#cart_list\").html(html)}});return false;});</script>"',
                ),
            ),
        ));
        ?>
        </form>
    </div>
    <h2><a href="#"><?=Yii::t('main','Delivery')?></a></h2>
    <div id="delivery">
        <div id="russianpost">
            <? echo CHtml::ajaxLink(CHtml::image('/images/russianpost.png','',array('id'=>'russianpost')), array('russianpost/calc'),array('update'=>'#russianpost_block'),array('name'=>'pochta','id'=>'pochta'))?>
        </div>
        <div id="major">
            <? echo CHtml::ajaxLink(CHtml::image('/images/major.png','',array('id'=>'major')), array('major/calc'),array('update'=>'#russianpost_block'),array('name'=>'major','id'=>'major'))?>
        </div>
	<div id="samovyvoz">
            <? echo CHtml::ajaxLink(CHtml::image('/images/samovyvoz.jpg','',array('id'=>'samovyvoz')), array('major/Samovyvoz'),array('update'=>'#russianpost_block'),array('name'=>'samovyvoz','id'=>'samovyvoz'))?>
	    <? echo CHtml::ajaxLink('samovyvozitog', array('major/samovyvozitog'),array('update'=>'#itog'),
					  array('name'=>'samovyvozitog','id'=>'samovyvozitog','style'=>'display:none;'))?>
        </div>
        <div id="russianpost_block">
            <?=Yii::app()->runController('russianpost/calc')?>            
        </div>
    </div>
</div>
<div id="itog">
  
   <?=Yii::app()->runController('product/itog')?>            
</div>
<div style="clear:both;"></div>
<? endif;?>
<? endif;?>