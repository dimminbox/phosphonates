<div id="head">
    <div class="box_title">Сравнение</div>
</div>
<div style="float:left;">
    <div>Артикул</div>
    <div>Название</div>
    <? foreach ($attributes as $index=>$attr) :?> 
        <div><?=$attr;?></div>
    <? endforeach; ?>
</div>
<? foreach ($compare as $product) :?>
    <div style="float:left;width: 200px;">
        
        <div><?=$product->articul?></div>
        <div><?=$product->prod_lang[0]->name?></div>

        <? foreach ($attributes as $index=>$attr) :?> 
            <? $flag=0;?>
        
            <? foreach ($product->prod_attr as $attr) :?> 
                
                <? if ($index==$attr->id_attr) :?>
                    <div><?=$attr->value;$flag=1; ?></div>
                <? endif; ?>
                    
            <? endforeach; ?>
            
            <? if ($flag==0) :?>
                <div>-</div>
            <? endif; ?>  
        <? endforeach; ?>            
     </div>
<? endforeach; ?>
