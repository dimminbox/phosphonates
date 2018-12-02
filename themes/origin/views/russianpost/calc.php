<div style="clear:both;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'russian-post',
    'enableAjaxValidation'=>false,
    'method'=>'post',
    'action'=>'#',

)); ?>
    <?php echo $form->error($model,'index'); ?>
    <?php echo $form->error($model,'city'); ?>
    <?php echo $form->error($model,'address'); ?>
    <?php echo $form->error($model,'cost'); ?>
    <div id="chunk">
        <label>Страна*: </label><br>
        <?php echo $form->dropDownList($model,'country_id',$country,array('name'=>'Russianpost[countryCode]','id'=>'countryCode')); ?>

    </div>
    <div id="chunk">
        <label>Город*: </label><br>
        <?php echo $form->textField($model,'city',array('name'=>'Russianpost[city]','id'=>'city',)); ?>
    </div>
    <div id="chunk">
        <label>Улица, дом, кв*: </label><br>
        <?php echo $form->textField($model,'address',array('name'=>'Russianpost[address]','id'=>'address',)); ?>
    </div>
    <div style="clear:both;width:10px;">&nbsp;</div>
    <div id="chunk">
        <label>Индекс*: </label><br>
        <?php echo $form->textField($model,'index',array('name'=>'Russianpost[index]','id'=>'index',)); ?>
    </div>
    <div id="chunk">
        <label>Вид отправления*: </label><br>
        <?php echo $form->dropDownList($model,'method_id',$method,array('name'=>'Russianpost[viewPost]','id'=>'countryCode')); ?>
    </div>
    <div style="clear:both;">
        <?= CCHtml::ajaxSubmitButton("Рассчитать", array('russianpost/calc'),array("update"=>"#itog"),array('id'=>'calculate','name'=>'calculate','style'=>"clear:both;margin-left:5px;margin-top: 10px;font-size: 12px;width:auto;",
                        'class'=>'button button-blue',))?>
    </div>
    <br>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        delivery_select('russianpost','major');
	delivery_select('russianpost','samovyvoz');
    });
</script>