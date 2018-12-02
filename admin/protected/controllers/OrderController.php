<?php

class OrderController extends Controller
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{       
                $criteria=new CDbCriteria;
                $criteria->condition = "id_order=$id";
                $activeProvider = new CActiveDataProvider('OrderProduct', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>40,
                        ),
		));
                
                $order = Order::model()->with('major','russianpost')->findByPk($id);    
		$this->render('view',array(
			'model'=>$order,
                        'products' => $activeProvider
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			$model->attributes=$_POST['Order'];
                        
			if($model->save()){
                            if ($model->notification) {
                                
                                $firstname = Yii::app()->getModule('user')->user($model->id_user)->profile->firstname;
                                $lastname = Yii::app()->getModule('user')->user($model->id_user)->profile->lastname;
                                
                                $message = Yii::t('main', 'mail_order',array(
                                                    '{firstname}'=>$firstname,
                                                    '{lastname}'=>$lastname,
                                                    '{order_id}'=>$id,
                                                    '{date_posted}'=>$model->date_posted,
                                                    '{comment}'=>$model->text));
                                
                                $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
                                $mailer->Host = '192.168.0.236';
                                $mailer->IsSMTP();
                                $mailer->IsHTML(true);
                                $mailer->From = 'sales@cilita.com';
                                $mailer->AddReplyTo(Yii::app()->params['email']);
                                $mailer->AddAddress('loginov@rumex.ru');
                                $mailer->FromName = Yii::app()->params['FromName'];
                                $mailer->CharSet = 'UTF-8';
                                $mailer->Subject = Yii::t('main', 'subject').$model->id;
                                $mailer->Body = $message;
                                $mailer->Send();
                            }
                            //$this->redirect(array('view','id'=>$model->id));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('Order');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $criteria=new CDbCriteria;
                $criteria->join = 'LEFT JOIN `tbl_profiles` as `profile` on `id_user`=`profile`.`user_id`';
                $criteria->limit = 0;
                $criteria->select = array('id','delivery_type','date_created','date_posted','date_payment','summ','`profile`.`lastname` as `lastname`','`profile`.`firstname` as `firstname`',
                                          '`profile`.`user_id` as `id_user`');
                $activeProvider = new CActiveDataProvider('Order', array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>40,
                        ),
		));
                
		$model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

		$this->render('admin',array(
			'provider'=>$activeProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Order::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
