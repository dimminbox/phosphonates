<div class="form">
    	<?php echo $form->errorSummary($model); ?>
    
        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($prod_lang,'name'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($prod_lang,'name'); ?>
                </span>
            </div>
            <?php echo $form->error($prod_lang,'name'); ?>
        </div>
    
        <div class="row">
            <div class="labels">
             <?php echo $form->labelEx($model,'articul'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($model,'articul',array('maxlength'=>10)); ?>
                </span>
            </div>
            <?php echo $form->error($model,'articul'); ?>
        </div>

        <div class="row">
            <div class="labels">
                <?php echo $form->labelEx($model,'available'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($model,'available',array('maxlength'=>3)); ?>
                </span>
            </div>
            <?php echo $form->error($model,'available'); ?>
        </div>

        <div class="row">
            <div class="labels">
                      <?php echo $form->labelEx($model,'parent'); ?>
            </div>
            <div class="inputs">
                  <span class="input_wrapper select_wrapper">
                    <?php echo $form->dropDownList($model,'parent',$list_cat,array('name'=>'Product[parent]','multiple'=>1,'size'=>'15','style'=>'width: 600px')); ?>
                </span>
            </div>
            <?php echo $form->error($model,'parent'); ?>
        </div>

        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($model,'price'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($model,'price'); ?>
                </span>
            </div>
            <?php echo $form->error($model,'price'); ?>
        </div>

        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($model,'url'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($model,'url',array('maxlength'=>500)); ?>
                </span>
            </div>
            <?php echo $form->error($model,'url'); ?>
        </div>
        
        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($model,'file'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($model,'file',array('maxlength'=>500)); ?>
                </span>
            </div>
            <?php echo $form->error($model,'file'); ?>
        </div>

        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($prod_lang,'title'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($prod_lang,'title',array('maxlength'=>70)); ?>
                </span>
            </div>
            <?php echo $form->error($prod_lang,'title'); ?>
        </div>
        
	<div class="row">
            <div class="labels">
               <?php echo $form->labelEx($prod_lang,'meta_descr'); ?>
            </div>
            <div class="inputs">
               <?php echo $form->textArea($prod_lang,'meta_descr',array('rows'=>3, 'cols'=>25)); ?>
            </div>
            <?php echo $form->error($prod_lang,'meta_descr'); ?>
	</div>

        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($prod_lang,'meta_keywords'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($prod_lang,'meta_keywords',array('maxlength'=>50)); ?>
                </span>
            </div>
            <?php echo $form->error($prod_lang,'meta_keywords'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($prod_lang,'extra_text'); ?>
                <?php $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
                    "model"=>$prod_lang,                # Data-Model
                    "attribute"=>'extra_text',         # Attribute in the Data-Model
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
                    ));
                ?>
		<?php echo $form->error($prod_lang,'extra_text'); ?>
	</div>
        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($model,'active'); ?>
            </div>
            <div class="inputs">
              <?php echo $form->checkBox($model,'active'); ?>
            </div>
            <?php echo $form->error($model,'active'); ?>
        </div>

        <div class="row">
            <div class="labels">
               <?php echo $form->labelEx($model,'top'); ?>
            </div>
            <div class="inputs">
              <?php echo $form->checkBox($model,'top'); ?>
            </div>
            <?php echo $form->error($model,'top'); ?>
        </div>

        <div class="row">
            <div class="labels">
               	<?php echo $form->labelEx($model,'new'); ?>
            </div>
            <div class="inputs">
              <?php echo $form->checkBox($model,'new'); ?>
            </div>
            <?php echo $form->error($model,'new'); ?>
        </div>
         <div class="row">
            <div class="labels">
              <?php echo $form->labelEx($model,'sort'); ?>
            </div>
            <div class="inputs">
                <span class="input_wrapper2">
                    <?php echo $form->textField($model,'sort',array('maxlength'=>3)); ?>
                </span>
            </div>
           <?php echo $form->error($model,'sort'); ?>
        </div>

        <div class="row buttons">
              <span class="button2">
                <span>
                    <span><em>Сохранить</em></span>
                </span>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
              </span>
        </div>
</div><!-- form -->