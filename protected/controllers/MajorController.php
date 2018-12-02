<?php

class MajorController extends Controller
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
				'actions'=>array('calc','parser','samovyvoz','samovyvozitog'),
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
      public function actionParser(){
          require 'protected/comp/phpQuery.php';  
          $str = file_get_contents('protected/data/select_2.html');
          $document = phpQuery::newDocument($str);
          $options = $document->find('option');
          print '<table>';
          foreach ($options as $index=>$option){
              if ($index!=0) {
                print  '<tr><td>'.pq($option)->attr('value')."</td><td>".str_replace(array("\r\n"),"",pq($option)->text()).'</td></tr>';
              }
          }
          print '</table>';
          
      }
      public function actionSamovyvoz(){
	$_SESSION['samovyvoz'] = 1;
	$this->renderPartial('samovyvoz');  
	
      }
      public function actionSamovyvozitog(){
	
	$_SESSION['samovyvoz'] = 1;
	unset($_SESSION['major']);
	unset($_SESSION['russianpost']);
	Yii::app()->runController('product/itog');    
      }
      public function actioncalc(){
          
        require 'protected/comp/phpQuery.php';       
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;  
        
        $city_name ='';
        
        if (isset($_SESSION['major'])) {
            $model = $_SESSION['major'];
            $city_name = City::model()->findByAttributes(array('id'=>$_SESSION['major']->id_city))->name;
        }
        else {
            $model = new Major();
            $model->id_country = 0;
            $model->id_region = 0;
            $model->form = 'Пакет';
            $model->weight = 100;
            $model->price = 100;
            $model->cost = 0;
            $model->insurance = 0;
            $model->delivery_time = 0;
            $model->order_id = 0;
        }
        //дропдауны стран и регионов
        if (!isset($_SESSION['countryCode']))
            $_SESSION['countryCode'] = 0;
        if (!isset($_SESSION['id_region']))
            $_SESSION['id_region'] = 0;
        
        $model->id_country = (isset($_POST['countryCode'])) ? ($_POST['countryCode']) : $_SESSION['countryCode'];
        $_SESSION['countryCode'] = $model->id_country;
        
        $model->id_region = (isset($_POST['id_region'])) ? ($_POST['id_region']) : $_SESSION['id_region'];
        $_SESSION['id_region'] = $model->id_region;
        
        $country = CHtml::listData(Country::model()->findAllByAttributes(array('active'=>1)), 'id', 'name');
        $region = CHtml::listData(Region::model()->findAllByAttributes(array('id_country'=>$model->id_country)), 'id', 'name');
        if (count($region)==1) {
            $_region = array_keys($region);
            $model->id_region = $_region[0];
        }
        
        if (isset($_POST['Calc'])){
           if (isset($_SESSION['russianpost']))
                unset($_SESSION['russianpost']);
           $model->attributes = $_POST['Calc']; 
           $city = City::model()->find('name="'.$_POST['Calc']['city'].'"');
           $city_name = $_POST['Calc']['city'];
           if (isset($city->id))
              $model->id_city = $city->id;
           
           
           if ($model->validate()){           
               $ch = curl_init("http://www.me-online.ru/calculator.asp");
               $postdata = "countryfrom=%D0%EE%F1%F1%E8%FF&countryto=".$model->id_country."&cityfrom=970&cityto=$model->id_city&weight=".($model->weight/1000)."&pack=2&cost=$model->price&action=1&citytoval=&citytoname=&cityfromval=&cityfromname=";
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_HEADER, 0);
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
               curl_setopt($ch, CURLOPT_ENCODING, "");
               $content = curl_exec( $ch );
               $content = iconv('windows-1251','utf-8',$content);

               curl_close($ch);
               $document = phpQuery::newDocument($content);
               $hentry = $document->find('td.tdcontentall');
               
               $document1 = phpQuery::newDocument(pq($hentry)->html());
               $tds = $document1->find('td[width="515"] > table[width="515"]');
               foreach ($tds as $index=>$td){
                   if ($index==1){
                       $document2 = phpQuery::newDocument(pq($td)->html());
                       $costs = $document2->find('td[width="255"]');
                       foreach ($costs as $index=>$cost){
                            switch ($index){
                                case 0:
                                        $model->cost = str_replace(',','.',pq($cost)->html());
                                        if ($model->id_country!=0)
                                                $model->cost = round($model->cost*$this->getValute(),2);
                                        break;
                                case 1 :
                                        $model->insurance = pq($cost)->html();
                                        break;
                                case 2 :
                                        $model->delivery_time = pq($cost)->html();
                                        break;
                            }
                            //print pq($cost)->html().'  ';
                       }
                       break;
                   }
               }
            $_SESSION['major'] = $model;  
	    unset($_SESSION['samovyvoz']);
           }
           else {
               $error = CHtml::openTag('div').$model->getError('address').CHtml::closeTag('div');
               $error .= CHtml::openTag('div').$model->getError('id_city').CHtml::closeTag('div');
               Yii::app()->params['delivery_info'] = $error;
           }
        Yii::app()->runController('product/itog');               
        }
    else {
        $this->renderPartial('calc',array('model'=>$model,'city_name'=>$city_name,'country'=>$country,'region'=>$region),false,true);
    }
    }	
}
