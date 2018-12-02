<?php

class AttributeController extends Controller
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
	public function actionCreate()
	{
                $models = array();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $prefix = SetAttribute::model();
                $max_id = Attribute::model()->find(array('select'=>'max(id) as id'))->id+1;
                
		if(isset($_POST['Attribute']))
		{
                    $valid = 1;
                    foreach($_POST['Attribute']['name'] as $index=>$attr){
                        
                        $model=new Attribute;
                        $model->name = $attr;
                        $model->id = $max_id;
                        $model->id_set = $_POST['Attribute']['setattribute'];
                        $model->id_lang = $index;
                        
                        $model->memo = 0;
                        $model->checkbox = 0;
                        $model->input = 0;
                        $model->dropdown = 0;
                        $model->dropdown_value = '';
                        
                        //dropdown аттрибуты
                        $model->$_POST['Attribute']['type'] = 1;
                        if ($_POST['Attribute']['type']=='dropdown')
                            $model->dropdown_value = $_POST['Attribute']['dropdown_value'];
                        
                        $valid = $model->validate()&&$valid;
                        
                        $models[$index] = $model;
                    }
                    if ($valid){
                        foreach ($models as $index => $model){    
                            $model->save();
                        }
                        $this->redirect(array('admin'));
                    }
		}
                else{
                    foreach(Language::model()->findAll() as $lang){
                        $models[$lang->id] = new Attribute;
                    }
                }
		$this->render('create',array(
			'models'=>$models,
                        'prefix' => $prefix,
                        'checked' => '',
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $models = array();
                
//		$model=$this->loadModel($id);
                
                $valid = 0;
                foreach (Attribute::model()->with('set')->findAllByAttributes(array('id'=>$id)) as $index=>$attr){
                    $model = $attr;
                    if(isset($_POST['Attribute'])){
                        
                        $model->name = $_POST['Attribute']['name'][$attr->id_lang];
                        $model->id_set = $_POST['Attribute']['setattribute'];
                        
                        $model->memo = 0;
                        $model->checkbox = 0;
                        $model->input = 0;
                        $model->dropdown = 0;
                        $model->dropdown_value = '';
                        
                        //dropdwon аттрибуты
                        $model->$_POST['Attribute']['type'] = 1;
                        if ($_POST['Attribute']['type']=='dropdown')
                            $model->dropdown_value = $_POST['Attribute']['dropdown_value'];
                        
                        $valid = 1;
                    }
                    $valid = $model->validate()&&$valid;
                    $models[$attr->id_lang] = $model;
                }
                
                $checked = 0;
                foreach (Yii::app()->params['AttrType'] as $_attr){
                    if ($model->$_attr!=0) $checked = $_attr;
                }
                
                if ($valid) {
                     foreach ($models as $index => $model){    
                         $model->update();
                     }
                     //$this->redirect(array('admin'));
                }
            
		$this->render('update',array(
			'models'=>$models,
                        'prefix' => $attr->set,
                        'checked' => $checked,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            Attribute::model()->deleteAllByAttributes(array('id'=>$id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Attribute');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Attribute('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Attribute']))
			$model->attributes=$_GET['Attribute'];

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
		$model=Attribute::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='attribute-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
