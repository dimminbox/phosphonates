<?php echo $this->renderPartial('_form', 
                                array(
                                      'model'=>$model,
                                      'prod_lang' => $prod_lang,
                                      'prod_attr' => $prod_attr,
                                      'prod_video' => $prod_video,
                                      'image' => $image,
                                      'action' => $action,
                                      'language'=>$language,
                                      'list_cat'=>$list_cat,
                                      'list_file' => $list_file,
                                      'list_video' => $list_video,
                                      'file' => $file,
                                      'hide_dropdown_prefix'=>1,
                                      
                                     )
                                ); ?>