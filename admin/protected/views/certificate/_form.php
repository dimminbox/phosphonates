<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>
      
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
            <div class="labels">
                <?php echo $form->labelEx($model,'name'); ?>
            </div>
            <div class="inputs">
                   <?php echo $form->fileField($model,'name') ?>
            </div>
            <?php echo $form->error($model,'name'); ?>
        </div>
        
        <div class="row">
            <?php echo CHtml::link($model->name,Yii::app()->params['path_files'].$model->name); 
            $form->labelEx($model,'name'); ?>
        </div>
        <br>

	<div class="row">
            <div class="labels">
                <?php echo $form->labelEx($model,'title'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                   <?php echo $form->textField($model,'title') ?>
                </span>
            </div>
            <?php echo $form->error($model,'title'); ?>
        </div>

 
        <div class="row">
            <div class="labels">
                <?php echo $form->labelEx($model,'active'); ?>
            </div>
            <div class="inputs">
                   <?php echo $form->checkBox($model,'active') ?>
            </div>
            <?php echo $form->error($model,'active'); ?>
        </div>

        <div class="row" style="display: none;">
            <div class="labels">
                <?php echo $form->labelEx($model,'sort'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                   <?php echo $form->textField($model,'sort') ?>
                </span>
            </div>
            <?php echo $form->error($model,'sort'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->