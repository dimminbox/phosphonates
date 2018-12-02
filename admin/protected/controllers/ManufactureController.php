<?php

class ManufactureController extends Controller
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
	public function actionCreate($language='ru')
	{
            $action = Yii::app()->urlManager->createUrl('manufacture/create');
            $lang = new Language;
            $lang->name = $language;

            $model = new Manufacture();
            $man_lang = new ManufactureLang();

            $id_lang =  Language::model()->findByAttributes(array('code'=>$language))->id;

            if(isset($_POST['Manufacture']))
            {
                    $model->attributes=$_POST['Manufacture'];

                    $man_lang->attributes=$_POST['ManufactureLang'];
                    $man_lang->id_lang = $id_lang;
                    $man_lang->id_man = 0;
                    if ($_FILES['Manufacture']['name']['image']!=''){
                        $upload = CUploadedFile::getInstance($model, 'image');
                        //$model->image = Translite::rusencode($man_lang->name).'.'.$upload->getExtensionName(); 
                        $man_lang->image = $upload->name;
                        $upload->saveAs(Yii::app()->params['image_man'].$model->image);
                    }

                    if (($man_lang->validate())&&($model->validate()))
                        if($model->save())
                                $this->redirect(array('admin'));
            }

            $this->render('create',array(
                    'model'=>$model,
                    'man_lang' => $man_lang,
                    'action' => $action,
                    'language' => $lang
            ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id,$language='ru')
	{
                $action = Yii::app()->urlManager->createUrl('manufacture/update',array('id'=>$id));
                $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
		$model=$this->loadModel($id);
                
                $man_lang = new ManufactureLang();
                $_man_lang = ManufactureLang::model()->findByAttributes(array('id_man'=>$id,'id_lang'=>$id_lang));
                $man_lang->attributes = (isset($_man_lang->attributes)) ? $_man_lang->attributes : array('id_man'=>0,'id_lang'=>$id_lang);
                
                $lang = new Language;
                $lang->name = $language;
                

		if(isset($_POST['Manufacture']))
		{
                        $model->attributes=$_POST['Manufacture'];
                        
                        
			$man_lang->attributes=$_POST['ManufactureLang'];
                        $man_lang->id_lang = $id_lang;
                        $man_lang->id_news = 0;
                        if ($_FILES['Manufacture']['name']['image']!=''){
                            
                            $upload = CUploadedFile::getInstance($model, 'image');
                            //$model->image = Translite::rusencode($news_lang->name).'.'.$upload->getExtensionName(); 
                            $model->image = $upload->name;
                            $upload->saveAs(Yii::app()->params['image_man'].$model->image);
                        }
                        
                        if (($man_lang->validate())&&($model->validate()))
                            if($model->save())
                                    $this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
                        'man_lang' => $man_lang,
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
		$dataProvider=new CActiveDataProvider('Manufacture');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Manufacture('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Manufacture']))
			$model->attributes=$_GET['Manufacture'];

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
		$model=Manufacture::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='manufacture-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
