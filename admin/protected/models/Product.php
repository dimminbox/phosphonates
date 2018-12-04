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
class Product extends CActiveRecord
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
		return Yii::app()->params['table_suffix'].'Product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified', 'required'),
			array('active, top, sort, new, id_man', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('articul', 'length', 'max'=>30),
			array('url', 'length', 'max'=>500),
			array('file', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, price, active, top, articul, url, sort, file', 'safe', 'on'=>'search'),
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
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'available' => 'Доступно на складе',
			'price' => 'Цена',
			'active' => 'Активный',
			'top' => 'На гл.странице',
                        'new' => 'Новинка',
			'articul' => 'Артикул',
			'url' => 'УРЛ',
			'sort' => 'Сортировка',
			'parent' => 'Входит в раздел',
			'file' => 'Файл'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($prefix)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->together = true;
                $criteria->with = array('prod_lang.prod_attr.attr_label.set');
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.price',$this->price);
		$criteria->compare('t.active',$this->active);
		$criteria->compare('t.top',$this->top);
		$criteria->compare('t.articul',$this->articul,true);
		$criteria->compare('t.url',$this->url,true);
		$criteria->compare('t.sort',$this->sort);
                $criteria->compare('set.id_prefix',$prefix);
                $criteria->group = 't.id';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>15,
                        ),
		));
	}
         public function AfterSave(){
            $language = isset($_GET['language']) ? $_GET['language'] : 'ru';
            $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
            $result = 0;
            $product_id = Yii::app()->db->getLastInsertID();
            
            //если добавили новый продукт
            if ($this->getIsNewRecord()){
                //описание
                $prod_lang = new ProductLang;
                $prod_lang->id_prod = $product_id;
                if (!empty($_POST['ProductLang'])) {
                    $prod_lang->attributes = $_POST['ProductLang'];
                    $prod_lang->id_lang  = $id_lang;
                    $result = $prod_lang->save();
                }
                
                //привязываем изображения к продукту
                Yii::app()->runController("image/add/id_prod/".$product_id.'/id_old/0');
                //привязываем файлы к продукту
                Yii::app()->runController("file/add/id_prod/".$product_id.'/id_old/0');
                //привязываем видео к продукту
                Yii::app()->runController("video/add/id_prod/".$product_id.'/id_old/0');
               
            }
            else
            {
                //если добавили новое описание продукта
                
                $count = ProductLang::model()->countByAttributes(array('id_prod'=>$this->id,'id_lang'=>$id_lang));
                if ($count) {
                    $prod_lang = ProductLang::model();
                    if (!empty($_POST['ProductLang'])) {
                        $prod_lang->id_prod  = $this->id;
                        $prod_lang->id_lang  = $id_lang;
                        $prod_lang->attributes = $_POST['ProductLang'];
                        $result = $prod_lang->save();
                    }
                    
                }
                //если изменили описание продукта
                else {
                    $prod_lang = new ProductLang();
                    $prod_lang->id_prod  = $this->id;
                    $prod_lang->id_lang  = $id_lang;
                    $prod_lang->attributes = $_POST['ProductLang'];
                    $result = $prod_lang->save();
                }
                
            }
            //категории
            ProductCategory::model()->deleteAllByAttributes(array('id_prod'=>$prod_lang->id_prod));
            
            foreach ($this->parent as $category){
                $prod_cat = new ProductCategory;
                $prod_cat->id_prod = $prod_lang->id_prod;
                $prod_cat->id_cat = $category;
                $prod_cat->save();
            }
            //добавляем аттрибуты продукта
            AttributeValue::model()->deleteAllByAttributes(array('id_prod'=>$prod_lang->id_prod,'id_lang'=>$id_lang));
            if (!empty($_POST['Attribute'])) {
            foreach ($_POST['Attribute'] as $index => $value){
                    $attribute = new AttributeValue;
                    $attribute->id_attr = $index;
                    $attribute->id_prod = $prod_lang->id_prod;
                    $attribute->id_lang = $id_lang;
                    $attribute->value = $value;
                    $attribute->save();
               }
            }
               
            if ($result)
               Yii::app()->getRequest()->redirect(Yii::app()->createUrl('product/update',
                                                                        array(
                                                                              'id'=>$prod_lang->id_prod,
                                                                              'language' => $language)
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