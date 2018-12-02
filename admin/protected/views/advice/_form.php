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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->errorSummary($advice_lang); ?>
        
        <div class="row">
	    <div class="labels">
	      <?php echo $form->labelEx($advice_lang,'name'); ?>
	    </div>
	    <div class="inputs">
		<span class="input_wrapper2">
		  <?php echo $form->textField($advice_lang,'name',array('size'=>'50')); ?>
		</span>
	    </div>
	    <?php echo $form->error($advice_lang,'name'); ?>
	</div>
        
        <div class="row">

	     <div class="labels">
		<?php echo $form->labelEx($advice_lang,'meta_title'); ?>
	     </div>
	      <div class="inputs">
		<span class="input_wrapper2">
		  <?php echo $form->textField($advice_lang,'meta_title',array('size'=>'50')) ?>
		</span>
	      </div>

	      <?php echo $form->error($advice_lang,'meta_title'); ?>

	</div>
        
        <div class="row">
	      <div class="labels">
		<?php echo $form->labelEx($advice_lang,'content'); ?>
	      </div>
                <?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
                "model"=>$advice_lang,                # Data-Model
                "attribute"=>'content',         # Attribute in the Data-Model
                "height"=>'1000px',
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
		
		<?php echo $form->error($advice_lang,'content'); ?>
	</div>
        
        <div class="row">
	    <div class="labels">
		<?php echo $form->labelEx($advice_lang,'short_content'); ?>
	    </div>
	     <div class="inputs">
		
		  <?php echo $form->textArea($advice_lang,'short_content',array('rows'=>2, 'cols'=>50)); ?>
		
	     </div>
	     <?php echo $form->error($advice_lang,'short_content'); ?>
	</div>

        <div class="row">
            <?php if ($model->image!='') echo CHtml::image(Yii::app()->params['image_advice'].$model->image,'',array('style'=>'width:150px'))?>
        </div>

	<div class="row">

	      <div class="labels">
		<?php echo $form->labelEx($model,'image'); ?>
	      </div>

	      <div class="inputs">
		<?php echo $form->fileField($model,'image'); ?>
	      </div>
	      
	      <?php echo $form->error($model,'image'); ?>
	</div>

        <div class="row">

	    <div class="labels">
		<?php echo $form->labelEx($advice_lang,'image_title'); ?>
	    </div>

	    <div class="inputs">

	       <span class="input_wrapper2">
		<?php echo $form->textField($advice_lang,'image_title'); ?>
	       </span>

	    </div>

	    <?php echo $form->error($advice_lang,'image_title'); ?>

	</div>

	<div class="row">

	      <div class="labels">
		<?php echo $form->labelEx($model,'active'); ?>
	      </div>

	      <div class="inputs">
		<?php echo $form->checkBox($model,'active'); ?>
	      </div>

	      <?php echo $form->error($model,'active'); ?>

	</div>

	<div class="row">

	      <div class="labels">
		<?php echo $form->labelEx($model,'sort'); ?>
	      </div>

	      <div class="inputs">
		  <span class="input_wrapper2">
		    <?php echo $form->textField($model,'sort',array('size'=>'4')); ?>
		  </span>
	      </div>

	      <?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->