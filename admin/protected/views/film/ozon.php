<?php
foreach($products as $index=>$product){
   $data[$product['id']] = $this->renderPartial('product',array('product'=>$product),true);
}
echo CHtml::checkBoxList('selected_product',$selected,$data);
?>
