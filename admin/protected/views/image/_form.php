<div class="form" id="image">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>-->
       <?php echo $form->hiddenField($model,'file'); ?>
      
        <div class="row">
            <div id="photo_show">
                <?php echo CHtml::image(Yii::app()->params['image_products'].$model->file,'',array('style'=>'width:140px;'));?>
            </div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'alt'); ?>
		<?php echo $form->textField($model,'alt',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'main'); ?>
		<?php echo $form->checkBox($model,'main'); ?>
		<?php echo $form->error($model,'main'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'id_prod'); ?>
		<?php echo $form->hiddenField($model,'id_prod'); ?>
		<?php //echo $form->error($model,'id_prod'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'session_id'); ?>
		<?php echo $form->hiddenField($model,'session_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'session_id'); ?>
	</div>
	<div class="row buttons">
            <?php 
            //
            //
            echo CHtml::ajaxSubmitButton('Save',Yii::app()->urlManager->createUrl("image/$action",array('id_prod'=>$model->id)),
                                                    array('update'=>'#image'),array('name'=>'yti','id'=>'yti'));
            $params = ($action=='create') ? "id_prod=$model->id_prod" : "id=$model->id";
            echo "<script type=\"text/javascript\">jQuery('body').undelegate('#yti','click').delegate('#yti','click',function(){jQuery.ajax({'type':'POST','url':'/admin1/index.php?r=image/".$action."&".$params."','cache':false,'data':jQuery(this).parents(\"form\").serialize(),'success':function(html){jQuery(\"#image\").html(html)}});return false;});</script>";
            ?>
            
	</div>
<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'image-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'file',
		'alt',
		'main',
		'id_prod',
		array(
                    'name' => 'Image',
                    'type' => 'html',
                    'value' => 'CHtml::image(Yii::app()->params["image_products"].$data->file,"",array("style"=>"width:140px;"));'
                ),
                 array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::link(CHtml::image("/admin1/images/update.png"),"#",
                                          array("name"=>"yt".$data->id."_0","id"=>"yt".$data->id."_0")).
                                          "<script type=\"text/javascript\">jQuery(\'body\').undelegate(\'#yt".$data->id."_0\'".",\'click\').delegate(\'#yt".$data->id."_0\'".",\'click\',function(){jQuery.ajax({\'url\':\'/admin1/index.php?r=image/update&id=$data->id\',\'cache\':false,\'success\':function(html){jQuery(\"#image\").html(html)}});return false;});</script>"',
                 ),
                 array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::link(CHtml::image("/admin1/images/delete.png"),"#",
                                          array("name"=>"yt".$data->id."_1","id"=>"yt".$data->id."_1")).
                                          "<script type=\"text/javascript\">jQuery(\'body\').undelegate(\'#yt".$data->id."_1\'".",\'click\').delegate(\'#yt".$data->id."_1\'".",\'click\',function(){jQuery.ajax({\'url\':\'/admin1/index.php?r=image/delete&id=$data->id\',\'cache\':false,\'success\':function(html){jQuery(\"#image\").html(html)}});return false;});</script>"',
                 )

        )
)); ?>
</div><!-- form -->