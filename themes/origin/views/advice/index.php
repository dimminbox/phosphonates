<div class="container sectionContent">
        <div class="row">
          <div class="col-sm-12">
 <div id="news">
                <h3 style="margin-top: 10px;"><?=Yii::t('main','Advice');?></h3>
		<? foreach ($advice as $index=>$adv) :?>
		  <div class="article" style="margin: 30px 0px;">
                        <strong><h3><a href="<?=Yii::app()->createUrl('advice/view',array('id'=>$adv->id))?>"><?=$index+1?>.<?=$adv->advice_lang->name?></a></h3></strong>
                            
                                 <?=mb_substr(strip_tags($adv->advice_lang->content),0,1500);?>
                                 <p style="padding-top : 10px;"> 
                                     <a href="<?=Yii::app()->createUrl('advice/view',array('id'=>$adv->id))?>"><b>Подробнее</b></a> 
                                 </p>
                  </p>      
                        </div>
		<? endforeach; ?>
</div>
</div>
</div>
</div>