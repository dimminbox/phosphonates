<div class="section">
					
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
            <span class="title_wrapper_top"></span>
            <div class="title_wrapper_inner">
                    <span class="title_wrapper_middle"></span>
                    <div class="title_wrapper_content">
                            <h2>Список товаров</h2>
                    </div>
            </div>
            <span class="title_wrapper_bottom"></span>
    </div>
    <!--[if !IE]>end title wrapper<![endif]-->

    <!--[if !IE]>start section content<![endif]-->
    <div class="section_content">
            <span class="section_content_top"></span>

            <div class="section_content_inner">

                    <div class="table_tabs_menu">
                    
                    <a class="update" href="<?=Yii::app()->controller->createUrl("create",array()); ?>"><span><span><em>Добавить товар</em><strong></strong></span></span></a>
                    </div>

                    <div class="table_wrapper">
                            <div class="table_wrapper_inner">
                            <?php
                            $buttons = "<div class=\"actions_menu\">
                                                                <ul>
                                                                        <li><a href=\"#\" class=\"details\">Details</a></li>
                                                                        <li><a href=\"#\" class=\"edit\">Edit</a></li>
                                                                        <li><a href=\"#\" class=\"delete\">Delete</a></li>
                                                                </ul>
                                                               </div>";
                            $this->widget('zii.widgets.grid.CGridView', array(
                                        'id'=>'product-grid',
                                
                                        'pager' => array(
                                                        'class'=>'CLinkPager',
                                                        'header'=>false,
                                                        'cssFile'=>false,
                                                        'htmlOptions' => array('class'=>'pag_list'),
                                                        'nextPageLabel'=>'<div class="pag_nav"><span><span>Следующий</span></span></div>',
                                                        'prevPageLabel'=>'<div class="pag_nav"><span><span>Предидущий</span></span></div>'
                                                        
                                                        ),
                                
                                
                                        'dataProvider'=>$model->search($prefix),
                                        'filter'=>$model,
                                        'summaryText' => '',
                                
                                        'template'=>'{items}<div class="pagination_wrapper">
                                                    <span class="pagination_top"></span>
                                                    <div class="pagination_middle">
                                                    <div class="pagination">
                                                            {pager}
                                                    </div>
                                                    </div>
                                                    <span class="pagination_bottom"></span>
                                                    </div>',
                                
                                        'htmlOptions' => array('cellspacing'=>0 , 'cellpadding' => 0,'class' => ''),
                                
                                        'columns'=>array(
                                                'id',
                                                array(
                                                    'header'=> 'Название',
                                                    'type' => 'raw',
                                                    'value'=>'$data->prod_lang[0]->name',
						    'htmlOptions'=>array('width'=>'400px')
                                                ),
                                                'active',
                                                array(
                                                     'class'=>'CButtonColumn',
                                                     'header' => 'Действия',
                                                     'template' => '{_update}',
                                                     'buttons' => array(
                                                        '_view' => array(
                                                            'label'=>'Просмотреть',
                                                            'url'=>'yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
                                                            'imageUrl'=>'',
                                                            'options'=>array('class'=>'details'),
                                                            'visible'=>'1',
                                                        ),
                                                        '_update' => array(
                                                            'label'=>'Редактировать',
                                                            'url'=>'yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
                                                            'imageUrl'=>'',
                                                            'options'=>array('class'=>'edit'),
                                                            'visible'=>'1',
                                                        ),
                                                        '_delete' => array(
                                                            'label'=>'Удалить',
                                                            'url'=>'yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
                                                            'imageUrl'=>'',
                                                            'options'=>array('class'=>'delete'),
                                                            'visible'=>'1',
                                                        )
                                                      ),
                                                ),
                                        ),
                                )); ?><br>
                            </div>
                    </div>

            </div>
        <span class="section_content_bottom"></span>
    </div>
</div>