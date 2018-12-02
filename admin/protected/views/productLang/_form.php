<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-lang-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_prod'); ?>
		<?php echo $form->textField($model,'id_prod'); ?>
		<?php echo $form->error($model,'id_prod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lang'); ?>
		<?php echo $form->textField($model,'id_lang'); ?>
		<?php echo $form->error($model,'id_lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>70)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_descr'); ?>
		<?php echo $form->textField($model,'meta_descr',array('size'=>60,'maxlength'=>215)); ?>
		<?php echo $form->error($model,'meta_descr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keywords'); ?>
		<?php echo $form->textField($model,'meta_keywords',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'meta_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extra_text'); ?>
		<?php echo $form->textArea($model,'extra_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'extra_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->