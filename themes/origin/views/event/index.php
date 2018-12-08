<div class="container sectionContent">
        <div class="row">
          <div class="col-sm-12">
<div id="event_page">
    <?php foreach ($events as $event):?> 
      <? if (isset($event->event_lang[0])) :?>
	<div class="event">
	    <div class="date"><?=$event->event_lang[0]->date_congress;?></div>
	    <div class="ev_content"><?=CCHtml::link($event->event_lang[0]->short_content,array('/event/event-'.$event->id));?></div>
	    <div class="date"><?=$event->event_lang[0]->city;?></div>
	</div>
      <? endif; ?>
    <? endforeach; ?>
</div>
</div>
</div>
</div>