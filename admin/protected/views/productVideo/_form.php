<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'video-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

<div class="form">
    <?php echo $form->labelEx($video,'id_video'); ?>
    <?php  echo $form->dropDownList($video,'id_video',$list_videos,array('name'=>'ProductVideo[id_video]','multiple'=>0,'size'=>'auto')); ?>
    <?php echo $form->error($video,'id_video'); ?>
</div>

    
<div class="row">
    <?php echo $form->labelEx($video,'text_before'); ?>
    <?php echo $form->textArea($video,'text_before',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($video,'text_before'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($video,'text_after'); ?>
    <?php echo $form->textArea($video,'text_after',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($video,'text_after'); ?>
</div>
    
<div class="row">
    <?php echo $form->labelEx($video,'active'); ?>
    <?php echo $form->checkBox($video,'active'); ?>
    <?php echo $form->error($video,'active'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($video,'sort'); ?>
    <?php echo $form->textField($video,'sort',array('size'=>3,'maxlength'=>3)); ?>
    <?php echo $form->error($video,'sort'); ?>
</div>
<div class="row">
    <?php echo $form->hiddenField($video,'id_prod'); ?>
    <?php echo $form->hiddenField($video,'session_id'); ?>
    <?php echo $form->hiddenField($video,'id_lang'); ?>
</div>
<div class="row buttons">
    <?php 
        echo CHtml::ajaxSubmitButton('Save',Yii::app()->urlManager->createUrl("video/$action",array('id_prod'=>$video->id_prod)),
                                                    array('update'=>'#videos'),array('name'=>'ytv','id'=>'ytv'));
            $params = ($action=='create') ? "id_prod=$video->id_prod" : "id=$video->id";
            $params .="&id_lang=$video->id_lang";
            echo "<script type=\"text/javascript\">jQuery('body').undelegate('#ytv','click').delegate('#ytv','click',function(){jQuery.ajax({'type':'POST','url':'/admin1/index.php?r=productVideo/".$action."&".$params."','cache':false,'data':jQuery(this).parents(\"form\").serialize(),'success':function(html){jQuery(\"#videos\").html(html)}});return false;});</script>";
    ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'video-grid',
	'dataProvider'=>$video->search(),
	//'filter'=>$image,
	'columns'=>array(
		'id',
		'name',
                'text_before',
                'text_after',
		'active',
		'id_prod',
                  array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::link(CHtml::image("/admin1/images/update.png"),"#",
                                          array("name"=>"ytv".$data->id."_0","id"=>"ytv".$data->id."_0")).
                                          "<script type=\"text/javascript\">jQuery(\'body\').undelegate(\'#ytv".$data->id."_0\'".",\'click\').delegate(\'#ytv".$data->id."_0\'".",\'click\',function(){jQuery.ajax({\'url\':\'/admin1/index.php?r=productVideo/update&id=$data->id\',\'cache\':false,\'success\':function(html){jQuery(\"#videos\").html(html)}});return false;});</script>"',
                 ),
                 array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::link(CHtml::image("/admin1/images/delete.png"),"#",
                                          array("name"=>"ytv".$data->id."_1","id"=>"ytv".$data->id."_1")).
                                          "<script type=\"text/javascript\">jQuery(\'body\').undelegate(\'#ytv".$data->id."_1\'".",\'click\').delegate(\'#ytv".$data->id."_1\'".",\'click\',function(){jQuery.ajax({\'url\':\'/admin1/index.php?r=productVideo/delete&id=$data->id\',\'cache\':false,\'success\':function(html){jQuery(\"#videos\").html(html)}});return false;});</script>"',
                 )
        )
)); ?>    
</div><!-- form -->
<?php $this->endWidget(); ?>