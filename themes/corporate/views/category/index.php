<div style="margin-top: 20px;">
<h1 class="name"><? echo $cur_category->name; ?></h1>
<?php foreach ($categories as $index=>$category): ?>
<div class="extra_text">

    <?php foreach ($category->products as $product):?>
        <div style="margin-top: 10px;">
            
                <h3><?php echo CHtml::link("$product->name подробнее",array("/phosphonate/".$product->product->url)); ?></h3>
            
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
    <?php if ($category->cat_language[0]->id!=$cur_category->id): ?>
    <p><?php echo $category->cat_language[0]->description;?></p>
    <?php endif; ?>
    <hr/>
    <? endforeach; ?>
</div>
<? endforeach; ?>

<div class="cat_desc">
    <?php echo $cur_category->description; ?>
</div>

</div>

