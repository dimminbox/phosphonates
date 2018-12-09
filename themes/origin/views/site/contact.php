
<div class="container sectionContent" id="feedback">
        <div class="row">
          <div class="col-sm-12">
          <?php echo Yii::app()->runController('/event/view/id/1'); ?>
          </div>
          </div>
          </div>

<div class="container sectionContent" id="feedbackForm">
        <div class="row">
          <div class="col-sm-6">
        <h3>Обратная связь</h3>
        <?php $form=$this->beginWidget('CActiveForm',["htmlOptions"=>['class'=>"was-validated"]]); ?>
            <div style="font-size: 12px;" class="<?=$alertClass?>"><?=$message?></div>

            <div class="form-group">
                <?php echo $form->label($model,'first_name'); ?>
                <?php echo $form->textField($model,'first_name',['class'=> 'form-control','required'=>'true']); ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($model,'last_name'); ?>
                <?php echo $form->textField($model,'last_name',['class'=> 'form-control','required'=>'true']) ?>
            </div>

            <div class="rform-groupow">
                <?php echo $form->label($model,'email'); ?>
                <?php echo $form->textField($model,'email',['type'=>'email', 'class'=> 'form-control','required'=>'true']) ?>
            </div>

            <div class="form-group">
                <?php echo $form->label($model,'subject'); ?>
                <?php echo $form->textField($model,'subject',['class'=> 'form-control','required'=>'true']) ?>
            </div>

           <div class="form-group">
                <?php echo $form->label($model,'body'); ?>
                <?php echo $form->textArea($model,'body',['class'=> 'form-control','required'=>'true']) ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'verifyCode'); ?>
                <?php echo $form->textField($model,'verifyCode'); ?>
                <?php $this->widget('CCaptcha', array(
                    'clickableImage'=>true,
                    'showRefreshButton'=>true,
                    'buttonLabel' => 'Новый код')
                );?>
            </div>
            
           <div class="form-group" style="margin-top: 10px;">
                <?php echo CHtml::submitButton('Отправить',['class'=>'btn btn-primary']); ?>
            </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
</div>