<div class="row">
<?php echo CActiveForm::labelEx($model,'name'); ?>
<?php 

$selectedValues = array();
foreach ($advice_lang->advice_prod as $_prod){
    $selectedValues[$_prod->id_prod] = array ( 'selected' => 'selected' );
}

echo CHtml::dropDownList('Advice[product][]',$selectedValues,$list_prod, array('multiple'=>1,'size'=>'15')); 
?>

</div>