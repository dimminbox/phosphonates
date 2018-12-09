<?php

class ProductController extends Controller
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
				'actions'=>array('index','view','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','import'),
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
	public function actionView($url){
            
            $product = ProductLang::model()->with(array('product.prod_attr.attr_label'=>
                                            array('condition'=>"product.url='$url'",'order'=>'attr_label.id'))
									  )->findAll();
									  
            if ($product[0]->title!='')
                $this->title = $product[0]->title;
            else
                $this->title = $product[0]->name;

	    $this->meta_descr = $product[0]->meta_descr;
	    $this->meta_keywords = $product[0]->meta_keywords;
	    

            $this->render('view',array('product'=>$product));
	}


    public function actionSearch()
	{            
	    	$search = $_REQUEST['search'];
            $products = ProductLang::model()->findAll("name like '%$search%' or extra_text like '%$search%'");
            $this->render('search',array('products'=>$products));
	}

        
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
