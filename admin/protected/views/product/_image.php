<?php
         $this->widget('application.extensions.EAjaxUpload.EAjaxUpload',
                 array(
                       'id'=>'photo',
                       'config'=>array(
                                       'action'=>array(Yii::app()->urlManager->createUrl('image/upload')),
                                       'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                       //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                                       'onComplete'=>"js:function(id, fileName, responseJSON){
                                                            $(\"#Image_file\").attr(\"value\",responseJSON.filename);
                                                            document.getElementById('photo_show').innerHTML = '<div id=\"'+responseJSON.filename+'\"><input type=\"hidden\" name=\"Image[file]\" value=\"'+responseJSON.filename+'\" id=\"'+responseJSON.filename+'\"><img style=\"max-width:200px; max-height:200px\" src=\"/images/products/'+responseJSON.filename+'\" alt=\"\"></div>';
                                                            $(\"ul.qq-upload-list\").html('');
                                                            }",
                                       //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(responseJSON.filename); }",
                                       'messages'=>array(
                                       //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                       //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                       //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                       //                  'emptyError'=>"{file} is empty, please select files again without it.",
                                                         'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                        ),
                                       'showMessage'=>"js:function(message){ alert(message); }"
                                      )
                      ));
                      ?>

<div class="form" id="image">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($image); ?>

	<!--<div class="row">
		<?php echo $form->labelEx($image,'file'); ?>
		<?php echo $form->fileField($image,'file'); ?>
		<?php echo $form->error($image,'file'); ?>
	</div>-->
        <?php echo $form->hiddenField($image,'file'); ?>
        
        <div class="row">
            <div id="photo_show">
                <?php echo CHtml::image(Yii::app()->params['image_products'].$image->file,'',array('style'=>'width:140px;'));?>
            </div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($image,'alt'); ?>
		<?php echo $form->textField($image,'alt',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($image,'alt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($image,'main'); ?>
		<?php echo $form->checkBox($image,'main'); ?>
		<?php echo $form->error($image,'main'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($image,'id_prod'); ?>
		<?php echo $form->hiddenField($image,'id_prod'); ?>
		<?php //echo $form->error($image,'id_prod'); ?>
	</div>

	<div class="row">
            <input type="hidden" class="error" value="<?= session_id()?>" id="Image_session_id" name="Image[session_id]" maxlength="255" size="60"/>
		<?php //echo $form->hiddenField($image,'session_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($image,'session_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton('Save',Yii::app()->urlManager->createUrl('image/create',array('id_prod'=>$model->id)),
                                                    array('update'=>'#image','type'=>"GET")); ?>
	</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'image-grid',
	'dataProvider'=>$image->search(),
	//'filter'=>$image,
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
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/update.png"),
                                              Yii::app()->createUrl("image/update",array("id"=>$data->id)), array("update"=>"#image"))',
                ),
                array(            
                    'name'=>'',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/delete.png"),
                                              Yii::app()->createUrl("image/delete",array("id"=>$data->id)), array("update"=>"#image"))',
                 )
        )
)); ?>
</div><!-- form -->