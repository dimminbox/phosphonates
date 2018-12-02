<?php

/**
 * This is the model class for table "NewsLang".
 *
 * The followings are the available columns in table 'NewsLang':
 * @property integer $id_news
 * @property integer $id_lang
 * @property string $content
 * @property string $short_content
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $image_title
 */
class NewsLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NewsLang the static model class
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
		return 'NewsLang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_news, id_lang, content, meta_title, name', 'required'),
			array('id_news, id_lang', 'numerical', 'integerOnly'=>true),
			array('meta_title', 'length', 'max'=>80),
			array('meta_description', 'length', 'max'=>200),
			array('meta_keywords', 'length', 'max'=>25),
			array('image_title', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_news, id_lang, content, short_content, meta_title, meta_description, meta_keywords, image_title', 'safe', 'on'=>'search'),
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
			'id_news' => 'Id News',
			'id_lang' => 'Id Lang',
			'content' => 'Content',
			'short_content' => 'Short Content',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'image_title' => 'Image Title',
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

		$criteria->compare('id_news',$this->id_news);
		$criteria->compare('id_lang',$this->id_lang);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('image_title',$this->image_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}