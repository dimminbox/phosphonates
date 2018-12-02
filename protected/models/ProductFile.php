<?php

/**
 * This is the model class for table "ProductFile".
 *
 * The followings are the available columns in table 'ProductFile':
 * @property integer $id_file
 * @property integer $id_prod
 * @property integer $id_lang
 * @property string $title
 * @property string $name
 * @property integer $active
 * @property integer $sort
 */
class ProductFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ProductFile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified,id_file, id_prod, id_lang, active, session_id', 'required'),
			array('id_file, id_prod, id_lang, active, sort', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('name', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_file, id_prod, id_lang, title, name, active, sort, id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'id' => 'Id',
			'id_file' => 'File',
			'id_prod' => 'Id Prod',
			'id_lang' => 'Id Lang',
			'title' => 'Title',
			'name' => 'Name',
			'active' => 'Active',
			'sort' => 'Sort',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id_prod',$this->id_prod);
		$criteria->compare('id_lang',$this->id_lang);
                $criteria->compare('session_id',$this->session_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        protected function beforeValidate()
	{
		if(parent::beforeValidate())
		{
			if($this->isNewRecord)
			{
				$this->date_added=date('Y-m-d H:i:s');
				$this->date_modified=date('Y-m-d H:i:s');
			}
			else
				$this->date_modified=date('Y-m-d H:i:s');
			return true;
		}
		else
			return false;
	}
}