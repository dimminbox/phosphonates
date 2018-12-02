<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'language-form',
	'enableAjaxValidation'=>false,
        'method'=>'get',
        'action'=>$action,

)); ?>
<div style="display: none;">
<?php
echo $form->dropDownList($language,'name',CHtml::listData(Language::model()->findAll(),'code','name'),
                    array('name'=>'language','onChange'=>'this.form.submit();')); ?>
<?php $this->endWidget(); ?>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>


	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->errorSummary($news_lang); ?>
	<div class="row">
		<div class="labels">
		  <?php echo $form->labelEx($news_lang,'name'); ?>
		</div>
		<div class="inputs">
		  <span class="input_wrapper2">
		    <?php echo $form->textField($news_lang,'name'); ?>
		  </span>
		</div>
		
		<?php echo $form->error($news_lang,'name'); ?>
	</div>

        <div class="row">
		<div class="labels">
		  <?php echo $form->labelEx($news_lang,'content'); ?>
		</div>
		<?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
                "model"=>$news_lang,                # Data-Model
                "attribute"=>'content',         # Attribute in the Data-Model
                "height"=>'600px',
                "width"=>'100%',
                "toolbarSet"=>'Default',          # EXISTING(!) Toolbar (see: fckeditor.js)
                "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                                # Path to fckeditor.php
                "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                                # Realtive Path to the Editor (from Web-Root)
                "config" => array(
                    "EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
                                                # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                                                # Additional Parameter (Can't configure a Toolbar dynamicly)
                ) ); ?>
		
		<?php echo $form->error($news_lang,'content'); ?>
	</div>
        
        <div class="row">
		<div class="labels"><?php echo $form->labelEx($news_lang,'short_content'); ?></div>
		<?php echo $form->textArea($news_lang,'short_content',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($news_lang,'short_content'); ?>
	</div>
        <div class="row">
            <?php if ($model->image!='') echo CHtml::image(Yii::app()->params['image_news'].$model->image,'',array('style'=>'width:150px'))?>
        </div>
	<div class="row">
		<div class="labels"><?php echo $form->labelEx($model,'image'); ?></div>
		<div class="inputs"><?php echo $form->fileField($model,'image'); ?></div>
		<?php echo $form->error($model,'image'); ?>
	</div>
        <div class="row" style="display: none;">
		<div class="labels"><?php echo $form->labelEx($news_lang,'image_title'); ?></div>
		<div class="inputs">
                <span class="input_wrapper2">
		  <?php echo $form->textField($news_lang,'image_title'); ?>
		</span>
		<?php echo $form->error($news_lang,'image_title'); ?>
		</div>
	</div>

	<div class="row">
		<div class="labels"><?php echo $form->labelEx($model,'active'); ?></div>
		<div class="inputs"><?php echo $form->checkBox($model,'active'); ?></div>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row" style="display: none;">
		<div class="labels"><?php echo $form->labelEx($model,'sort'); ?></div>
		<div class="inputs">
		  <span class="input_wrapper2">
		    <?php echo $form->textField($model,'sort',array('size'=>'4')); ?>
		  </span>
		</div>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row buttons">
          <span class="button2">
            <span>
                <span><em>Сохранить</em></span>
            </span>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
          </span>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->