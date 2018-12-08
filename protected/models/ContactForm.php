<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CActiveRecord
{
	public $first_name;
	public $last_name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('first_name, last_name, email, subject, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
	  $user = Yii::app()->getModule('user');
	  
		return array(
			'first_name' => $user::t('First Name','user'),
			'last_name' => $user::t('Last Name','user'),
			'email' => $user::t('E-mail','user'),
			'subject' => $user::t('Subject','user'),
			'body' => $user::t('Body','user'),
			'verifyCode'=>$user::t('Enter symbols','user'),
		);
	}
}