<?php

class AdviceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

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
				'actions'=>array('index','view','viewCategory','viewProduct'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($language='ru')
	{   
                $action = Yii::app()->urlManager->createUrl('advice/create');
                $lang = new Language;
                $lang->name = $language;
                $prefix = Preference::model();
		$model = new Advice;
                $advice_lang = new AdviceLang;
                
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;

		if(isset($_POST['Advice']))
		{
			$model->attributes=$_POST['Advice'];
                        $model->date_added = date('Y-m-d H:i:s');
                        $model->date_modified = date('Y-m-d H:i:s');
                        
                        $advice_lang->attributes=$_POST['AdviceLang'];
                        $advice_lang->id_lang = $id_lang;
                        $advice_lang->id_advice = 0;
                        if ($_FILES['Advice']['name']['image']!=''){
                            $upload = CUploadedFile::getInstance($model, 'image');
                            $model->image = Translite::rusencode($advice_lang->name).'.'.$upload->getExtensionName(); 
                            $upload->saveAs(Yii::app()->params['image_advice'].$model->image);
                        }
                        
                        if (($advice_lang->validate())&&($model->validate()))
                            if($model->save())
                                    $this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
                        'advice_lang' => $advice_lang,
                        'action' => $action,
                        'prefix' => $prefix,
                        'language' => $lang
		));
	}
        
        public function actionViewCategory($id_prefix,$language='ru'){
          $list_cat = array();
          $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
          
          $list_cat = $this->relationCategory($id_prefix,$id_lang);
          
          $this->renderPartial('_category',
                                      array(
                                            'list_cat' => $list_cat,
                                            'model'=>  Product::model(),
                                            'advice_lang' => AdviceLang::model(), 
                                            ));          
        }
        
        public function actionViewProduct(){
         $list_prod = array();
         if (isset($_GET['Advice']['category']))
            $list_prod = $this->relationProduct($_GET['Advice']['category']);
          
         $this->renderPartial('_product',
                                      array(
                                            'list_prod' => $list_prod,
                                            'model'=>  Product::model(),
                                            'advice_lang' => AdviceLang::model(), 
                                            ));
        }
        
        public function relationCategory($id_prefix,$id_lang){
          
          $list_cat = array();
          
          $all_categories = Category::model()->with(array('cat_language'=>array('condition'=>"id_lang=$id_lang")))->findAllByAttributes(array('prefix'=>$id_prefix));
          foreach ($all_categories as $cat){
              $list_cat[$cat->id]=$cat->cat_language[0]->name;
          }
          
          return $list_cat;
          
        }
         public function relationProduct($advice_lang){
          
          $list_prod = array();
          if (is_object($advice_lang))
              foreach ($advice_lang->advice_cat as $_advice_lang){
                  $all = Category::model()->with('products.prod_lang')->findAllByAttributes(array('id'=>$_advice_lang->id_cat));

                  foreach ($all as $_category){
                    foreach ($_category->products as $_product){
                        $list_prod[$_product->id] = $_product->articul.' '.$_product->prod_lang[0]->name;
                    }
                  }
              }
          else
              foreach ($advice_lang as $_advice_lang){
                  $all = Category::model()->with('products.prod_lang')->findAllByAttributes(array('id'=>$_advice_lang));

                  foreach ($all as $_category){
                    foreach ($_category->products as $_product){
                        $list_prod[$_product->id] = $_product->articul.' '.$_product->prod_lang[0]->name;
                    }
                  }
              }
              
          return $list_prod;
          
        }
	public function actionUpdate($id,$language='ru')
	{       
                $action = Yii::app()->urlManager->createUrl('advice/update',array('id'=>$id));
                $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
		$model=$this->loadModel($id);
                $prefix = Preference::model()->findByAttributes(array('id'=>$model->id_prefix));
                
                $advice_lang = new AdviceLang();
                $_advice_lang = AdviceLang::model()->with('advice_cat')->findByAttributes(array('id_advice'=>$id,'id_lang'=>$id_lang));
                
                $advice_lang->attributes = (isset($_advice_lang->attributes)) ? $_advice_lang->attributes : array('id_advice'=>0,'id_lang'=>$id_lang);
                
                if (isset($_advice_lang)){
                    $advice_lang = $_advice_lang;
                }
                //$advice_lang = (isset($_advice_lang)) ? $_advice_lang : array('id_advice'=>0,'id_lang'=>$id_lang);
                
                $lang = new Language;
                $lang->name = $language;
                
		if(isset($_POST['Advice']))
		{
                    
                        $model->attributes=$_POST['Advice'];
                        $model->date_modified = date('Y-m-d H:i:s');
                        
			$advice_lang->attributes=$_POST['AdviceLang'];
                        $advice_lang->id_lang = $id_lang;
                        $advice_lang->id_advice = 0;
                        if ($_FILES['Advice']['name']['image']!=''){
                            $upload = CUploadedFile::getInstance($model, 'image');
                            $model->image = Translite::rusencode($advice_lang->name).'.'.$upload->getExtensionName(); 
                            
                            $upload->saveAs(Yii::app()->params['image_advice'].$model->image);
                        }
                        
                        if (($advice_lang->validate())&&($model->validate()))
                                $model->save();
                            if($model->save()) {
                                    //опубликовано в категориях
                                    AdviceCategory::model()->deleteAllByAttributes(array('id_advice'=>$id));
                                    if (isset($_POST['Advice']['category']))
                                        foreach ($_POST['Advice']['category'] as $id_cat){
                                            $adviceCategory = new AdviceCategory();
                                            $adviceCategory->id_advice = $id;
                                            $adviceCategory->id_cat = $id_cat;
                                            $adviceCategory->save();
                                        }
                                    //опубликовано в продуктах
                                    AdviceProduct::model()->deleteAllByAttributes(array('id_advice'=>$id));    
                                    
                                    if (isset($_POST['Advice']['product']))
                                        foreach ($_POST['Advice']['product'] as $id_prod){
                                            $adviceProduct = new AdviceProduct();
                                            $adviceProduct->id_advice = $id;
                                            $adviceProduct->id_prod = $id_prod;
                                            $adviceProduct->save();
                                        }
                                        
                                    $this->redirect(array('admin'));
                            }
		}
		$this->render('update',array(
			'model'=>$model,
                        'advice_lang' => $advice_lang,
                        'action' => $action,
                        'language' => $lang,
                        'prefix' => $prefix,
                        'list_cat' => $this->relationCategory($model->id_prefix,$id_lang),
                        'list_prod' => $this->relationProduct($advice_lang)
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $this->loadModel($id)->delete();
            
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Advice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Advice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Advice']))
			$model->attributes=$_GET['Advice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Advice::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
