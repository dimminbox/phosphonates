<?php

class CertificateController extends Controller
{

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
				'actions'=>array('admin','delete','add'),
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
	public function actionCreate()
	{
		$model = new Certificate;
                $model->sort = 0;
                $model->active = 1;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Certificate']))
		{
			$model->attributes=$_POST['Certificate'];
                        $model->name = $_FILES['Certificate']['name']['name'];
                        $model->ext = $_FILES['Certificate']['type']['name'];
                        $model->size = $_FILES['Certificate']['size']['name'];
                        
                        $model->title = ($_POST['Certificate']['title']!='') ? $_POST['Certificate']['title'] : $model->name;
                        if ($model->validate()){
                            $upload = CUploadedFile::getInstance($model, 'name');
                            $upload->saveAs(Yii::app()->params['path_files'].$model->name);
                            
                            if($model->save())
				$this->redirect(array('admin'));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $update = Certificate::model();
                $update->attributes = $model->attributes;
                $update->id = $model->id;

		if(isset($_POST['Certificate']))
		{
			$update->title = $_POST['Certificate']['title'];
                        $update->active = $_POST['Certificate']['active'];
                        $update->sort = $_POST['Certificate']['sort'];
                        
                        if ($_FILES['Certificate']['name']['name']!=''){
                            
                            $update->name = $_FILES['Certificate']['name']['name'];
                            $update->ext = $_FILES['Certificate']['type']['name'];
                            $update->size = $_FILES['Certificate']['size']['name'];
                            
                        }
                        if ($update->validate()){
                            if ($_FILES['Certificate']['name']['name']!=''){
                                $upload = CUploadedFile::getInstance($update, 'name');
                                $upload->saveAs(Yii::app()->params['path_files'].$update->name);
                            }
                            
                            if($update->update())
				$this->redirect(array('admin'));
                        }
		}
                
		$this->render('update',array(
			'model'=>$update,
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
		$dataProvider=new CActiveDataProvider('File');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Certificate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Certificate']))
			$model->attributes=$_GET['Certificate'];

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
		$model=Certificate::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function actionAdd($id_prod,$id_old){
            
            foreach (ProductFile::model()->findAllByAttributes(array('id_prod'=>$id_old,'session_id'=>session_id())) as $index => $productfile){
                $file = $productfile;
                $file->id_prod = $id_prod;   
                $file->update();
            }
        }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
