<div class="container sectionContent">
        <div class="row">
          <div class="col-sm-12">
 <div id="news">
                <h2><?=Yii::t('main','Advice');?></h2><br>
		<? foreach ($advice as $adv) :?>
		  <div class="article">
                        <strong><h2><?=$adv->advice_lang->name?></h2></strong>
                            <p class="news_content">
                                 <?=mb_substr(strip_tags($adv->advice_lang->content),0,1500);?>
                                 <span style="padding-left : 10px;"> 
                                     <a href="<?=Yii::app()->createUrl('advice/view',array('id'=>$adv->id))?>"><b>Подробнее</b></a> 
                                 </span>
                  </p>      </p>  
                        </div>
		<? endforeach; ?>
</div>
</div>
</div>
</div>