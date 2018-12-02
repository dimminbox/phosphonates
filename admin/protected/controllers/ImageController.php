<?php

class ImageController extends Controller
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
				'actions'=>array('admin','delete','upload','add'),
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
	public function actionCreate($id_prod=0)
	{
		$model=new Image;
                $model->session_id = session_id();
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Image']))
		{
			$model->attributes = $_POST['Image'];
                        
                        //print_r($_POST);
                        //print_r($model->attributes);
                        if ($model->save()){  
                            $model->alt = '';
                            $model->file = '';
                            $model->session_id = session_id();
                        }
                            
                        $this->renderPartial('create',array(
                            'model'=>$model,
                            'action' => 'create',
                        ));
		}
                else
		$this->renderPartial('create',array(
			'model'=>$model,
                        'action' => 'create',
		));
        
                     
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
                        $model->update();
                        
                        $model->alt = '';
                        $model->file = '';
                        $model->session_id = session_id();
                        
                        $this->renderPartial('create',array(
                            'model'=>$model,
                            'action' => 'create',
                        ));
			/*if($model->update())
				$this->redirect(array('view','id'=>$model->id));*/
		}
                else
		$this->renderPartial('update',array(
			'model'=>$model,
                        'action' => 'update',
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $id_prod = $this->loadModel($id)->id_prod;
            $this->loadModel($id)->delete();
            
            
            $model=new Image;
            $model->session_id = session_id();
            $model->id_prod = $id_prod;
            
            $this->renderPartial('create',array(
                    'model'=>$model,
                    'action' => 'create',
            ));
            
		/*if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');*/
	}
        public function actionUpload()
        {
                Yii::import("application.extensions.EAjaxUpload.qqFileUploader");

                    $folder=Yii::app()->params['path'].Yii::app()->params['image_products'];// folder for uploaded files
                    $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
                    $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
                    $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                    $result = $uploader->handleUpload($folder);
                    $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                    echo $result;// it's array
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Image');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Image('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Image']))
			$model->attributes=$_GET['Image'];

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
		$model=Image::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        public function actionAdd($id_prod,$id_old){
            
            foreach (Image::model()->findAllByAttributes(array('id_prod'=>$id_old,'session_id'=>session_id())) as $index => $image){
                $info = explode('.',$image->file);
                
                if (substr_count($info[0],'_')==0){
                    $newName = $id_prod.'_'.$image->id.'.'.$info[1];

                    rename($_SERVER['DOCUMENT_ROOT'].Yii::app()->params['path_products'].$image->file,
                           $_SERVER['DOCUMENT_ROOT'].Yii::app()->params['path_products'].$newName);
                    
                    $image->file = $newName;
                    
                    if ($id_old==0)
                     $image->id_prod = $id_prod;   
                    $image->update();
                }
                
            }
        }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
