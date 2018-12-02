 <div id="news">
    <h2><?=Yii::t('main','Documents');?></h2>
    <?php foreach ($files as $file) :?>
      <p><?php echo CHtml::link($file->title,Yii::app()->params['file_path'].$file->name)?></p>
    <?php endforeach; ?>
</div>