<?php

class ProductRelationController extends Controller
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
				'actions'=>array('admin','delete','error'),
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
        public function actionError()
	{
            
	}
        
	public function actionView($id)
	{
		$this->renderPartial('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	
	public function actionCreate($id_prod,$id_rel)
	{
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;  
            $model = new ProductRelation();
            $model->id_prod = $id_prod;
            $model->id_prod_rel = $id_rel;
            $model->active = 1;
            if ($model->validate()){
                try {
                    $model->save();
                }
                catch (Exception $e) {
                    Controller::notify('error_product_relation');
                }
            }
            
            $this->actionIndex($id_prod,true);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;  
            $id_prod = IntVal($_GET['id_prod']);
            $id_prod_rel = IntVal($_GET['id_prod_rel']);
            
            ProductRelation::model()->deleteAllbyAttributes(array('id_prod'=>$id_prod,'id_prod_rel'=>$id_prod_rel));
            
            $this->actionIndex($id_prod,true);
	
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id,$flag=false)
	{
                if ($flag)
                    $this->renderPartial('index',array('id'=>$id),false,true);
                else
                    $this->renderPartial('index',array('id'=>$id));
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
