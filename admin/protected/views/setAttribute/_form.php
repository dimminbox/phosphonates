<div class="formular">
<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-form',
	'enableAjaxValidation'=>false,
    )); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div class="labels">
            <label>
                <strong>Название: </strong>
            </label>
        </div>
        <div class="inputs">
            <span class="input_wrapper2">
                    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
            </span>
        </div>
    </div>
    
    <div class="row">
        <div class="labels">
            <label>
                <strong>Активный: </strong>
            </label>
        </div>
        <div class="inputs">
            <span class="input_wrapper2">
                <?php echo $form->checkBox($model,'active'); ?>
            </span>
        </div>
    </div>
    
    <div class="row" style="margin-top: 10px;">
        <span class="button2">
            <span>
                <span><em>Сохранить</em></span>
            </span>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </span>
     </div>

<?php $this->endWidget(); ?>

</div><!-- form -->