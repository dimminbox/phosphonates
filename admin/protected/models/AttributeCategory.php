<?php

/**
 * This is the model class for table "AttributeCategory".
 *
 * The followings are the available columns in table 'AttributeCategory':
 * @property integer $id_attr
 * @property string $value
 * @property integer $id_cat
 * @property integer $id_lang
 * @property string $date_added
 * @property string $date_modified
 */
class AttributeCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttributeCategory the static model class
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
		return 'AttributeCategory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_attr, value, id_cat, id_lang, date_added', 'required'),
			array('id_attr, id_cat, id_lang', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>255),
			array('date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_attr, value, id_cat, id_lang, date_added, date_modified', 'safe', 'on'=>'search'),
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
                    'attr_label' => array(self::HAS_MANY, 'Attribute', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_attr' => 'Id Attr',
			'value' => 'Value',
			'id_cat' => 'Id Cat',
			'id_lang' => 'Id Lang',
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

		$criteria->compare('id_attr',$this->id_attr);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('id_cat',$this->id_cat);
		$criteria->compare('id_lang',$this->id_lang);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);

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