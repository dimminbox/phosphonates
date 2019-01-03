<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
      
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	public function actionIndex()
	{ 
	    $this->title = Yii::app()->params['main_title'];
	    $this->meta_descr = Yii::app()->params['main_description'];
	    /*$criteria = new CDBCriteria;
	    $criteria->with = array('news_lang');
	    $criteria->compare('active',1);
	    $criteria->order = 't.id desc';
	    $news = News::model()->findAll($criteria);*/
		$this->render('index');
	}

	public function actionContact()
	{
		$this->title = Yii::app()->params['main_contact'];
		$model = new ContactForm();
		$message = "";
		$alertClass = '';		
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {

				$subject = "Обращение с сайта phosphonates.ru";
				$to = "pelevina.galina@gmail.com";
				$body = "<p>Клиент - ".$model->first_name. " ".$model->last_name."</p>";
				$body .= "<p>$body</p>";
				
				mail($to, $subject, $body);
				
				$model->save();
				$message = "Спасибо за Ваше обращение.";
				$model->attributes = [];
				$alertClass = 'alert alert-success';
			} else {
				$messages = [];
				$errors = array_values($model->getErrors());
				foreach( $errors as $error) {
					
					if (isset($error[0]))
						$messages[] = $error[0];
				}
				$message = implode("<br>",$messages);
				$alertClass = 'alert alert-danger';
			}

		}

        return $this->render('contact', [
			'model' => $model,
			'message' => $message,
			'alertClass'=> $alertClass,
		]);
	}
	public function actionError()
	{

	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}