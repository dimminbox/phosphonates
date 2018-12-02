
<? 
if (Yii::app()->params['table_suffix']==''){
   if (Yii::app()->params['lang']=='ru'){?>
    <div class="row" style="text-align: center;">
    <? echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl."/image/ru_f.png"),
	  array(Yii::app()->getRequest()->getUrl()));?>
    
     <?echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl."/image/en_f.png"),
	  array(Yii::app()->getRequest()->getUrl()."/lang/en"));?>
    </div>
     
    <?}else{  
    $href_ru = str_replace('/lang/en','',Yii::app()->getRequest()->getUrl());
    if ($href_ru=='') $href_ru = '/';
     echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl."/image/ru_f.png"),$href_ru);
     echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl."/image/en_f.png"),
    array(Yii::app()->getRequest()->getUrl()));
     
    }
}?>
