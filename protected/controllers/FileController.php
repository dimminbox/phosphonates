<?php

class FileController extends Controller
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{
	  $this->title = Yii::t('main','download');;
	  $criteria = new CDBCriteria();
	  $criteria->compare('active',1);
	  $criteria->order = 'title ASC';
	  $files = File::model()->findAll($criteria);
	  $this->render('index',array('files'=>$files));
	}
}
