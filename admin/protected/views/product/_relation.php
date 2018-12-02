<?php  
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relation-search',
        'ajaxUrl'=>array('product/ProductList'),
	'dataProvider'=>ProductLang::model()->search($id),
	'filter'=>ProductLang::model()->with('product'),
        'summaryText'=> '<b>Выберите продукт</b>',
	'columns'=>array(
                array(     
                    'header'=>'ID',
                    'type' => 'raw',
                    'value'=>'$data->id_prod',
                    'filter'=>CHtml::textField('Relation[id_prod]'),
                ),
                array(     
                    'header'=>'Название',
                    'type' => 'raw',
                    'value'=>'$data->name',
                    'filter'=>CHtml::textField('Relation[name]'),
                ),
                array(     
                    'header'=>'Артикул',
                    'type' => 'raw',
                    'value'=>'$data->product->articul',
                    'filter'=>CHtml::textField('Relation[articul]'),
                ),
               
                array(            
                    'header'=>'Добавить',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/add.png"),
                                              Yii::app()->createUrl("productRelation/create",array("id_prod"=>'.$id.',"id_rel"=>$data->id_prod)),
                                                  array("update"=>"#res_relation"),
                                                  array("id"=>"a".$data->id_prod))',
                    'filter'=>CHtml::hiddenField('id',$id),
                 )
               
               
        ))); 
?>
<div id="res_relation"> 
    <?php
        Yii::app()->runController('productRelation',array('id'=>$id));
    ?>
</div>
