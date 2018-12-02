<?php

class CityController extends Controller
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
				'actions'=>array('search'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function actionSearch(){
            $model = new City();
            $result = '';
            if (isset($_GET['q'])){
                $search = $_GET['q'];
                $region = $_GET['id_region'];
                if ($search==' ')
                    $cities = $model->findAll('id_region ='.$region,array('order'=>'name'));
                else
                    $cities = $model->findAll('id_region ='.$region.' and `name` like "%'.$search.'%"',array('order'=>'name'));
                foreach ($cities as $city){
                    //print_r($city);
                    $result .=$city->name."\n";
                }
            }
            echo $result;
        }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	
}
