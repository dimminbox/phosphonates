<? 
echo CHtml::hiddenField('url_'.$product['id'],$product['url']);
echo CHtml::hiddenField('picture_'.$product['id'],$product['picture']);
echo CHtml::hiddenField('title_'.$product['id'],$product['title']);
echo CHtml::hiddenField('price_'.$product['id'],$product['price']);
?>

<div style="clear:both;float:left;">
    <? echo CHtml::image($this->image_ozon.$product['picture'].'.jpg','',array('width' =>'100px;'))?>
</div>
<div style="float:left;padding-left:10px;">
    <h2><?=$product['title']?></h2>
    <div style="clear:both">Ссылка: <?=$product['url']?></div>
    <div style="clear:both">Цена: <?=$product['price']?></div>
</div>
<div style="clear:both"></div>
