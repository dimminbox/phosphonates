<div>
<?     
$tabs = array(
        'Общее'=>array('content' => $this->renderPartial('_form',
                                      array(
                                            'model'=>$model, 
                                            'advice_lang' => $advice_lang, 
                                            'action' => $action,
                                            'form' => $form,
                                           ),
                                      true),
                        'id'=> 'general'),
       'Связь с разделами'=>array('content' => $this->renderPartial('_category',
                                      array(
                                            'list_cat' => $list_cat,
                                            'model'=> $model,
                                            'advice_lang' => $advice_lang, 
                                            ),
                                      true),
                        'id'=> 'category'),    
       'Связь с товарами'=>array('content' => $this->renderPartial('_product',
                                      array(
                                            'list_prod' => $list_prod,
                                            'model'=> $model,
                                            'advice_lang' => $advice_lang, 
                                            ),
                                      true),
                        'id'=> 'product'),
);
   
  
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>$tabs,
    'options'=>array(
        'collapsible'=>true,
    ),
));
?>
</div>