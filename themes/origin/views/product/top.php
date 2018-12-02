<div id="box_prod">
    <div class="box_content">
    
<?php foreach ($tops as $top):?> 
   <div id="prod">
        <div class="image" align="center">
            <?
                if (isset($top->prod[0])) {
                    if (isset($top->prod[0]->prod_image[0]))
                        echo CCHtml::link(CHtml::image(Yii::app()->params['image_products'].$top->prod[0]->prod_image[0]->file),
                                array('/instrument/'.$top->id_cat.'-'.Translite::rusencode($top->prod[0]->prod_lang[0]->name).'-'.$top->prod[0]->id));
                }
            ?> 
        </div>
       <div class="descr"><?= CCHtml::link($top->prod[0]->articul.'. '.$top->prod[0]->prod_lang[0]->name,
                              array('/instrument/'.$top->id_cat.'-'.Translite::rusencode($top->prod[0]->prod_lang[0]->name).'-'.$top->prod[0]->id))?></div>	
			</div>
<? endforeach; ?>
    </div>
</div>