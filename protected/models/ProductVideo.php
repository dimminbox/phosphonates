<?php

/**
 * This is the model class for table "ProductVideo".
 *
 * The followings are the available columns in table 'ProductVideo':
 * @property integer $id
 * @property integer $id_video
 * @property integer $id_lang
 * @property string $text_before
 * @property string $text_after
 * @property string $name
 * @property integer $active
 * @property integer $sort
 * @property integer $id_prod
 * @property string $date_added
 * @property string $date_modified
 */
class ProductVideo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductVideo the static model class
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
		return 'ProductVideo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified, id_video, id_lang, name, active, id_prod,session_id, date_added', 'required'),
			array('id, id_video, id_lang, active, sort, id_prod', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('text_before, text_after, date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_video, id_lang, text_before, text_after, name, active, sort, id_prod, date_added, date_modified', 'safe', 'on'=>'search'),
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
			'id_video' => 'Id Video',
			'id_lang' => 'Id Lang',
			'text_before' => 'Text Before',
			'text_after' => 'Text After',
			'name' => 'Name',
			'active' => 'Active',
			'sort' => 'Sort',
			'id_prod' => 'Id Prod',
			'date_added' => 'Date Added',
			'date_modified' => 'Date Modified',
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
		$criteria->compare('id_lang',$this->id_lang);
		$criteria->compare('id_prod',$this->id_prod);
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