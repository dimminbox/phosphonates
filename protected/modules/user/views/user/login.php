<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>


<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username') ?>
	</div>
	
	<div class="ui-dialog-row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password') ?>
	</div>
        
	<div class="row" style="margin-top: 15%;">
		<p class="hint">
		<?php 
                    echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
                <p class="hint">
		<?php 
                    echo CHtml::link(Yii::t('main','Registration'), '#', array('onclick'=>'$("#mydialog").dialog("close");$("#mydialog1").dialog("open"); return false;',
						'style'=>'right:14%;','rel'=>'nofollow'));
                    ?>
		</p>
	</div>
	
	<div class="row rememberMe">
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
                <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
	</div>

	<div class="row submit" style="clear:both;padding-top: 5px;">
		<?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'button button-blue')); ?>
	</div>
        
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>