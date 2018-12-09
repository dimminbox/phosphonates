<?php

class CategoryController extends Controller
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
				'actions'=>array('index','view', 'search'),
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

	public function actionSearch()
	{
			$search = $_REQUEST["search"];
	    
            $_categories = Category::model()->with(array('cat_language','products.product.prod_attr.attr_label'=>array('condition'=>'product.active=1','order'=>'product.sort DESC, attr_label.id desc')))
                                          ->findAll("products.name like '%$search%' or products.extra_text like '%$search%'");
			$arrCategories = [];

			$this->title = "Результаты поиска по запросу $search";			
			
			$attrs = [];
			$products = [];
			foreach($_categories as $_category) {
			foreach ($_category->products as $product) {
				$products[] = $product;
				foreach ($product->product->prod_attr as $_index=>$attr) {
					if ($attr->value!="") {
						$value = $attr->value;
						$notEmpty = true;
					} else {
						$value = "-";
					}
					$attrs[ $attr->attr_label->name ] [$product->id_prod] = $value;
				}
			}
		}
			foreach($attrs as $name=>$values) {
				$isEmpty = true;
				foreach($values as $id_prod=>$value) {
					$isEmpty = $isEmpty && ($value == "-");
				}
				if ($isEmpty) {
					unset($attrs[$name]);
				}
			}

            $this->render('search',array(
				'attrs'=>$attrs, 
				'categories'=>$arrCategories, 
				'products'=>$products
				)
			);
	}

	public function actionIndex($url='')
	{
		
			$_category = Category::model()->with(array('cat_language','products.product.prod_attr.attr_label'=>array('condition'=>'product.active=1','order'=>'product.sort DESC, attr_label.id desc')))->findByAttributes(array('url'=>$url));
	    
            $_categories = Category::model()->with(array('cat_language','products.product.prod_attr.attr_label'=>array('condition'=>'product.active=1','order'=>'product.sort DESC, attr_label.id desc')))
                                          ->findAll("parent=$_category->parent" );
			$arrCategories = [];
			foreach($_categories as $sCategory) {

				$arrCategory["name"] = $sCategory->cat_language[0]->nameShort;
				$arrCategory["url"] = "/category/".$sCategory->url;
				$arrCategory["active"] = ($_category->url == $sCategory->url);
				$arrCategories[] = $arrCategory;
			}
            if ($_category->cat_language[0]->title!='')
                $this->title = $_category->cat_language[0]->title;
            else
                $this->title = $_category->cat_language[0]->name;

            $this->meta_descr = $_category->cat_language[0]->meta_descr;
			$this->meta_keywords = $_category->cat_language[0]->meta_keywords;
			
			$attrs = [];
			foreach ($_category->products as $product) {
				foreach ($product->product->prod_attr as $_index=>$attr) {
					if ($attr->value!="") {
						$value = $attr->value;
						$notEmpty = true;
					} else {
						$value = "-";
					}
					$attrs[ $attr->attr_label->name ] [$product->id_prod] = $value;
				}
			}
			foreach($attrs as $name=>$values) {
				$isEmpty = true;
				foreach($values as $id_prod=>$value) {
					$isEmpty = $isEmpty && ($value == "-");
				}
				if ($isEmpty) {
					unset($attrs[$name]);
				}
			}

            $this->render('index',array(
				'attrs'=>$attrs, 
				'categories'=>$arrCategories, 
				'products'=>$_category->products,
				'cur_category' => $_category->cat_language[0])
			);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
