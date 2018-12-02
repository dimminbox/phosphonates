<div class="section">

    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
            <span class="title_wrapper_top"></span>
            <div class="title_wrapper_inner">
                    <span class="title_wrapper_middle"></span>
                    <div class="title_wrapper_content">
                            <h2>Список сертификатов</h2>
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
                        <a class="update" href="<?=Yii::app()->controller->createUrl("create",array()); ?>"><span><span><em>Добавить сертификат</em><strong></strong></span></span></a>
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
				    'id'=>'file-grid',
				    'dataProvider'=>$model->search(),
				    'filter'=>$model,
				    'summaryText' => '',
                                    'htmlOptions' => array('cellspacing'=>0 , 'cellpadding' => 0,'class' => ''),
				    'columns'=>array(
					    'id',
					    array(
						'name' => 'name',
						'type' => 'html',
						'value' => 'CHtml::link($data->name,Yii::app()->params["absolute_path_files"].$data->name);'
					    ),
					    'title',
					    'size',
					    'ext',
					    'date_added',
					    /*
					    'date_modified',
					    */
					    array(
                                                 'class'=>'CButtonColumn',
                                                 'header' => 'Действия',
                                                 'template' => '{_update}',
                                                 'buttons' => array(
                                                    '_view' => array(
                                                        'label'=>'Просмотреть',
                                                        'url'=>'yii::app()->controller->createUrl("update",array("id"=>$data->id))',
                                                        'imageUrl'=>'',
                                                        'options'=>array('class'=>'details'),
                                                        'visible'=>'1',
                                                    ),
                                                    '_update' => array(
                                                        'label'=>'Редактировать',
                                                        'url'=>'yii::app()->controller->createUrl("update",array("id"=>$data->id))',
                                                        'imageUrl'=>'',
                                                        'options'=>array('class'=>'edit'),
                                                        'visible'=>'1',
                                                    ),
                                                    '_delete' => array(
                                                        'label'=>'Удалить',
                                                        'url'=>'yii::app()->controller->createUrl("delete",array("id"=>$data->id))',
                                                        'imageUrl'=>'',
                                                        'options'=>array('class'=>'delete'),
                                                        'visible'=>'1',
                                                    )
                                             )),
				    ),
			    ));?><br>
                            </div>
                    </div>
                    <!--[if !IE]>end table_wrapper<![endif]-->

            </div>
            <span class="section_content_bottom"></span>
    </div>
    <!--[if !IE]>end section content<![endif]-->
</div>