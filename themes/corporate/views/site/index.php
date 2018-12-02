<div>
    <p><strong>Новости фосфонатов</strong></p>
		<? foreach ($news as $new) :?>
		  <div class="news_1">
                        <h3 class="date"><?=$new->news_lang[0]->name?></h3>
                            <div style="width:100%;">
			      <?=strip_tags(mb_substr($new->news_lang[0]->content,0,300));?>...
			    </div>
                  </div>
		<? endforeach; ?>
		<div style="margin-top: 15px;"><a href="/news"><b>Новости подробнее </b></a></div>
</div>

<?php echo Yii::app()->runController('/event/view/id/2'); ?>