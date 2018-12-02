<?php

class CategoryController extends Controller
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
				'actions'=>array('index','view'),
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
                $action = Yii::app()->urlManager->createUrl('category/create');
		$model=new Category;
                $model->parent = 0;
                $cat_lang = new CategoryLang;
                $lang = new Language;
                $lang->name = $language;
		
                $cat_attr = array();
                
		if(isset($_POST['Category']))
		{
			$model->attributes = $_POST['Category'];
                        $model->parent = $_POST['Category']['parent'];
                        $model->attributes = $_FILES['Category']['name'];
                        if ($model->url==''){
                        $model->url = Translite::rusencode($_POST['CategoryLang']['name']);
                        }
                        $cat_lang->attributes = $_POST['CategoryLang'];
                        $cat_lang->id_group = $_POST['CategoryLang']['id_group'][0];
                        
                        //fake values for validate
                        $cat_lang->id =0;$cat_lang->id_lang =0;
                        
                 
                        $model_valid = $model->validate();
                        if (($cat_lang->validate())&&($model_valid)){
                            $upload = CUploadedFile::getInstance($model, 'image');
                            if (isset($upload)) {
                                $model->image = Translite::rusencode($cat_lang->name).'.'.$upload->getExtensionName(); 
                                $upload->saveAs(Yii::app()->params['image_categories'].$model->image);
                            }
                            $model->save();
                        }
		}
                $list_cat[0] = '.';
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;
                $all_categories = CategoryLang::model()->findAll(array('condition'=>"id_lang=$id_lang"));
                foreach ($all_categories as $cat){
                   $list_cat[$cat->id]=$cat->name;
                }
                  
                //группы разделов
                $group_cat[0] = '.';
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;
                $all_groups = CategoryGroup::model()->findAllByAttributes(array('id_lang'=>$id_lang));
                
                foreach ($all_groups as $_group_cat){
                   $group_cat[$_group_cat->id_group]=$_group_cat->name;
                }
                
                //аттрибуты категорий
                foreach (Attribute::model()->with(array('set.prefix'=>array('condition'=>'prefix.name="prefix_all"')))
                        ->findAllByAttributes(array('id_lang'=>$id_lang)) as $attr){
                    
                    $cat_attr[$attr->set->title][] = array('name'=> $attr->name,
                                                           'value'=>'','id'=>$attr->id,
                                                           'memo' => $attr->memo) ;
                }
                
                $prefix = Preference::model();
                
		$this->render('create',array(
			'model'=>$model,
                        'cat_lang' => $cat_lang,
                        'language' => $lang,
                        'list_cat' => $list_cat,
                        'action' => $action,
                        'cat_attr' => $cat_attr,
                        'prefix' => $prefix,
                        'group_cat' => $group_cat,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$language='ru')
	{
                $action = Yii::app()->urlManager->createUrl('category/update',array('id'=>$id));
                $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
		$model = $this->loadModel($id);
                
                $cat_lang = new CategoryLang();
                $attributes = CategoryLang::model()->findByAttributes(array('id'=>$id,'id_lang'=>$id_lang));
                $cat_lang->attributes = (isset($attributes->attributes)) ? $attributes->attributes : array('id'=>0,'id_lang'=>$id_lang);
                
                $lang = new Language;
                $lang->name = $language;
		
                //аттрибуты
                foreach (Attribute::model()->with(array('set.prefix'=>array('condition'=>'prefix.name="prefix_all"')))->findAllByAttributes(array('id_lang'=>$id_lang)) as $attr){
                    
                    $attr_value = AttributeCategory::model()->with('attr_label')->findByAttributes(array('id_lang'=>$id_lang,'id_cat'=>$id,'id_attr'=>$attr->id));
                    $cat_attr[$attr->set->title][] = array('name'=> $attr->name,
                                         'value'=>(!empty($attr_value->attr_label)) ? $attr_value->value : '',
                                         'memo' => $attr->memo,
                                         'id'=>$attr->id) ;
                }
		if(isset($_POST['Category']))
		{
                        if ($model->url==''){
                            $model->url = Translite::rusencode($_POST['CategoryLang']['name']);
                        }
                        else
                            $model->url = $_POST['Category']['url'];
                        
                        $model->active = $_POST['Category']['active'];
                        $model->prefix = $_POST['Category']['prefix'];
                        $model->parent = $_POST['Category']['parent'];
                        
                        if ($_FILES['Category']['name']['image']!=''){
                            $model->image = $_FILES['Category']['name']['image'];
                        }
                        
                        $cat_lang->attributes = $_POST['CategoryLang'];
                        $cat_lang->id_group = $_POST['CategoryLang']['id_group'][0];
                        
                        $model_valid = $model->validate();
                        if (($cat_lang->validate())&&($model_valid)){
                            $upload = CUploadedFile::getInstance($model, 'image');
                            if (is_object($upload)){
                                 $model->image = Translite::rusencode($cat_lang->name).'.'.$upload->getExtensionName(); 
                                 $upload->saveAs(Yii::app()->params['image_categories'].$model->image);
                            }
                            $model->save();
                        }
		}
                
                //формируем список категорий
                $list_cat[0] = '.';
                $all_categories = CategoryLang::model()->findAll(array('condition'=>"id_lang=$id_lang"));
                foreach ($all_categories as $cat){
                   $list_cat[$cat->id]=$cat->name;
                }
                
                //группы разделов
                $group_cat[0] = '.';
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;
                $all_groups = CategoryGroup::model()->findAllByAttributes(array('id_lang'=>$id_lang));
                
                foreach ($all_groups as $_group_cat){
                   $group_cat[$_group_cat->id_group]=$_group_cat->name;
                }
                
                $prefix = Preference::model()->find(array(
                        'condition'=>'value=:value and name Like "%prefix_%"',
                        'params'=>array(':value'=>$model->prefix),
                ));
                
		$this->render('update',array(
			'model'=>$model,
                        'cat_lang' => $cat_lang,
                        'language' => $lang,
                        'list_cat' => $list_cat,
                        'action' => $action,
                        'cat_attr' => $cat_attr,
                        'prefix' => $prefix,
                        'group_cat' => $group_cat,
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
		CategoryLang::model()->findbyAttributes(array('id'=>$id))->delete();
		$this->redirect('admin');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

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
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
