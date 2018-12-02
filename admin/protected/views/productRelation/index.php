<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'relation-grid',
        'ajaxUrl'=>array('ProductList'),
	'dataProvider'=>  ProductRelation::model()->search($id),
        'summaryText'=> '<b>Список связанных продуктов</b>',
	'columns'=>array(
                array(     
                    'header' => 'ID',
                    'type' => 'raw',
                    'value'=>'$data->id_prod_rel',
                ),
                array(     
                    'header' => 'Name',
                    'type' => 'raw',
                    'value'=>'$data->prod_rel_2->name',
                ),
                array(            
                    'header'=>'Удалить',
                    'type' => 'raw',
                    'value'=>'CHtml::ajaxLink(CHtml::image("/admin1/images/delete.png"),
                                              Yii::app()->createUrl("productRelation/delete",array("id_prod"=>$data->id_prod,"id_prod_rel"=>$data->id_prod_rel)), 
                                                                    array("update"=>"#res_relation","liveEvents"=>"true" ),array("id"=>"p".$data->id_prod."r".$data->id_prod_rel))',
                 ),
        ))); 

?>