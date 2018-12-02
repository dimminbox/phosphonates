<style type="text/css">
.compare tr.even td{
    width:<?=round(90/count($compare))?>%;
}
.compare tr.odd td{
    width:<?=round(90/count($compare))?>%;
}
</style>
<div style="padding: 5px;" id="prodcmp">
     <div style="float:left;">
         <h2 style="margin-top: 0px; margin-bottom: 10px; margin-left: 0px;"><?=Yii::t('main','Comparing of instruments')?></h2>
     </div>
     <!--<div style="float:right;">
         <a onclick='jprint()' style="color:black;" href="#">Распечатать страницу</a>
     </div>-->
     <div style="clear:both;"></div>
    <table border="1" class="compare">
        <tr id="delcmp">
            <td id="delcmp"></td>
        <? foreach ($compare as $product) :?>
            <td id="delcmp" class="c<?=$product->prod[0]->id?>"><?=CHtml::image(Yii::app()->theme->baseUrl.'/image/del.gif','',array('onclick'=>'remrst('.$product->prod[0]->id.')'));?></td>
            <? endforeach; ?>
        </tr>
         <tr class="even">
            <td id="titlecmp"><?=Yii::t('main','Code number')?></td>
            <? foreach ($compare as $product) :?>
            <td class="c<?=$product->prod[0]->id?>"><?=$product->prod[0]->articul?></td>
            <? endforeach; ?>
        </tr>
        <tr class="odd">
            <td id="titlecmp"><?=Yii::t('main','Photo')?></td>
            <? foreach ($compare as $product) :?>
            <td class="c<?=$product->prod[0]->id?>">
                <?if (isset($product->prod[0]->prod_image[0]->file)) :?>
                    <?=CHtml::image(Yii::app()->params['image_products'].$product->prod[0]->prod_image[0]->file,'',array('width'=>'150px;')) ?>
                <? endif; ?>
            </td>
            <? endforeach; ?>
        </tr>
        <tr class="even">
            <td id="titlecmp"><?=Yii::t('main','Title')?></td>
            <? foreach ($compare as $product) :?>
            <td class="c<?=$product->prod[0]->id?>"><?=CCHtml::link($product->prod[0]->prod_lang[0]->name,
                                array('/instrument/'.$product->id_cat.'-'.Translite::rusencode($product->prod[0]->prod_lang[0]->name).'-'.$product->prod[0]->id))?></td>
            <? endforeach; ?>
        </tr>
	<?if ((Yii::app()->params['lang_id']==4)&&(Yii::app()->params['table_suffix']=='')) :?>
        <tr class="odd">
            <td id="titlecmp">Цена</td>
            <? foreach ($compare as $product) :?>
            <td class="c<?=$product->prod[0]->id?>"><?=$product->prod[0]->price?> руб.</td>
            <? endforeach; ?>
        </tr>
	<? endif; ?>
        <tr class="even">
            <td id="titlecmp">В наличии</td>
            <? foreach ($compare as $product) :?>
            <td class="c<?=$product->prod[0]->id?>"><?=$product->prod[0]->available?></td>
            <? endforeach; ?>
        </tr>
        <? $count=0;?>
        <? foreach ($attributes as $index=>$attr) :?> 
        <? $flag=0;?>
        <tr class="<?=($count%2==0) ? 'odd' : 'even'?>">
            <td id="titlecmp"><?=$attr;?></td>
                <? foreach ($compare as $prod) :?>
                    <? foreach ($prod->prod[0]->prod_attr as $attr) :?> 
                        <? if ($index==$attr->id_attr) :?>
                            <td class="c<?=$prod->prod[0]->id?>"><?=$attr->value;$flag=1;break; ?></td>
                            <? else: $flag=0; ?>

                        <? endif; ?>

                    <? endforeach; ?>

                    <?if ($flag==0) :?>
                        <td class="c<?=$prod->prod[0]->id?>">-</td>
                    <? endif; ?>  

                    <? endforeach; ?> 
         </tr>  
         <? $count++;?>
         <? endforeach; ?> 
    </table>
 </div>