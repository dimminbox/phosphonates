<?php

class EventController extends Controller
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
				'users'=>array('*'),
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
	
	
	/**
	 * Lists all models.
	 */
	public function actionView($id)
	{
		$event = Event::model()->with('event_lang')->findbyAttributes(array('id'=>$id));
		$this->renderPartial('view',array('event'=>$event));
	}
	public function actionIndex()
	{
		if (isset($_GET['limit'])) {
		  $events = Event::model()->with('event_lang')->findAllbyAttributes(array('active'=>1),array('limit'=>Yii::app()->params['event_limit'],'order'=>'t.sort'));
		  $this->renderPartial('index',array('events'=>$events));
		}
		else {
		  $events = Event::model()->with('event_lang')->findAllbyAttributes(array('active'=>1),array('order'=>'t.sort'));
		  $this->render('index',array('events'=>$events));
		}
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
