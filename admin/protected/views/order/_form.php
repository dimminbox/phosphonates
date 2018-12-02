<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->hiddenField($model,'id_user'); ?>
		<?php //echo $form->error($model,'id_user'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'date_payment'); ?>
		<?php echo $model->date_payment; ?>
		<?php echo $form->error($model,'date_payment'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'summ'); ?>
		<?php echo $model->summ; ?>
		<?php echo $form->error($model,'summ'); ?>
	</div>
    
	<div class="row">
		<?php //echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->hiddenField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
                <?php echo $form->labelEx($model,'date_posted'); ?>
                <? 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                           'name'=>'Order[date_posted]',
                           'value' => $model->date_posted,
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                                'timeFormat'=> 'h:m',
                                'dateFormat' => 'yy-mm-dd',
                                'currentText' => 'ddd',
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px;'
                            ),
                        ));
                ?>
		<?php //echo $form->textField($model,'date_posted'); ?>
		<?php echo $form->error($model,'date_posted'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('cols'=>50,'rows'=>'10')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'notification'); ?>
		<?php echo $form->checkbox($model,'notification'); ?>
		<?php echo $form->error($model,'notification'); ?>
	</div>
    
	<div class="row">
		<?php //echo $form->labelEx($model,'id_delivery'); ?>
		<?php echo $form->hiddenField($model,'id_delivery'); ?>
		<?php echo $form->error($model,'id_delivery'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'delivery_type'); ?>
		<?php echo $form->hiddenField($model,'delivery_type'); ?>
		<?php echo $form->error($model,'delivery_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->