<?php 
  $form=$this->beginWidget('CActiveForm', array(
        'id'=>'create-form',
        'htmlOptions' => array ('enctype'=>'multipart/form-data'),
        'enableAjaxValidation'=>false,)); 
  echo $form->errorSummary(array($model,$cat_lang));

$tabs['Общее'] = array('content' => $this->renderPartial('_general',
                                  array(
                                        'model'=>$model,
                                        'list_cat'=>$list_cat,
                                        'cat_lang' => $cat_lang,
                                        'form' => $form,
                                        'group_cat' => $group_cat,
					'language' => $language,
					'prefix' => $prefix,
                                       ),
                                  true),
                    'id'=> 'general');

/*$count = 0;
foreach ($cat_attr as $index=>$group){
$count++;
$tabs[$index] = array('content'=>$this->renderPartial('_attribute',
                                  array(
                                        'prod_attr' => $group,
                                        'form' => $form,
                                        'title' => $index,
                                       ),
                                  true),
                     'id'=> 'attrbutes'.$count);
$count++;
}*/


$this->widget('application.extensions.UltraJuiTabs', array(
    'tabs'=>$tabs,
    'options'=>array(
        'collapsible'=>true,
    ),
    'htmlOptions'=>array('id'=>'section'),
    'headerTemplate'=> '<li>
                            <a title="{url}" href="{url}">
                                <span class="l">
                                    <span></span>
                                </span>
                                <span class="m">
                                    <em>{title}</em>
                                    <span></span>
                                </span>
                                <span class="r">
                                    <span></span>
                                </span>
                            </a>
                        </li>',
    'wrap'=>'<div class="title_wrapper">
                <span class="title_wrapper_top"></span>
                <div class="title_wrapper_inner">
                    <span class="title_wrapper_middle"></span>
                    <div class="title_wrapper_content">
                        <h2>Раздел:</h2>
                        <ul class="section_menu left">{tabout}</ul>
                    </div>
                 </div>
                 <span class="title_wrapper_bottom"></span>
            </div>',
    'contentTemplate'=>'<div class="section_content" id="{id}">
                            <span class="section_content_top"></span>
                            <div class="section_content_inner">{content}</div>
                            <span class="section_content_bottom"></span>
                         </div>',
 ));

?>


<?php $this->endWidget(); ?>