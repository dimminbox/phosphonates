<!--[if !IE]>start wrapper<![endif]-->
<div id="wrapper">
<div id="wrapper2">
<div id="wrapper3">
<div id="wrapper4">
<span id="login_wrapper_bg"></span>

<div id="stripes">

        <!--[if !IE]>start login wrapper<![endif]-->
        <div id="login_wrapper">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableAjaxValidation'=>false,
                )); ?>
                    <fieldset>
                    <div class="error">
                        <div class="error_inner">
                            <?php echo $form->error($model,'password',array('style'=>'float:left;margin-left: 10px;')); ?>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                    <h1>Вход в админку</h1>
                        <div class="formular">
                                <span class="formular_top"></span>

                                <div class="formular_inner">

                                <label>
                                        <strong>Пользователь: </strong>
                                        <span class="input_wrapper">
                                            <?php echo $form->textField($model,'username'); ?>
                                        </span>
                                </label>
                                <label>
                                        <strong>Пароль: </strong>
                                        <span class="input_wrapper">
                                            <?php echo $form->passwordField($model,'password'); ?>
                                        </span>
                                </label>
                                <label class="inline">
                                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                                        <?php echo $form->label($model,'rememberMe'); ?>
                                        <?php echo $form->error($model,'rememberMe'); ?>
                                </label>

                                <ul class="form_menu">
                                        <li><span class="button"><span><span><em>Войти</em></span></span><?php echo CHtml::submitButton('Login'); ?></span></li>
                                        <li><span class="button"><span><span><a href="/">К сайту</a></span></span></span></li>
                                </ul>

                                </div>

                        </div>
                    </fieldset>

                <?php $this->endWidget(); ?>

                <span class="reflect"></span>
                <span class="lock"></span>


        </div>

        <!--[if !IE]>end login wrapper<![endif]-->
    </div>
        </div>
</div>
        </div>	
</div>
<!--[if !IE]>end wrapper<![endif]-->
