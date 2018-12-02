<? if (isset($comp)): ?>
<div id="head">
    <div class="box_title"><?=Yii::t('main','Comparasion')?></div>
</div>
<div id="body1">
<? 
$this->widget('zii.widgets.grid.CGridView', array(
    'cssFile' =>Yii::app()->theme->baseUrl.'/css/form.css',
    'dataProvider'=>$comp,
    'hideHeader'=>true,
    'summaryText'=>'',
    'columns'=>array(
        array(
            'type'=>'raw',
            'name'=>'name',
            'value'=>'"<b>".$data->prod[0]->articul."</b> . ".$data->prod[0]->prod_lang[0]->name;',
        ),
        array(           
            'name'=>'111',
            'type'=>'raw',
            /*'value'=>'CHtml::ajaxlink(CHtml::image(Yii::app()->theme->baseUrl.Yii::app()->params["images"]."close_but.gif"),
                                              array("delcompare","id"=>$data->prod[0]->id),
                                              array("update"=>"#compare_list"),array("id"=>"rem_".$data->prod[0]->id))',*/
            'value'=>'CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.Yii::app()->params["images"]."close_but.gif"),"#",array("id"=>"rem_".$data->prod[0]->id))',
        ),
        array( 
            'name'=>'',
            'type'=>'raw',
            'value'=>'"<script type=\"text/javascript\">
                        jQuery(\'body\').undelegate(\'#rem_".$data->prod[0]->id."\',\'click\').delegate(\'#rem_".$data->prod[0]->id."\',\'click\',function(){jQuery.ajax({\'url\':\'/product/delcompare/".$data->prod[0]->id."\',\'cache\':false,\'success\':function(html){jQuery(\"#compare_list\").html(html)}});return false;});</script>"',
        ),
        
    ),
));
?>
</div>
<? endif;?>
<script type="text/javascript">
    hidrst(<?=$count?>)
</script>