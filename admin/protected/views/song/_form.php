<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'language-form',
	'enableAjaxValidation'=>false,
        'method'=>'get',
        'action'=>'index.php?&r='.$_GET['r'].'&id='.$model->id,

)); ?>

<p class="note">Contry Description</p>
<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
                <div class="row">
            	<?php $model->language=$model->lang_select; echo $form->dropDownList($model,'language',$model->languages,
                            array('name'=>'language','onChange'=>'this.form.submit();')); ?>
        </div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-form',
        'htmlOptions' => array ('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,

)); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($relate,'name',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
            
                <?php $this->widget('ext.fckeditor.FCKEditorWidget', array(
                  "model"=>$relate,
                  "attribute"=>'description',
                  "height"=>'500px',
                  "width"=>'100%',
                  "toolbarSet"=>'Default',
                  "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                  "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                  "config" => array(
                    "EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
                    # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                  )
                );?>

		<?php echo $form->error($model,'description'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->