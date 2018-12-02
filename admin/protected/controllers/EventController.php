<?php

class EventController extends Controller
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
                $action = Yii::app()->urlManager->createUrl('event/create');
                $lang = new Language;
                $lang->name = $language;
                
		$model = new Event;
                $event_lang = new EventLang;
                
                $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;
		
		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
                        $model->date_added = date('Y-m-d H:i:s');
                        $model->date_modified = date('Y-m-d H:i:s');
                        
                        $event_lang->attributes=$_POST['EventLang'];
                        $event_lang->id_lang = $id_lang;
                        $event_lang->id_event = 0;
                        if ($_FILES['Event']['name']['image']!=''){
                            $upload = CUploadedFile::getInstance($model, 'image');
                            $model->image = Translite::rusencode($event_lang->name).'.'.$upload->getExtensionName(); 
                            $upload->saveAs(Yii::app()->params['image_events'].$model->image);
                        }
                        
                        if (($event_lang->validate())&&($model->validate()))
                            if($model->save()) {
                                $this->redirect(array('admin'));
                            }
		}
                
		$this->render('create',array(
			'model'=>$model,
                        'news_lang' => $event_lang,
                        'action' => $action,
                        'language' => $lang
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$language='ru'){
	
                $action = Yii::app()->urlManager->createUrl('event/update',array('id'=>$id));
                $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
		$model=$this->loadModel($id);
                
                $event_lang = new EventLang();
                $event_lang = EventLang::model()->findByAttributes(array('id_event'=>$id,'id_lang'=>$id_lang));
                $event_lang->attributes = (isset($event_lang->attributes)) ? $event_lang->attributes : array('id_event'=>0,'id_lang'=>$id_lang);
                
                $lang = new Language;
                $lang->name = $language;
                
		if(isset($_POST['Event']))
		{
                        $model->attributes=$_POST['Event'];
                        $model->date_modified = date('Y-m-d H:i:s');
                        
			$event_lang->attributes=$_POST['EventLang'];
                        $event_lang->id_lang = $id_lang;
                        $event_lang->id_event = 0;
                        if ($_FILES['Event']['name']['image']!=''){
                            $upload = CUploadedFile::getInstance($model, 'image');
                            $model->image = Translite::rusencode($event_lang->name).'.'.$upload->getExtensionName(); 
                            $upload->saveAs(Yii::app()->params['image_events'].$model->image);
                        }
                        
                        if (($event_lang->validate())&&($model->validate()))
                            if($model->save()) {
                                $this->redirect(array('admin'));
                            }
		}
		$this->render('update',array(
			'model'=>$model,
                        'news_lang' => $event_lang,
                        'action' => $action,
                        'language' => $lang
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
		$dataProvider=new CActiveDataProvider('Event');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

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
		$model=Event::model()->findByPk($id);
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
