<?php

class CategoryGroupController extends Controller
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

            //языковые параметры
            $lang = new Language;
            $lang->name = $language;
            
            $action = Yii::app()->urlManager->createUrl('categoryGroup/create');
            
            $model=new CategoryGroup;
            $prefix = Preference::model();


            if(isset($_POST['CategoryGroup']))
            {
                    $model->attributes=$_POST['CategoryGroup'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id_group));
            }

            $this->render('create',array(
                    'model'=>$model,
                    'prefix' => $prefix,
                    'language' => $lang,
                    'action' => $action,
            ));
	}

	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                
                $action = Yii::app()->urlManager->createUrl('categoryGroup/create');
		
                //языковые параметры
                $lang = Language::model()->findbyAttributes(array('id'=>$model->id_lang));
                
                $prefix = Preference::model()->findbyAttributes(array('id'=>$model->id_prefix));
                
                $action = Yii::app()->urlManager->createUrl('categoryGroup/update',array('id'=>$id));

		if(isset($_POST['CategoryGroup']))
		{
			$model->attributes=$_POST['CategoryGroup'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_group));
		}

		$this->render('update',array(
			'model'=>$model,
                        'prefix' => $prefix,
                        'language' => $lang,
                        'action' => $action,
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
		$dataProvider=new CActiveDataProvider('CategoryGroup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CategoryGroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CategoryGroup']))
			$model->attributes=$_GET['CategoryGroup'];

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
		$model=CategoryGroup::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}