<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','import','attrtype','productList'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        public function actionImport()
	{
              $import = new sur_Import();
              print '<pre>';
             // print_r($import->result);
              $tree = array();
              $parent_cat=0;
              foreach ($import->result as $icat=>$category){
                  //if ($icat>2) break;
                  if (!empty($category)){
                      foreach ($category as $index=>$chunks){
                          if ($index!='products'){
                              //айдишник языка
                              $id_lang = Language::model()->findByAttributes(array('code'=>$index))->id;
                              //дерево категорий
                              foreach ($chunks as $ichunk => $chunk){
                                  $tree[$ichunk][$id_lang] = $chunk;
                              }
                          }
                          else{
                              //разбираемся с категориями
                              $parent_cat = $import->ParserCategory($tree,0);
                             
                              $tree = array();
                              
                              //подготовка массива продуктов
                              foreach ($chunks as $ichunk => $chunk){
                                 //if ($chunk['articul']=='V-0011T')
                                 
                                 $product = array();
                                 $product['articul'] = $chunk['articul'];
                                 
                                 $product['price'] = isset($chunk['price']) ? $chunk['price'] : 0;
                                 
                                 
                                  //названия продукта на разных языках
                                  foreach ($chunk['name'] as $iprd=>$prd){
                                      $id_lang = Language::model()->findByAttributes(array('code'=>$iprd))->id;
                                      $product['name'][$id_lang] = $prd;
                                  }
                                  //аттрибуты продукта на разных языках
                                  foreach ($chunk['attributes'] as $iprd=>$attrs){
                                      $id_lang = Language::model()->findByAttributes(array('code'=>$iprd))->id;
                                      
                                      foreach ($attrs as $attr=>$value){
                                          $attribute = Attribute::model()->find("id_lang=$id_lang and name='".trim($attr)."'");
                                          //массив аттрибутов и их айдишников
                                          if (!empty($attribute)){
                                              $attrs_id[$attr] = $attribute->id;
                                          }
                                          if (isset($attrs_id[$attr]))
                                            $product['attributes'][$id_lang][$attrs_id[$attr]] = $value;
                                          else
                                              print "Аттрибут <b>$attr</b> не найден в базе<br>";
                                      }
                                  }
                                  $attrs_id = array();
                                  $tree[] = $product;
                              }
                              
                              $import->AddProduct($parent_cat, $tree);
                              $tree = array();
                          }
                      }
                  }
              }
              print '</pre>';
	}
        
	protected function actionProductRelation($id){
            
            $relations = Product::model()->with('prod_rel')->findByAttributes(array('id'=>$id));
            return $relations; 
        }
        
        public function actionProductList($id){
                      
            $id_lang =  Language::model()->findByAttributes(array('code'=>'ru'))->id;
            if (isset($_GET['Relation'])) {                
                $model = ProductLang::model();
                $model->attributes = $_GET['Relation'];    
            }
            else {
                $model = ProductLang::model()->with(array('product'=>array('condition'=>'product.active=1')));
            }
            
            $model->id_lang = $id_lang;
            
            if ((isset($_GET['ajax']))&&($_GET['ajax']=='relation-search'))
                return $this->renderPartial('_relation',array('model'=> $model,'id'=>$id));
            else
                return $this->renderPartial('_relation',array('model'=> $model, 'id'=>$id),true);
        }
        
        public function actionAttrtype($id_prefix=1, $language='ru',$id_prod=0,$all=0){
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;
                $prod_attr = Array();
                //если нужны аттрибуты для префикса all
                if ($all==1) {
                    $attrs = Attribute::model()->with(array('set.prefix'=>
                                                        array('condition'=>'prefix.name="prefix_all"'))
                                                     )->findAllByAttributes(array('id_lang'=>$id_lang));
                    foreach ($attrs as $attr){
                        
                        $_prod_attr = array('name'=> $attr->name,
                                                                'value'=>'',
                                                                'id'=>$attr->id,
                                                                'memo' => $attr->memo,
                                                                'model'=>$attr);
                        if ($attr->dropdown_value!='') {
                            
                             $name_model = $attr->dropdown_value.'Lang';
                             $list_models = $name_model::model()->findAllByAttributes(array('id_lang'=>$id_lang));
                             $_models[0] = '';
                             
                             foreach ($list_models as $_model){
                                 $_models[$_model->id_offer] = $_model->name;
                             }
                             $_prod_attr['models'] = $_models;
                             
                        }
                        
                        $prod_attr[$attr->set->title][] = $_prod_attr;
                    }
                    return $prod_attr;
                }
                
                //если ныжны аттрибуты для определённого префикса
                foreach (Attribute::model()->with(array('set.prefix'=>array('condition'=>'prefix.id='.$id_prefix)))->
                                             findAllByAttributes(array('id_lang'=>$id_lang)) as $attr){
                        
                        $attr_value = AttributeValue::model()->findByAttributes(array('id_lang'=>$id_lang,'id_prod'=>$id_prod,'id_attr'=>$attr->id));
                        
                        $_prod_attr = array('name'=> $attr->name,
                                                                'value'=>(isset($attr_value->value)) ? $attr_value->value : '',
                                                                'memo' => $attr->memo,
                                                                'model'=>$attr,
                                                                'id'=>$attr->id);
                        if ($attr->dropdown_value!='') {
                             
                             $name_model = $attr->dropdown_value.'Lang';
                             $list_models = $name_model::model()->findAllByAttributes(array('id_lang'=>$id_lang));
                             $_models[0] = '';
                             foreach ($list_models as $_model){
                                 $_models[$_model->id_offer] = $_model->name;
                             }
                             $_prod_attr['models'] = $_models;
                        }
                        
                        $prod_attr[$attr->set->title][] = $_prod_attr;
                    }
                if (!Yii::app()->request->isAjaxRequest){
                    return $prod_attr;
                }
                else {
                    $prod_attr = array_shift($prod_attr);
                    return $this->renderPartial('_attribute',array('prod_attr' => $prod_attr,'title' => $attr->set->title));
                }
        }
        
	public function actionCreate($language='ru')
	{ 
		$model=new Product;
                
                $prod_lang = new ProductLang;
                
                $image = new Image();
                $image->id_prod = 0;
                $image->session_id = session_id();
                
                $num_arr_attr = '';
                $action = Yii::app()->urlManager->createUrl('product/create');
                
                //языковые параметры
                $lang = new Language;
                $lang->name = $language;
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;
		
                $prefix = Preference::model();
                
                //изображения
                //$images = Product::model()->with('prod_image')->findAllByAttributes(array('id_prod'=>))
                
		if(isset($_POST['Product']))
		{
                        $model->attributes = $_POST['Product'];
                        
                        //берём значения категорий, где должен быть этот продукт
                        if (!empty($_POST['Product']['parent']))
                            $model->parent = $_POST['Product']['parent'];
                        else
                            $model->parent = array();
                        //описание продукта
                        $prod_lang->attributes = $_POST['ProductLang'];

                        if ($_POST['Product']['url']=='')
                            $model->url =  Translite::rusencode ($prod_lang->name);
                        
                        //липовые значения специально для валидации
                        $prod_lang->id_prod =0;$prod_lang->id_lang =0;
                                                
                        //проверка на валидность моделей
                        $model_valid = $model->validate();
                        if (($prod_lang->validate())&&($model_valid)){
                            $model->save();
                        }
		}
                
                //массив категорий
                $list_cat = array();
                $list_cat[0] = 'Корень';
                $all_categories = CategoryLang::model()->findAll(array('condition'=>"id_lang=$id_lang"));
                foreach ($all_categories as $cat){
                   $list_cat[$cat->id]=$cat->name;
                }
                //массив для производителей
                $list_man = array();
                $list_man[0] = 'Корень';
                $all_man = ManufactureLang::model()->findAllbyAttributes(array('id_lang'=>$id_lang));
                foreach ($all_man as $_man){
                   $list_man[$_man->id_man]=$_man->name;
                }
                
                $categ = new Category();
                $categ->GetParent(0,0,$id_lang);
                $list_cat = $categ::$list_data;
                
                //модель для прикрепления файла
                $prod_file = new ProductFile();
                $prod_file->id_prod = 0;
                $prod_file->id_lang = $id_lang;
                $prod_file->active = 1;
                $prod_file->session_id = session_id();
                
                //массив для дропдуна файлов
                $list_file = array();
                $all_files = File::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_files as $file){
                   $list_file[$file->id]=$file->title;
                }
                
                //модель для прикрепления видеофайлов
                $prod_video = new ProductVideo();
                $prod_video->id_prod = 0;
                $prod_video->id_lang = $id_lang;
                $prod_video->active = 1;
                $prod_video->session_id = session_id();
                
                //массив для дропдуна видеофайлов
                $list_video = array();
                $all_files = Video::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_files as $video){
                   $list_video[$video->id]=$video->name;
                }
                
		$this->render('create',array(
			'model'=>$model,
                        'prod_lang' => $prod_lang,
                        'prod_attr' => $this->actionAttrtype(0,'ru',0,1),
                        'image' => $image,
                        'action' => $action,
                        'language' => $lang,
                        'list_cat' => $list_cat,
                        'list_file' => $list_file,
                        'list_video' => $list_video,
                        'list_man' => $list_man,
                        'file' => $prod_file,
                        'prod_video' => $prod_video,
                        'prefix' => $prefix,
                        'prod_attr_type' => $this->actionAttrtype(),
                            
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$language='ru')
	{
            
                $action = Yii::app()->urlManager->createUrl('product/update',array('id'=>$id));
                $image = new Image();
                $image->id_prod = $id;
                //$image->session_id = session_id();
                
                $prefix = Preference::model();
                //язык
                $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
		$lang = new Language;
                $lang->name = $language;
                
                //продукт
                $model = $this->loadModel($id);
                
                foreach (ProductCategory::model()->findAllByAttributes(array('id_prod'=>$id)) as $category){
                    $model->parent[] = $category->id_cat;
                }
                
                //описание продукта
                $prod_lang = new ProductLang();
                $attributes = ProductLang::model()->findByAttributes(array('id_prod'=>$id,'id_lang'=>$id_lang));
                $prod_lang->attributes = (isset($attributes->attributes)) ? $attributes->attributes : array('id_prod'=>0,'id_lang'=>$id_lang);
                
                
                //аттрибуты продукта
                $prod_attr = array();
                $groups = array();
                $_attrs = Attribute::model()->with(array('set.prefix'=>array('condition'=>'prefix.name like "%prefix_%" and prefix.name!="prefix_all"')))
                                            ->findByAttributes(array('id_lang'=>$id_lang));
                
                
                /*$prod_attr = $this->actionAttrtype($prefix_id,$language,$id);
                print '<pre>'; print_r($prod_attr); print '</pre>';*/
                foreach (Attribute::model()->with(array('set.prefix'=>array('condition'=>'prefix.name like "%prefix_%"')))->findAllByAttributes(array('id_lang'=>$id_lang)) as $attr){
                    
                    $attr_value = AttributeValue::model()->with('attr_label')->findByAttributes(array('id_lang'=>$id_lang,'id_prod'=>$id,'id_attr'=>$attr->id));
                    
                    
                    if ((isset($attr_value->attr_label))||(!in_array($attr->id,$groups))) {
                        //если это группа атрибутов для луп/биноклей
                        if ($attr->set->prefix->value!=0){
                             $prefix_id = $attr->set->prefix->value;
                             $prefix = $attr->set->prefix;
                        }
                        else {
                              
                              $_prod_attr = array('name'=> $attr->name,
                                         'value'=>(!empty($attr_value->attr_label)) ? $attr_value->value : '',
                                         'memo' => $attr->memo,
                                         'model'=>$attr,
                                         'id'=>$attr->id) ;
                              
                              if ($attr->dropdown_value!='') {
                                 $name_model = $attr->dropdown_value.'Lang';
                                 $list_models = $name_model::model()->findAllByAttributes(array('id_lang'=>$id_lang));
                                 $_models[0] = '';
                                 foreach ($list_models as $_model){
                                     $_models[$_model->id_offer] = $_model->name;
                                 }
                                 $_prod_attr['models'] = $_models;
                              }
                              $prod_attr[$attr->set->title][] = $_prod_attr;
                        }
                        
                        //добавление в массив групп на случай того если добавился новый аттрибут.
                        if (!in_array($attr->id,$groups)) 
                            $groups[] = $attr->id;
                    }
                    
                }
                
		if(isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];
                        if (!empty($_POST['Product']['parent']))
                            $model->parent = $_POST['Product']['parent'];
                        else
                            $model->parent = array();
                       /* if ($_FILES['Category']['name']['image']!=''){
                            $model->image = $_FILES['Category']['name']['image'];
                        }*/
                        $prod_lang->attributes = $_POST['ProductLang'];
                        if ($_POST['Product']['url']=='')
                            $model->url =  Translite::rusencode ($prod_lang->name);
                        
                        $model_valid = $model->validate();
                        if (($prod_lang->validate())&&($model_valid)){
                            $model->save();
                        }
		}
                
                //формируем список категорий
                $list_cat[0] = 'Корень';
                $all_categories = CategoryLang::model()->findAll(array('condition'=>"id_lang=$id_lang"));
                foreach ($all_categories as $cat){
                   $list_cat[$cat->id]=$cat->name;
                }
                
                $categ = new Category();
                $categ->GetParent(0,0,$id_lang);
                $list_cat = $categ::$list_data;
                
                //модель для прикрепления файла
                $prod_file = new ProductFile();
                $prod_file->id_prod = $id;
                $prod_file->id_lang = $id_lang;
                $prod_file->active = 1;
                
                //массив для дропдуна файлов
                $list_file = array();
                $all_files = File::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_files as $file){
                   $list_file[$file->id]=$file->title;
                }
                
                //модель для прикрепления видеофайлов
                $prod_video = new ProductVideo();
                $prod_video->id_prod = $id;
                $prod_video->id_lang = $id_lang;
                $prod_video->active = 1;
                
                
                //массив для дропдуна видеофайлов
                $list_video = array();
                $all_files = Video::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_files as $video){
                   $list_video[$video->id]=$video->name;
                }
                
		$this->render('update',array(
			'model'=>$model,
                        'prod_lang' => $prod_lang,
                        'prod_attr' => $prod_attr,
                        'prod_video' => $prod_video,
                        'language' => $lang,
                        'image' => $image,
                        'list_cat' => $list_cat,
                        'action' => $action,
                        'list_file' => $list_file,
                        'list_video' => $list_video,
                        'file' => $prod_file,
                        
		));
        
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($prefix='')
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
                        'prefix' => $prefix,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
