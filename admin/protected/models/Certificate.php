<?php

/**
 * This is the model class for table "Certificate".
 *
 * The followings are the available columns in table 'Certificate':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $size
 * @property string $ext
 * @property string $date_added
 * @property string $date_modified
 * @property integer $active
 * @property integer $sort
 */
class Certificate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Certificate the static model class
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
		return 'Certificate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, size, ext, date_added', 'required'),
			array('size, active, sort', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('title', 'length', 'max'=>500),
			array('ext', 'length', 'max'=>15),
			array('date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, size, ext, date_added, date_modified, active, sort', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Название',
			'title' => 'Заголовок',
			'size' => 'Размер',
			'ext' => 'Расширение',
			'date_added' => 'Дата добавления',
			'date_modified' => 'Дата изменения',
			'active' => 'Активный',
			'sort' => 'Сортировка',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('sort',$this->sort);

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