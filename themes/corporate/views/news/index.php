 <div id="news">
                <h1><?=Yii::t('main','News');?></h1>
		<? foreach ($news as $new) :?>
		  <div class="news_1">
                        <h3 class="date"><?=$new->news_lang[0]->name?></h3>
                            <span class="news_content">
                                 <?=$new->news_lang[0]->content;?>
                            </span>
                  </div>
		<? endforeach; ?>
      </div>