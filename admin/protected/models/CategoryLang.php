<?php

/**
 * This is the model class for table "CategoryLang".
 *
 * The followings are the available columns in table 'CategoryLang':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $meta_descr
 * @property string $meta_keywords
 * @property string $description
 * @property integer $id_lang
 */
class CategoryLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CategoryLang the static model class
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
		return Yii::app()->params['table_suffix'].'CategoryLang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name,id_lang', 'required'),
			array('id, id_lang, id_group', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>600),
			array('title', 'length', 'max'=>600),
			array('meta_descr, meta_keywords', 'length', 'max'=>200),
			array('description', 'length', 'min'=>0),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, meta_descr, meta_keywords, description, id_lang', 'safe', 'on'=>'search'),
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
			'title' => 'Тайтл',
			'meta_descr' => 'Мета опсание',
			'meta_keywords' => 'Мета ключевики',
			'description' => 'Описание',
			'id_lang' => 'Id Lang',
                        'id_group' => 'Группа',
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
		$criteria->compare('meta_descr',$this->meta_descr,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('id_lang',$this->id_lang);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}