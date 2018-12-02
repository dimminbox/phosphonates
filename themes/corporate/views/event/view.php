<?php if (isset($event->event_lang)): ?>
<div style="margin: 10px 0px 0px -25px;">
<h1><?=$event->event_lang[0]->name ?></h1>
<div class="text">
  <?=$event->event_lang[0]->content?>
</div>		
</div>  
<?php endif; ?>