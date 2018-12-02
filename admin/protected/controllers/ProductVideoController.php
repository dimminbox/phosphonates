<?php

class ProductVideoController extends Controller
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
                $list_video = array();
                $all_videos = Video::model()->findAllByAttributes(array('active'=>1));
                foreach ($all_videos as $video){
                   $list_video[$video->id]=$video->name;
                }
                
		$video = new ProductVideo;
                $video->id_prod = $id_prod;
                $video->id_lang = $id_lang;
                $video->active = 1;
                if ($id_prod==0)
                    $video->session_id = session_id();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductVideo']))
		{
                    
			$video->attributes = $_POST['ProductVideo'];
                        $video->session_id = session_id();
                        $video->id_video = $_POST['ProductVideo']['id_video'][0];
                        $video->date_added = date('Y-m-d H:i:s');
                        $video->date_modified = date('Y-m-d H:i:s');
                        
                        $filename = Video::model()->findByPk($video->id_video)->name;
                        $video->name = ($video->name=='') ? $filename : $video->name;
			if (!$video->save())
                             print_r($video->getErrors());
                        else
                            $this->redirect(array('productVideo/create','id_prod'=>$video->id_prod,'id_lang'=>$video->id_lang));
		}

		$this->renderPartial('create',array(
			'video'=>$video,
                        'list_videos' => $list_video,
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
            $list_videos = array();
            $all_videos = Video::model()->findAllByAttributes(array('active'=>1));
            foreach ($all_videos as $video){
               $list_videos[$video->id]=$video->name;
            }

            $video = ProductVideo::model()->findByAttributes(array('id'=>$id));


            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['ProductVideo']))
            {

                    $video->attributes=$_POST['ProductVideo'];
                    $video->id_video = $_POST['ProductVideo']['id_video'][0];

                    $filename = Video::model()->findByPk($video->id_video)->name;
                    $video->name = ($video->name=='') ? $filename : $video->name;
                    if (!$video->update())
                         print_r($video->getErrors());
                    else
                        $this->redirect(array('productVideo/create','id_prod'=>$video->id_prod,'id_lang'=>$video->id_lang));

            }

            $this->renderPartial('update',array(
                    'video'=>$video,
                    'list_videos' => $list_videos,
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
            
            $video = ProductVideo::model();
            $video->id_lang = $model->id_lang;
            $video->id_prod = $model->id_prod;
            $video->active = 1;
            
            $this->loadModel($id)->delete();
            
	    $this->redirect(array('productVideo/create','id_prod'=>$video->id_prod,'id_lang'=>$video->id_lang));
	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ProductVideo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProductVideo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductVideo']))
			$model->attributes=$_GET['ProductVideo'];

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
		$model=ProductVideo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-video-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
