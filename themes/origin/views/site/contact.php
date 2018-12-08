<?php echo Yii::app()->runController('/event/view/id/1'); 
?>

<div class="container sectionContent" id="#feedback">
        <div class="row">
          <div class="col-sm-6">

        <?php $form=$this->beginWidget('CActiveForm',["htmlOptions"=>['class'=>"was-validated"]]); ?>

            <div class="form-group">
                <?php echo $form->label($model,'first_name'); ?>
                <?php echo $form->textField($model,'first_name',['class'=> 'form-control','required'=>'true']); ?>
                <div class="invalid-tooltip">
          Please choose a unique and valid username.
        </div>
            </div>

            <div class="form-group">
                <?php echo $form->label($model,'last_name'); ?>
                <?php echo $form->textField($model,'last_name',['class'=> 'form-control','required'=>'true']) ?>
            </div>

            <div class="rform-groupow">
                <?php echo $form->label($model,'email'); ?>
                <?php echo $form->textField($model,'email',['class'=> 'form-control','required'=>'true']) ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($model,'subject'); ?>
                <?php echo $form->textField($model,'subject',['class'=> 'form-control','required'=>'true']) ?>
            </div>

           <div class="form-group">
                <?php echo $form->label($model,'body'); ?>
                <?php echo $form->textArea($model,'body',['class'=> 'form-control','required'=>'true']) ?>
            </div>

           <div class="form-group" style="margin-top: 10px;">
                <?php echo CHtml::submitButton('Отправить',['class'=>'btn btn-primary']); ?>
            </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
</div>