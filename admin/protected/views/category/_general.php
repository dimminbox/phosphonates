<?php
 $_form=$this->beginWidget('CActiveForm', array(
    'id'=>'category-form',
    'htmlOptions' => array ('enctype'=>'multipart/form-data'),
    'enableAjaxValidation'=>false,));
 ?>
<div class="row" style="display: none;">
  <div class="labels">
    <label>Язык</label>
  </div>
  <div class="inputs" >
         <span class="input_wrapper select_wrapper">
             <?php 
                echo $_form->dropDownList($language,'name',CHtml::listData(Language::model()->findAll(),'code','name'),
                            array('name'=>'language','onChange'=>'this.form.submit();'));
             ?>
         </span>
  </div>
</div>
<?php $this->endWidget();?>
<div class="row" style="display: none;">
  <div class="labels">
    <label>Префикс</label>
  </div>
  <div class="inputs">
         <span class="input_wrapper select_wrapper">
             <?php
                echo $form->dropDownList($prefix,'value',CHtml::listData(Preference::model()
                            ->findAll(array('condition'=>'name like "%prefix%" and name!="prefix_all"')),'value','title'),
                            array('name'=>'Category[prefix]'));
             ?>
         </span>
  </div>
</div>
<div class="row">
  <div class="labels">
    <?php echo $form->labelEx($cat_lang,'name'); ?>
  </div>
  <div class="inputs">

             <?php echo $form->textArea($cat_lang,'name',array('rows'=>3,'cols'=>30)); ?>

        <?php echo $form->error($cat_lang,'name'); ?>
  </div>
</div>  

<div class="row">
  <div class="labels">
    <?php echo $form->labelEx($model,'parent'); ?>
  </div>
  <div class="inputs">
         <span class="input_wrapper select_wrapper">
             <?php echo $form->dropDownList($model,'parent',$list_cat,array('name'=>'Category[parent]')); ?>
         </span>
        <?php echo $form->error($model,'parent'); ?>
  </div>
</div>  

<div class="row" style="display: none;">
  <div class="labels">
    <?php echo $form->labelEx($cat_lang,'id_group'); ?>
  </div>
  <div class="inputs">
         <span class="input_wrapper select_wrapper">
             <?php echo $form->dropDownList($cat_lang,'id_group',$group_cat,array('name'=>'CategoryLang[id_group]')); ?>
         </span>
        <?php echo $form->error($cat_lang,'id_group'); ?>
  </div>
</div>

<div class="row">
    <div class="labels">
        <?php echo $form->labelEx($model,'image'); ?>
        <?php echo CHtml::image(Yii::app()->params['image_categories'].$model->image,'',array('width'=>'150px')); ?>
    </div>
    <div class="inputs">
         <span class="input_wrapper select_wrapper">
             <?php  echo $form->fileField($model,'image');?>
         </span>
        <?php echo $form->error($model,'image'); ?> 
    </div>
</div>
<div class="row1">
    <div class="labels">
            <?php echo $form->labelEx($cat_lang,'description'); ?>
    </div>
    <?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
    "model"=>$cat_lang,                # Data-Model
    "attribute"=>'description',         # Attribute in the Data-Model
    "height"=>'400px',
    "width"=>'100%',
    "toolbarSet"=>'Default',          # EXISTING(!) Toolbar (see: fckeditor.js)
    "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                    # Path to fckeditor.php
    "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                    # Realtive Path to the Editor (from Web-Root)
    "config" => array(
        "EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
                                    # http://docs.fckeditor.net/FCKeditor_2.x/Developers_Guide/Configuration/Configuration_Options
                                    # Additional Parameter (Can't configure a Toolbar dynamicly)
    ) ); ?>

    <?php echo $form->error($cat_lang,'description'); ?>
</div>

<div class="row">
    <div class="labels">
        <?php echo $form->labelEx($cat_lang,'title'); ?>
    </div>
    <?php echo $form->textField($cat_lang,'title',array('size'=>70,'maxlength'=>70)); ?>
    <?php echo $form->error($cat_lang,'title'); ?>
</div>

<div class="row">
    <div class="labels">
        <?php echo $form->labelEx($cat_lang,'meta_descr'); ?>
    </div>
    <?php echo $form->textArea($cat_lang,'meta_descr',array('rows'=>5,'cols'=>100)); ?>
    <?php echo $form->error($cat_lang,'meta_descr'); ?>
</div>
<div class="row">
    <div class="labels">
        <?php echo $form->labelEx($cat_lang,'meta_keywords'); ?>
    </div>
    <?php echo $form->textArea($cat_lang,'meta_keywords',array('rows'=>5,'cols'=>100)); ?>
    <?php echo $form->error($cat_lang,'meta_keywords'); ?>
</div>
<div class="row">
    <div class="labels">
        <?php echo $form->labelEx($model,'url'); ?>
    </div>
    <?php echo $form->textField($model,'url'); ?>
    <?php echo $form->error($model,'url'); ?>
</div>
<div class="row">
    
        <?php echo $form->labelEx($model,'active'); ?>
        <?php echo $form->checkBox($model,'active'); ?>
        <?php echo $form->error($model,'active'); ?>
</div>

<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>