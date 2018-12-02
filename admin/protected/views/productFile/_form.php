<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

<div class="form">
    <?php echo $form->labelEx($file,'id_file'); ?>
    <?php  echo $form->dropDownList($file,'id_file',$list_file,array('name'=>'ProductFile[id_file]','multiple'=>0,'size'=>'auto')); ?>
    <?php echo $form->error($file,'id_file'); ?>
</div>

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
    <?php 
        echo CHtml::ajaxSubmitButton('Save',Yii::app()->urlManager->createUrl("image/$action",array('id_prod'=>$file->id_prod)),
                                                    array('update'=>'#files'),array('name'=>'ytf','id'=>'ytf'));
            $params = ($action=='create') ? "id_prod=$file->id_prod" : "id=$file->id";
            $params .="&id_lang=$file->id_lang";
            echo "<script type=\"text/javascript\">jQuery('body').undelegate('#ytf','click').delegate('#ytf','click',function(){jQuery.ajax({'type':'POST','url':'/admin1/index.php?r=productFile/".$action."&".$params."','cache':false,'data':jQuery(this).parents(\"form\").serialize(),'success':function(html){jQuery(\"#files\").html(html)}});return false;});</script>";
    ?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'image-grid',
	'dataProvider'=>$file->search(),
	//'filter'=>$image,
	'columns'=>array(
		'id',
		'name',
		'active',
		'id_prod',
                  array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::link(CHtml::image("/admin1/images/update.png"),"#",
                                          array("name"=>"yt".$data->id."_0","id"=>"yt".$data->id."_0")).
                                          "<script type=\"text/javascript\">jQuery(\'body\').undelegate(\'#yt".$data->id."_0\'".",\'click\').delegate(\'#yt".$data->id."_0\'".",\'click\',function(){jQuery.ajax({\'url\':\'/admin1/index.php?r=productFile/update&id=$data->id\',\'cache\':false,\'success\':function(html){jQuery(\"#files\").html(html)}});return false;});</script>"',
                 ),
                 array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::link(CHtml::image("/admin1/images/delete.png"),"#",
                                          array("name"=>"yt".$data->id."_1","id"=>"yt".$data->id."_1")).
                                          "<script type=\"text/javascript\">jQuery(\'body\').undelegate(\'#yt".$data->id."_1\'".",\'click\').delegate(\'#yt".$data->id."_1\'".",\'click\',function(){jQuery.ajax({\'url\':\'/admin1/index.php?r=productFile/delete&id=$data->id\',\'cache\':false,\'success\':function(html){jQuery(\"#files\").html(html)}});return false;});</script>"',
                 )
        )
)); ?>    
</div><!-- form -->
<?php $this->endWidget(); ?>