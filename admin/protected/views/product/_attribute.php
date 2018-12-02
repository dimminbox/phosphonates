<?php foreach ($prod_attr as $index=>$attribute) { ?>
<div class="row_big">
<div class="labels">
    <?php echo CHtml::label($attribute['name'], ''); ?>
</div>
<div class="inputs big">
    <span class="input_wrapper2 big">
        <?php if ($attribute['model']->memo) {
            $this->widget('application.extensions.markitup.EMarkitupWidget',
                          array(
                                'name' => "Attribute[".$attribute['id']."]",
                                'settings' => 'html',
                                'value' => $attribute['value'],
                                'htmlOptions'=> array('style'=>'width:80%')
                                )
                         );
        }
        elseif ($attribute['model']->input)
            echo CHtml::textField("Attribute[".$attribute['id']."]",$attribute['value']);
        elseif ($attribute['model']->checkbox)
            echo CHtml::checkbox("Attribute[".$attribute['id']."]",$attribute['value']);
        elseif ($attribute['model']->dropdown)
            echo CHtml::dropDownList("Attribute[".$attribute['id']."]",$attribute['value'],$attribute['models']); ?>
     </span>
</div>
</div>
<?php } ?>