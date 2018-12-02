<div class="form" id="videos">
    <div class="row">
    <?php echo $form->labelEx($prod_video,'id_video'); ?>
<?php  echo $form->dropDownList($prod_video,'id_video',$list_video,array('name'=>'ProductVideo[id_video]','multiple'=>0,'size'=>'auto')); ?>
<?php echo $form->error($prod_video,'id_video'); ?>
    </div>
<?php //echo CHtml::dropDownList('ProductFile[id_file]','',$list_file); ?>
    
<div class="row">
    <?php echo $form->labelEx($prod_video,'name'); ?>
    <?php echo $form->textField($prod_video,'name',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($prod_video,'name'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($prod_video,'text_before'); ?>
    <?php echo $form->textArea($prod_video,'text_before',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($prod_video,'text_before'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($prod_video,'text_after'); ?>
    <?php echo $form->textArea($prod_video,'text_after',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($prod_video,'text_after'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($prod_video,'active'); ?>
    <?php echo $form->checkBox($prod_video,'active'); ?>
    <?php echo $form->error($prod_video,'active'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($prod_video,'sort'); ?>
    <?php echo $form->textField($prod_video,'sort',array('size'=>3,'maxlength'=>3)); ?>
    <?php echo $form->error($prod_video,'sort'); ?>
</div>
<div class="row">
    <?php echo $form->hiddenField($prod_video,'id_prod'); ?>
    <?php echo $form->hiddenField($prod_video,'session_id'); ?>
    <?php echo $form->hiddenField($prod_video,'id_lang'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::ajaxSubmitButton('Save',Yii::app()->urlManager->createUrl('productVideo/create',
                                                                                array('id_prod'=>$prod_video->id_prod,'id_lang'=>$prod_video->id_lang)),
                                        array('update'=>'#videos','type'=>"POST")); ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'video-grid',
	'dataProvider'=>$prod_video->search(),
	//'filter'=>$image,
	'columns'=>array(
		'name',
                'text_before',
                'text_after',
		'active',
		'id_prod',
                array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/update.png"),
                                              Yii::app()->createUrl("productVideo/update",array("id"=>$data->id,"id_prod"=>$data->id_prod)), array("update"=>"#videos"))',
                ),
                array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/delete.png"),
                                              Yii::app()->createUrl("productVideo/delete",array("id"=>$data->id)), array("update"=>"#videos"))',
                 )
        )
)); ?>
	
</div>