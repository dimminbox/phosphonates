<div class="form">

<?php 

    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-form',
	'enableAjaxValidation'=>false,
    ));
?>
    <div class="row">
        <div class="labels">
            <label>Группа аттрибутов</label>
        </div>
        <div class="inputs">
            <span class="input_wrapper select_wrapper">
                <? echo $form->dropDownList($prefix,'id',CHtml::listData(SetAttribute::model()->findAllbyAttributes(array('active'=>1)),'id','title'),
                            array('name'=>'Attribute[setattribute]'));?>
            </span>
        </div>
    </div>
    <?php  foreach ($models as $index=>$model):?>
        <div class="row">
            <div class="labels">
            <label>Название ( <?php echo Language::model()->findByPk($index)->name; ?> )</label>
            </div>
            <div class="inputs">
                    <span class="input_wrapper2">
                     <?php echo $form->textField($model,'name',array('name'=>"Attribute[name][$index]")); ?>
                    </span>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="row">
        <div class="labels">
            <label>Тип аттрибута</label>
        </div>
        <div class="inputs">
            <ul>
                 <?php
                    echo CHtml::radioButtonList('Attribute[type]',$checked,Yii::app()->params['AttrType'],
                                    array('template'=>'<li>{input}{label}</li>','separator'=>'')
                                    );
                  ?>
            </ul>

        </div>
    </div>
    <div class="row" style="margin-top:20px;">
        <div class="labels">
            <?php echo $form->labelEx($model,'dropdown_value'); ?>
        </div>
        <div class="inputs">
            <span class="input_wrapper select_wrapper">
                <?php echo $form->dropDownList($model,'dropdown_value',Yii::app()->params['AttrRel']); ?>
            </span>
            <?php echo $form->error($model,'dropdown_value'); ?>
        </div>
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
</div>