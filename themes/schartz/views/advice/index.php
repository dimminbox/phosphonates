 <div id="news">
                <h2><p><?=Yii::t('main','Advice');?></p></h2>
		<? foreach ($advice as $adv) :?>
		  <div class="news_1">
                        <strong><span class="date"><?=$adv->advice_lang->name?></span></strong>
                            <span class="news_content">
                                 <?=mb_substr(strip_tags($adv->advice_lang->content),0,1500);?>
                            </span>
			    <div style="padding-top: 10px;"> <a href="<?=Yii::app()->createUrl('advice/view',array('id'=>$adv->id))?>"><b>Подробнее</b></a> </div>
                        </div>
		<? endforeach; ?>
      </div>