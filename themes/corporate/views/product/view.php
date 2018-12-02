<div class="extra_text">
    <h1><?php echo $product[0]->name; ?></h1>
    <table style="border:0; margin-top: 10px;">
     <?php foreach ($product[0]->product->prod_attr as $_index=>$attr):?>
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
    <div class="extra_desc">
        <?php echo $product[0]->extra_text?>
    </div>
</div>

