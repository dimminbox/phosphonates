<?php

class ProductFileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	public function actionCreate($id_prod,$id_lang)
	{
                //массив для дропдуна файлов
                $list_file = array();
                $all_files = File::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_files as $file){
                   $list_file[$file->id]=$file->title;
                }
                
		$file = new ProductFile;
                $file->id_prod = $id_prod;
                $file->id_lang = $id_lang;
                $file->active = 1;
                if ($id_prod==0)
                    $file->session_id = session_id();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductFile']))
		{
                    
			$file->attributes = $_POST['ProductFile'];
                        $file->session_id = session_id();
                        $file->id_file = $_POST['ProductFile']['id_file'][0];
                        
                        $filename = File::model()->findByPk($file->id_file)->name;
                        $file->name = ($file->name=='') ? $filename : $file->name;
			if (!$file->save())
                             print_r($file->getErrors());
                        else
                            $this->redirect(array('productFile/create','id_prod'=>$file->id_prod,'id_lang'=>$file->id_lang));
		}

		$this->renderPartial('create',array(
			'file'=>$file,
                        'list_file' => $list_file,
                        'action' => 'create'
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
                
                //массив для дропдуна файлов
                $list_file = array();
                $all_files = File::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_files as $file){
                   $list_file[$file->id]=$file->title;
                }
                
                $file = ProductFile::model()->findByAttributes(array('id'=>$id));
                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductFile']))
		{
                        
			$file->attributes=$_POST['ProductFile'];
                        
                        $file->id_file = $_POST['ProductFile']['id_file'][0];
                        
                        $filename = File::model()->findByPk($file->id_file)->name;
                        $file->name = ($file->name=='') ? $filename : $file->name;
			if (!$file->update())
                             print_r($file->getErrors());
                        else
                            $this->redirect(array('productFile/create','id_prod'=>$file->id_prod,'id_lang'=>$file->id_lang));
                            
		}
                
		$this->renderPartial('update',array(
			'file'=>$file,
                        'list_file' => $list_file,
                        'action' => 'update'
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $model  =  $this->loadModel($id);
            
            $file = ProductFile::model();
            $file->id_lang = $model->id_lang;
            $file->id_prod = $model->id_prod;
            $file->active = 1;
            
            $this->loadModel($id)->delete();
            
	    $this->redirect(array('productFile/create','id_prod'=>$file->id_prod,'id_lang'=>$file->id_lang));
	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ProductFile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProductFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductFile']))
			$model->attributes=$_GET['ProductFile'];

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
		$model=ProductFile::model()->findByAttributes(array('id'=>$id));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
