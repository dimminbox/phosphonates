<div class="form">
<?php 

    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
        'action' => $action,));
?>
    <div class="row">
        <div class="labels">Язык</div>
        <div class="inputs">
            <span class="input_wrapper select_wrapper">
                <?php
                echo $form->dropDownList($language,'id',CHtml::listData(Language::model()->findAll(),'id','name'),
                                    array('name'=>'CategoryGroup[id_lang]'));
                ?>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="labels">Префикс</div>
        <div class="inputs">
            <span class="input_wrapper select_wrapper">
                <?php echo $form->dropDownList($prefix,'value',CHtml::listData(Preference::model()->findAll(array('condition'=>'name like "%prefix%"')),'value','title'),
                                    array('name'=>'CategoryGroup[id_prefix]'));?>
            </span>
        </div>
    </div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-group-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
    <div class="labels">  <?php echo $form->labelEx($model,'name'); ?></div>
    <div class="inputs">
         <span class="input_wrapper2">
            <?php echo $form->textField($model,'name',array('maxlength'=>255)); ?>
         </span>
    </div>
    <?php echo $form->error($model,'name'); ?>
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
<?php $this->endWidget(); ?>

</div>