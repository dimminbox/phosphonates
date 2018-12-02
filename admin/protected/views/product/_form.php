<!--<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'language-form',
	'enableAjaxValidation'=>false,
        'method'=>'get',
        'action'=>$action,

));?>
<div>
    <?php 
        echo $form->dropDownList($language,'name',CHtml::listData(Language::model()->findAll(),'code','name'),
                                array('name'=>'language','onChange'=>'this.form.submit();')); 
    ?>
</div>
<br>
<?php $this->endWidget(); ?>
-->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attr',
	'enableAjaxValidation'=>false,
        'method'=>'get',
        'action'=>'#',

)); ?>
<?php $this->endWidget(); ?>
<br>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create-form',
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

<?     
$tabs = array(
        'Общее'=>array('content' => $this->renderPartial('_general',
                                      array(
                                            'model'=>$model,
                                            'list_cat'=>$list_cat,
                                            'prod_lang' => $prod_lang,
                                            'form' => $form,
                                           ),
                                      true),
                        'id'=> 'general'),
       /*'Изображения'=>array('content' => $this->renderPartial('_image',
                                      array(
                                            'image' => $image,
                                            'model'=>$model,
                                            'form' => $form,
                                            ),
                                      true),
                        'id'=> 'image1'),
    
        'Файлы'=>array('content' => $this->renderPartial('_file',
                                       array(
                                            'list_file' => $list_file,
                                            'file' => $file,
                                            'form' => $form,
                                           ),
                                      true),
                        'id'=> 'file'),
        'Видео'=>array('content' => $this->renderPartial('_video',
                                       array(
                                            'list_video' => $list_video,
                                            'prod_video' => $prod_video,
                                            'form' => $form,
                                           ),
                                      true),
                        'id'=> 'video'),*/
);
   

/*if ($this->getAction()->getId()=='update')
    $tabs['Связанные товары'] = array('content' => $this->actionProductList($model->id),'id'=> 'relation');
*/

$count = 0;
foreach ($prod_attr as $index=>$group){
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
}
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
                        <h2>Продукт:</h2>
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