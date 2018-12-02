<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'language-form',
	'enableAjaxValidation'=>false,
        'method'=>'get',
        'action'=>$action,

)); ?>
<?php
echo $form->dropDownList($language,'name',CHtml::listData(Language::model()->findAll(),'code','name'),
                    array('name'=>'language','onChange'=>'this.form.submit();')); ?>
<?php $this->endWidget(); ?>
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'man-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->errorSummary($man_lang); ?>

       <div class="row">
		<?php echo $form->labelEx($man_lang,'name'); ?>
		<?php echo $form->textField($man_lang,'name',array('size'=>'50')); ?>
		<?php echo $form->error($man_lang,'name'); ?>
	</div>
        <div class="row">
            <?php if ($model->image!='') echo CHtml::image(Yii::app()->params['image_man'].$model->image,'',array('style'=>'width:150px'))?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($man_lang,'description'); ?>
                <?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
                "model"=>$man_lang,                # Data-Model
                "attribute"=>'description',         # Attribute in the Data-Model
                "height"=>'200px',
                "width"=>'100%',
                "toolbarSet"=>'Basic',          # EXISTING(!) Toolbar (see: fckeditor.js)
                "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                                # Path to fckeditor.php
                "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                                # Realtive Path to the Editor (from Web-Root)
                "config" => array(
                    "EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
                                                # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                                                # Additional Parameter (Can't configure a Toolbar dynamicly)
                ) ); ?>
		
		<?php echo $form->error($man_lang,'description'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->checkBox($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->