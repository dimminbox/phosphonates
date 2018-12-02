<?php

class RussianpostController extends Controller
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
				'actions'=>array('calc'),
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
        public function actionCalc()
	{               
            $content = '';
            $delimiters = array("\r\n","\t"," ");
            $country = array('643'=>'Россия','804'=>'Украина','112'=>'Белорусь','398'=>'Казахстан');
            $method = array('44'=>'EMS обыкновенный','23'=>'Заказная бандероль','26'=>'Ценная бандероль');
            $model = new RussianPost();
            if (!empty($_POST['Russianpost'])) { 
                if (isset($_SESSION['major']))
                unset($_SESSION['major']);
                $model->country = $country[intval($_POST['Russianpost']['countryCode'])];
                $model->country_id = intval($_POST['Russianpost']['countryCode']);
                $model->city = $_POST['Russianpost']['city'];
                $model->address = $_POST['Russianpost']['address'];
                $model->method = $method[intval($_POST['Russianpost']['viewPost'])];
                $model->method_id = intval($_POST['Russianpost']['viewPost']);

                $model->price = 100;
                $model->weight = 600;
                $model->cost = 0;
                if ($_POST['Russianpost']['countryCode']==643){
                    $model->index = $_POST['Russianpost']['index'];
                    if ($model->validate()){
                        $ch = curl_init("http://www.russianpost.ru/autotarif/Autotarif.aspx?viewPost=$model->method_id&countryCode=643&typePost=1&viewPostName=undefined&typePostName=undefined&weight=200&value1=100&postOfficeId=$model->index");
                        
                        curl_setopt($ch, CURLOPT_ENCODING, "windows-1251");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_ENCODING, "");
                        $content = curl_exec( $ch );
                        curl_close($ch);
                        $content = str_replace($delimiters,"",$content);
                        
                        $search = $model->method;
                        $search = str_replace(' ', '\s+', $search);
                        preg_match("/Стоимость.+TarifValue\"\>(.+)\<\/span\>\<\/td\>/x",$content,$res);
                        //preg_match("/$search\<\/td\>\<td\s+align\=\"right\"\>(.+)\<\/td\>/",$content,$res);
                        
                        if (!empty($res)) {
                            if ($res[1]=='-') {
                                Yii::app()->params['delivery_info'] = 'Проверьте индекс';
                                unset($_SESSION['russianpost']);
                            }
                            else {
                                $model->cost = str_replace(',','.',$res[1]);
                                $_SESSION['russianpost'] = $model;
                            }
                        }
                        else {
                            Yii::app()->params['delivery_info'] = 'Извините, в данный момент нет возможности посчитать стоимость доставки для этого метода.';
                            unset($_SESSION['russianpost']);
                        }
			unset($_SESSION['samovyvoz']);
                    }
                    else {
                        $error = CHtml::openTag('div').$model->getError('index').CHtml::closeTag('div');
                        $error .= CHtml::openTag('div').$model->getError('address').CHtml::closeTag('div');
                        $error .= CHtml::openTag('div').$model->getError('city').CHtml::closeTag('div');
                        Yii::app()->params['delivery_info'] = $error;
                    }
                    Yii::app()->runController('product/itog');            
                }
                else {
                    
                    $model->index='0';
                    if ($model->validate()){
                        $_SESSION['russianpost'] = $model;
                        $ch = curl_init("http://www.russianpost.ru/autotarif/Autotarif.aspx?viewPost=$model->method_id&countryCode=$model->country_id&typePost=1&viewPostName=undefined&typePostName=undefined&weight=200&value1=100&postOfficeId=$model->index");
                        curl_setopt($ch, CURLOPT_ENCODING, "windows-1251");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_ENCODING, "");
                        $content = curl_exec( $ch );
                        curl_close($ch);
                        $content = str_replace($delimiters,"",$content);                        
                    
                        $search = $model->method;
                        $search = str_replace(' ', '\s+', $search);
                        preg_match("/Стоимость.+TarifValue\"\>(.+)\<\/span\>\<\/td\>/x",$content,$res);
                        //preg_match("/$search\<\/td\>\<td\s+align\=\"right\"\>(.+)\<\/td\>/",$content,$res);
                        
                        if (!empty($res)) {                  
                            if ($res[1]=='-')
                                Yii::app()->params['delivery_info'] = '<div class="label_delivery">Выбранный способ доставки не возможен в эту страну.</div>';
                            else
                                $model->cost = str_replace(',','.',$res[1]);
                        }  
			unset($_SESSION['samovyvoz']);
                  }
                  else
                      print 'df';
                }
                
            }
            else {
                if (isset($_SESSION['russianpost'])) {
                    $model->attributes = $_SESSION['russianpost']->attributes;
                }
                $this->renderPartial('calc',array('model'=>$model,'method'=>$method,'country'=>$country));
            }
        }	
        
}
