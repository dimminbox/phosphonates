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
<?php echo $form->errorSummary($relate); ?>
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
		<?php echo $form->labelEx($relate,'title'); ?>

		<?php
                        $valid = $relate->getValidators('title');
                        echo $form->textArea($relate,'title',array('rows'=>3,'cols'=>65,'onkeyup'=>'visualtitle('.$valid[1]->max.')'));
                ?>
		<?php  echo $form->error($relate,'title'); ?>
            <br> <span id="title"></span>
	</div>
        <div class="row">
            <?php echo $form->labelEx($filmstyle,'id_style'); ?>
            <?php echo $form->listBox($filmstyle,'id_style',CHtml::listData(Style::model()->findAll(),'id','name'),array('multiple'=>1,'size'=>'auto')); ?>
            <?php echo $form->error($filmstyle,'id_style'); ?>
        </div>
        <div class="row">
		<?php echo $form->labelEx($relate,'year'); ?>
		<?php echo $form->textField($relate,'year',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($relate,'year'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($relate,'country'); ?>
		<?php echo $form->textField($relate,'country',array('size'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($relate,'country'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($relate,'director'); ?>
		<?php echo $form->textField($relate,'director',array('size'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($relate,'director'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($relate,'actor'); ?>
		<?php echo $form->textArea($relate,'actor',array('rows'=>3,'cols'=>50)); ?>
		<?php echo $form->error($relate,'actor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
            
                <?php 
                $this->widget('ext.fckeditor.FCKEditorWidget', array(
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
		<?php echo $form->labelEx($relate,'video'); ?>
		<?php echo $form->textArea($relate,'video',array('rows'=>4,'cols'=>100)); ?>
		<?php echo $form->error($relate,'video'); ?>
	</div>
       <div class="row">
		<?php echo $form->labelEx($relate,'meta_description'); ?>
		<?php
                     $valid = $relate->getValidators('meta_description');
                    echo $form->textArea($relate,'meta_description',array('rows'=>5,'cols'=>100,'onkeyup'=>'visualmeta('.$valid[0]->max.')'));
                ?>
		<?php echo $form->error($relate,'meta_description'); ?>
                <br> <span id="meta_description"></span>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
       
        <div>
          <?php echo CHtml::textField('FilmLanguage[ozon_search]'); ?>
          <?php echo CHtml::ajaxButton('Отжать OZON',array('film/ozon','id'=>$model->id),
                                       array('type'=>'POST','update'=>'#ozon',
                                       array('type' => 'submit'))); ?>
          <div id="ozon"></div>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->