<?php foreach ($prod_attr as $attribute) : ?>
    <div class="row">
            <div class="labels">
                <?php echo CHtml::label($attribute['name'], ''); ?>
            </div>
            <div class="inputs">
            <?php if ($attribute['memo']):?>
                <span class="input_wrapper3">
                    <?php
                            $this->widget('application.extensions.markitup.EMarkitupWidget', 
                            array(
                                'name' => "Attribute[".$attribute['id']."]",
                                'settings' => 'html',
                                'value' => $attribute['value'],
                                'htmlOptions'=> array('style'=>'width:70%','height'=>'114px')));
                     ?>
                </span>
            <?php else: ?>    
                <span class="input_wrapper2">
                        <?php echo CHtml::textField("Attribute[".$attribute['id']."]",$attribute['value']);  ?>
                </span>
            <?php endif; ?>
            </div>
                    
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    $("a[title='attrbutes_type']").text('<?php echo $title; ?>');
</script>