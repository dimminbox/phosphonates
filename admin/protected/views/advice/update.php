

<div class="section">

    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
            <span class="title_wrapper_top"></span>
            <div class="title_wrapper_inner">
                    <span class="title_wrapper_middle"></span>
                    <div class="title_wrapper_content">
                            <h2>Обновить статью</h2>
                    </div>
            </div>

    </div>

    <div class="section_content">

            <div class="section_content_inner">
                    <div>
                        <div>
                         <?php echo $this->renderPartial('_form', array(
                                                'model'=>$model, 
                                                'advice_lang' => $advice_lang, 
                                                'prefix'=>$prefix, 
                                                'action' => $action,
                                                'language'=>$language,
                                                'form' => $form,
                                                'list_cat' => $list_cat,
                                                'list_prod' => $list_prod)
                                ); 
?>
                        </div>
                    </div>

            </div>
     <span class="section_content_bottom"></span>
    </div>
</div>