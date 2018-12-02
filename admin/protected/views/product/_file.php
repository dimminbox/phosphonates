<div class="form" id="files">
    <div class="row">
    <?php 

    echo $form->labelEx($file,'id_file'); ?>
<?php  echo $form->dropDownList($file,'id_file',$list_file,array('name'=>'ProductFile[id_file]','multiple'=>0,'size'=>'auto')); ?>
<?php echo $form->error($file,'id_file'); ?>
    </div>
<?php //echo CHtml::dropDownList('ProductFile[id_file]','',$list_file); ?>
<div class="row">
    <?php echo $form->labelEx($file,'name'); ?>
    <?php echo $form->textField($file,'name',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($file,'name'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($file,'title'); ?>
    <?php echo $form->textField($file,'title',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->error($file,'title'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($file,'active'); ?>
    <?php echo $form->checkBox($file,'active'); ?>
    <?php echo $form->error($file,'active'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($file,'sort'); ?>
    <?php echo $form->textField($file,'sort',array('size'=>3,'maxlength'=>3)); ?>
    <?php echo $form->error($file,'sort'); ?>
</div>
<div class="row">
    <?php echo $form->hiddenField($file,'id_prod'); ?>
    <?php echo $form->hiddenField($file,'session_id'); ?>
    <?php echo $form->hiddenField($file,'id_lang'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::ajaxSubmitButton('Save',Yii::app()->urlManager->createUrl('productFile/create',
                                                                                array('id_prod'=>$file->id_prod,'id_lang'=>$file->id_lang)),
                                        array('update'=>'#files','type'=>"POST")); ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'image-grid',
	'dataProvider'=>$file->search(),
	//'filter'=>$image,
	'columns'=>array(
		
		'name',
		'active',
		'id_prod',
                array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/update.png"),
                                              Yii::app()->createUrl("productFile/update",array("id"=>$data->id,"id_prod"=>$data->id_prod)), array("update"=>"#files"))',
                ),
                array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/delete.png"),
                                              Yii::app()->createUrl("productFile/delete",array("id"=>$data->id)), array("update"=>"#files"))',
                 )
        )
)); ?>
	
</div>