<div class="row">
<?php echo CActiveForm::labelEx($model,'name'); ?>
<?php 

$selectedValues = array();
foreach ($advice_lang->advice_cat as $_cat){
    $selectedValues[$_cat->id_cat] = array ( 'selected' => 'selected' );
}

echo CActiveForm::dropDownList($model,'id',$list_cat,
                                    array(
                                          'name'=>'Advice[category]',
                                          'multiple'=>1,
                                          'size'=>'15',
                                          'options' => $selectedValues,
                                          'ajax'=>array('type'=>'GET','url'=>CController::createUrl('/advice/viewproduct'),'update' => '#product')
                                        )); 
?>

</div>