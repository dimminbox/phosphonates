<?php

/**
 * This is the model class for table "Product".
 *
 * The followings are the available columns in table 'Product':
 * @property integer $id
 * @property double $price
 * @property integer $active
 * @property integer $top
 * @property string $articul
 * @property string $url
 * @property integer $sort
 */
class Product extends CActiveRecord implements IECartPosition 
{
    public $parent = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'Product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified, articul,available', 'required'),
			array('active, top, sort', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('articul', 'length', 'max'=>30),
			array('url', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, price, active, top, articul, url, sort', 'safe', 'on'=>'search'),
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
                    'prod_lang' => array(self::HAS_MANY, 'ProductLang', 'id_prod'),
                    'prod_image' => array(self::HAS_MANY, 'Image', 'id_prod'),
                    'prod_attr' => array(self::HAS_MANY, 'AttributeValue', 'id_prod'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'available' => 'Available',
			'price' => 'Price',
			'active' => 'Active',
			'top' => 'Top',
			'articul' => 'Articul',
			'url' => 'Url',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('price',$this->price);
		$criteria->compare('active',$this->active);
		$criteria->compare('top',$this->top);
		$criteria->compare('articul',$this->articul,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
       
        function getId(){
            return 'Product'.$this->id;
        }
        function getPrice(){
            return $this->price;
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