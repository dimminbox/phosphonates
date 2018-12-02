<div style="clear:both;"></div>
<div id="samovyvoz">
  <?=Yii::t('main','samovyvoz')?>
</div>
<script type="text/javascript">
   $(document).ready(function() {
         delivery_select('samovyvoz','russianpost');
	 delivery_select('samovyvoz','major');
	 $("#samovyvozitog").trigger('click');
   });
</script>