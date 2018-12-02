<div style="clear:both;"></div>
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'russian-post',
	'enableAjaxValidation'=>false,
        'method'=>'post',
        'action'=>'#',

    )); ?>
        <form action="#" method="post">
        <div id="chunk">
            <label>Страна: </label><br>
            <?php 
            if ($model->id_country!=0)
                echo $form->dropDownList($model,'id_country',$country,array('name'=>'countryCode',
                                                          'id'=>'countryCode',
                                                          'style'=>'width:100px;',
                                                          'ajax'=>array(
                                                              'type'=>'POST',
                                                              'url'=>CController::createUrl('major/calc'),
                                                              'update'=>'#russianpost_block',)
                                            )); 
            else
                echo $form->dropDownList($model,'id_country',$country,array('name'=>'countryCode',
                                                          'id'=>'countryCode',
                                                          'style'=>'width:100px;')
                                            ); 
            ?>
        </div>
        </form>
        <form action="#" method="post">
        <div id="chunk">
            <label>Регион: </label><br>
            <?php echo $form->dropDownList($model,'id_region',$region,array('name'=>'id_region',
                                                          'id'=>'regionCode',
                                                          'style'=>'width:160px;',
                                                          'ajax'=>array(
                                                              'type'=>'POST',
                                                              'url'=>CController::createUrl('major/calc'),
                                                              'update'=>'#russianpost_block',)
                                            )); ?>
        </div>
        </form>
        <form action="#" method="post">
        <div id="chunk">
            <label>Город*: </label><br>
            <? 
            $this->widget('CAutoComplete',
                array(
                    'model'=>'City',
                    'name'=>'Calc[city]',
                    'value'=>$city_name,
                    'url'=>array('city/search','id_region'=>$model->id_region),
                    'minChars'=>2,
                    'htmlOptions'=>array('style'=>'width:140px;'),
                    'max'=>100,
                )
            );
            ?>
        </div>
        <div id="chunk">
            <label>Улица, дом, кв*: </label><br>
            <?php echo $form->textField($model,'address',array('name'=>'Calc[address]','id'=>'address','style'=>'width:180px;')); ?>
        </div>
    <div style="clear:both;width:10px;">&nbsp;</div>        
        
            <div style="clear:both;">
                <?= CCHtml::ajaxSubmitButton("Рассчитать", array('major/calc'),array("update"=>"#itog"),array('id'=>'cal_major','name'=>'calc_major','style'=>"clear:both;margin-left:5px;margin-top: 10px;font-size: 12px;width:auto;",
                                'class'=>'button button-blue',))?>
            </div>
        </form>
        <br>
    <?php $this->endWidget(); ?>
<script type="text/javascript">
   $(document).ready(function() {
         delivery_select('major','russianpost');
	 delivery_select('major','samovyvoz');
   });
</script>