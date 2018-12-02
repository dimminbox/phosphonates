<?php

/**
 * This is the model class for table "ProductLang".
 *
 * The followings are the available columns in table 'ProductLang':
 * @property integer $id_prod
 * @property integer $id_lang
 * @property string $name
 * @property string $title
 * @property string $meta_descr
 * @property string $meta_keywords
 * @property string $extra_text
 */
class ProductLang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductLang the static model class
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
		return Yii::app()->params['table_suffix'].'ProductLang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_prod, id_lang, name', 'required'),
			array('id_prod, id_lang', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('title', 'length', 'max'=>70),
			array('meta_descr', 'length', 'max'=>215),
			array('meta_keywords', 'length', 'max'=>50),
                        array('extra_text', 'length', 'min'=>0),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_prod, id_lang, name, title, meta_descr, meta_keywords, extra_text', 'safe', 'on'=>'search'),
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
                    'product' => array(self::BELONGS_TO, 'Product', 'id_prod'),
                    'prod_attr' => array(self::HAS_MANY, 'AttributeValue', 'id_prod'),
                    'prod_rel' => array(self::MANY_MANY, 'ProductLang', 'ProductRelation(id_prod,id_lang,id_prod_rel)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_prod' => 'Id Prod',
			'id_lang' => 'Id Lang',
			'name' => 'Название',
			'title' => 'Заголовок',
			'meta_descr' => 'Meta описание',
			'meta_keywords' => 'Meta ключевики',
			'extra_text' => 'Описание',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		$criteria=new CDbCriteria;
                $criteria->with = array('product');
                
                //для того чтобы не светить в списке этот же продукт
                $criteria->condition = 'id_prod <> :id';
                $criteria->params = array(':id' => $id);
                $criteria->compare('product.active',1);
                if (isset($_GET['Relation'])) {
                    $criteria->compare('product.articul',$_GET['Relation']['articul'],1);
                    $criteria->compare('id_prod',$_GET['Relation']['id_prod']);
                    
                }
		$criteria->compare('id_lang',$this->id_lang);
                
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_descr',$this->meta_descr,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('extra_text',$this->extra_text,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function relation($id)
	{
            $criteria=new CDbCriteria;
            
            $criteria->with = array('prod_rel');
            $criteria->compare('id_prod',$id);
            
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
	}
}