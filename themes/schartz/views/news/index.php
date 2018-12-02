 <div id="news">
                <h2><p><?=Yii::t('main','News');?></p></h2>
		<? foreach ($news as $new) :?>
		  <div class="news_1">
                        <h2 class="date"><?=$new->news_lang[0]->name?></h2>
                            <span class="news_content">
                                 <?=$new->news_lang[0]->content;?>
                            </span>
                        </div>
		<? endforeach; ?>
      </div>