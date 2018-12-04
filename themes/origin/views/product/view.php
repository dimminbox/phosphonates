<div class="container sectionContent">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title"><?=$product[0]->name; ?></h1>
            <div class="mb5">
            <?php foreach ($product[0]->product->prod_attr as $_index=>$attr):?>
                <?php if ((isset($attr->attr_label))&&($attr->value!='')) :?>
                    <p><span class="bold"><?=$attr->attr_label->name;?>:</span>	<?=$attr->value;?></p>
                <?php endif; ?>
            <? endforeach; ?>
            </div>
            <div class="extra_desc" style="margin-top: 20px;">
                <?=$product[0]->extra_text?>
                <??>
                <a href="/files/<?=$product[0]->product->file?>" class="downloadLink">
                    <img src="<?=Yii::app()->theme->baseUrl?>/images/pdf-download.png">
                    <p>Скачать</p>
                </a>
            </div>
          </div>
        </div>
      </div>