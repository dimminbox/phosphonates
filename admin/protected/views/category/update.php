<?php echo $this->renderPartial('_form', 
                                        array(
                                                'model'=>$model,
                                                'cat_lang'=>$cat_lang,
                                                'language'=>$language,
                                                'list_cat'=>$list_cat,
                                                'action'=>$action,
                                                'cat_attr' => $cat_attr,
                                                'prefix' => $prefix,
                                                'group_cat' => $group_cat,
                                              )
                                ); 
?>