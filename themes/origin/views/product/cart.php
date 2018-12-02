<?if(Yii::app()->params['lang_id']==4) :?>
<?  if (isset($cart)): ?>
<div id="head">
    <div class="box_title"><?=Yii::t('main','Shopping cart')?></div>
</div>
<div id="body1">
<? 
$this->widget('zii.widgets.grid.CGridView', array(
    'cssFile'=>Yii::app()->theme->baseUrl.'/css/form.css',
    'dataProvider'=>$cart,
    'hideHeader'=>true,
    'summaryText'=>'',
    'columns'=>array(
        array(
            'type'=>'raw',
            'name'=>'name',
            'value'=>'"<b>".Yii::app()->shoppingCart->itemAt("Product".$data->prod[0]->id)->getQuantity()." x ".$data->prod[0]->articul."</b>. ".$data->prod[0]->prod_lang[0]->name;',
        ),
        array(           
            'name'=>'111',
            'type'=>'raw',
            /*'value'=>'CHtml::ajaxlink(CHtml::image(Yii::app()->theme->baseUrl.Yii::app()->params["images"]."close_but.gif"),
                                              array("delcompare","id"=>$data->prod[0]->id),
                                              array("update"=>"#compare_list"),array("id"=>"rem_".$data->prod[0]->id))',*/
            'value'=>'CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.Yii::app()->params["images"]."close_but.gif"),"#",array("id"=>"remc_".$data->prod[0]->id))',
        ),
        array( 
            'name'=>'',
            'type'=>'raw',
            'value'=>'"<script type=\"text/javascript\">
                        jQuery(\'body\').undelegate(\'#remc_".$data->prod[0]->id."\',\'click\').delegate(\'#remc_".$data->prod[0]->id."\',\'click\',function(){jQuery.ajax({\'url\':\'/product/delcart/".$data->prod[0]->id."\',\'cache\':false,\'success\':function(html){jQuery(\"#cart_list\").html(html)}});return false;});</script>"',
        ),
    ),
));
?>
</div>
<? endif;?>

<script type="text/javascript">
    hidrstc(<?=$count?>)
</script>
<? endif;?>