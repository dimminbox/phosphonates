<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_posted'); ?>
		<?php echo $form->textField($model,'date_posted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_payment'); ?>
		<?php echo $form->textField($model,'date_payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_delivery'); ?>
		<?php echo $form->textField($model,'id_delivery'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'summ'); ?>
		<?php echo $form->textField($model,'summ'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'delivery_type'); ?>
		<?php echo $form->textField($model,'delivery_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->