<div class="section">

    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
            <span class="title_wrapper_top"></span>
            <div class="title_wrapper_inner">
                    <span class="title_wrapper_middle"></span>
                    <div class="title_wrapper_content">
                            <h2>Обновить новость</h2>
                    </div>
            </div>

    </div>

    <div class="section_content">

            <div class="section_content_inner">
                    <div>
                        <div>
                           <?php echo $this->renderPartial('_form', array('model'=>$model,'news_lang' => $news_lang, 'action' => $action,'language'=>$language)); ?>
                        </div>
                    </div>

            </div>
     <span class="section_content_bottom"></span>
    </div>
</div>