<?php

class OrderController extends Controller
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
				'actions'=>array('add','sucess'),
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
        public function actionAdd()
	{

            $order = new Order();
            //заносим доставку в БД
            if (isset($_SESSION['russianpost'])){
                $russianpost = new RussianPost(); 
                $russianpost->attributes = $_SESSION['russianpost']->attributes;
                if ($russianpost->save()){
                    $order->id_delivery = $russianpost->id;
                    $order->delivery_type = 0;
                    $order->summ = $russianpost->cost;
                }
                else {
                    print_r($_SESSION['russianpost']->getErrors());
                    return 0;
                }
            }
            elseif (isset($_SESSION['major'])){
                $major = new Major(); 
                $major->attributes = $_SESSION['major']->attributes;
                if ($major->save()){
                    $order->delivery_type = 1;
                    $order->id_delivery = $major->id;
                    $order->summ = $major->cost;
                }
                else {
                    print_r($_SESSION['russianpost']->getErrors());
                    return 0;
                }
                
            }
            
            elseif (isset($_SESSION['samovyvoz'])){
	      $order->delivery_type = 2;
              $order->id_delivery = 0;
              $order->summ = 0;
	    }
           // print_r($_SESSION['code']);
            if (isset($_SESSION['code'])){
             // print_r('hello seeion');  
                
                
               $order->id_code =$_SESSION['code'];                   
               $code = Code::model()->findbyAttributes(array('id'=>$_SESSION['code']));
              //print_r($code);
               foreach (Yii::app()->shoppingCart as $position) {
                        $quantity = $position->getQuantity();
                        $discountPrice = ($code ->ckidka) * $position->getPrice() / 100;
                        $position->addDiscountPrice($discountPrice);
                    }
            }
            //заносим заказ в БД
              
            $multi=Yii::app()->shoppingCart->getCost();
            
            $order->summ = $order->summ + Yii::app()->shoppingCart->getCost();
            $order->id_user = Yii::app()->getModule('user')->user()->id; 
            if (!$order->save())
                print_r($order->getErrors());
            //заносим продукты из заказа в БД
            foreach (Yii::app()->shoppingCart->getPositions() as $position){
                $order_product = new OrderProduct();
                $order_product->id_order = $order->id;
                $order_product->id_product = $position->id;
                $order_product->name_product = $position->articul;
                $order_product->qty = $position->getQuantity();
                $order_product->price = $position->getPrice();
                if (!$order_product->save()){
                    print_r($order_product->getErrors());
                    return 0;
                }
            }
            //если мы сдесь, то это значит, что всё добавилось и мы можем редиректить юзера на страницу оплаты(это уже не шутки...)
           $password = "u9yIITHNQ";
            $crc = md5("cilita1:$order->summ:$order->id:$password");
	    $robokassa_url = "https://merchant.roboxchange.com/Index.aspx?MrchLogin=".Yii::app()->params['merchlogin'].
			    "&OutSum=$order->summ&InvId=$order->id&Desc=orderdesc&sIncCurrLabel=BANKOCEANMR&SignatureValue=$crc";
            
            //инфа по заказу
            $criteria=new CDbCriteria;
            $criteria->condition = "id_order=$order->id";
            $activeProvider = new CActiveDataProvider('OrderProduct', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>40,
                        ),
            ));
            $order = Order::model()->with('major','russianpost')->findByPk($order->id);    
            $body = $this->renderPartial('view',array(
			'model'=>$order,
                        'products' => $activeProvider,
                        'user'=>Yii::app()->getModule('user')->user()),true);
            
            $firstname = Yii::app()->getModule('user')->user()->profile->firstname;
            $lastname = Yii::app()->getModule('user')->user()->profile->lastname;
            $message = Yii::t('main', 'order_add',array(
                                            '{firstname}'=>$firstname,
                                            '{lastname}'=>$lastname,
                                            '{order_id}'=>$order->id,
                                            '{pay_link}'=>$robokassa_url,
                                            '{body}'=>$body));
            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
            $mailer->Host = 'mail.r-optics.ru';
	    $mailer->IsSMTP();
            $mailer->IsHTML(true);
            $mailer->From = Yii::app()->params['email'];
	    $mailer->FromName = Yii::app()->params['FromName'];
            $mailer->CharSet = 'UTF-8';
            $mailer->Subject = Yii::t('main', 'order_add_subject',array('{order_id}'=>$order->id));
            $mailer->AddReplyTo(Yii::app()->params['email']);
	    $mailer->AddAddress(Yii::app()->params['email']);
	    $mailer->AddAddress(Yii::app()->params['adminEmail']);
            $mailer->AddAddress(Yii::app()->getModule('user')->user()->email);
            $mailer->Body = $message;
            $mailer->Send();
        /*Yii::app()->shoppingCart->clear();*/
           Yii::app()->getRequest()->redirect($robokassa_url);
            
     }
     public function actionSucess(){
            $id = $_GET['inv_id'];
            //инфа по заказу                
            
            $order = Order::model()->with('major','russianpost')->findByPk($id);    
            $order->date_payment = date('Y-m-d H:i:s');
            $order->save();
            
            $criteria=new CDbCriteria;
            $criteria->condition = "id_order=$id";
            $activeProvider = new CActiveDataProvider('OrderProduct', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>40,
                        ),
            ));
            
           $this->render('sucess',array(
			'model'=>$order,
                        'products' => $activeProvider));
            
                
     }
	
}
