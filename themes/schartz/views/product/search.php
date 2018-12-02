<div style="margin-top: 20px;">
<h2 class="name">Результаты поиска</h2>
<div class="extra_text">
<?php if (count($products)!=0):?>
    <?php foreach ($products as $product):?>
        <div style="margin-top: 10px;">
            <div style="float:left;margin-left: 10px;">
                <h3><?php echo CHtml::link("$product->name подробнее",array("/phosphonate/".$product->product->url)); ?></h3>
            </div>
            <div style="clear:both;"></div>
            <table style="border:0; margin-top: 10px;">
                <?php foreach ($product->product->prod_attr as $_index=>$attr):?>
                  <?php if ((isset($attr->attr_label))&&($attr->value!='')) :?>
                    <?php $class = (fmod($_index,2)==0) ? 'zeile1' : 'zeile2'; ?>
                    <tr>
                        <td class="<?php echo $class; ?>">
                            <strong>
                                <?php print $attr->attr_label->name;?>
                            </strong>
                        </td>
                        <td class="<?php echo $class; ?>">
                            <?php print $attr->value; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <? endforeach; ?>
            </table>
            
        </div>
	<? endforeach; ?>
<?php else :?>
<h2>К сожалению, ничего не найдено.</h2>
<?php endif;?>
</div>
</div>

