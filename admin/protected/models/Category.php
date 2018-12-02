<?php

/**
 * This is the model class for table "Category".
 *
 * The followings are the available columns in table 'Category':
 * @property integer $id
 * @property integer $parent
 * @property string $image
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Products[] $products
 */
class Category extends CActiveRecord
{
        public static $list_data = array('.Корневой');
	/**
	 * Returns the static model of the specified AR class.
	 * @return Category the static model class
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
		return Yii::app()->params['table_suffix'].'Category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified, parent, active, prefix', 'required'),
			array('parent, active, prefix', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>50),
                        array('url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent, image, active', 'safe', 'on'=>'search'),
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
                    'products'=>array(self::MANY_MANY,'Product','ProductCategory(id_cat,id_prod)'),
                    'cat_language'=>array(self::HAS_MANY,'CategoryLang','id'),
                    'language'=>array(self::MANY_MANY,'Language','CategoryLang(id,id_lang)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent' => 'Родитель',
			'image' => 'Фото',
			'active' => 'Активный',
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
                $condition = '';
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('active',$this->active);
                if (isset($_GET['CategoryLang']['name'])){
                     $condition = "and name like'%".$_GET['CategoryLang']['name']."%'";
                }
                $criteria->join = 'INNER JOIN CategoryLang as cl using(id)';
                $criteria->condition = "cl.id_lang=4 $condition";
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}
        public function AfterSave(){
            $language = isset($_GET['language']) ? $_GET['language'] : 'ru';
            $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
            
            //если добавили новую категорию
            if ($this->getIsNewRecord()){
                $cat_lang = new CategoryLang;
                $cat_lang->id = Yii::app()->db->getLastInsertID();
                if (!empty($_POST)){
                    $cat_lang->attributes = $_POST['CategoryLang'];
                    $cat_lang->id_group = $_POST['CategoryLang']['id_group'][0];
                    $cat_lang->id_lang  = $id_lang;
                    if ($cat_lang->validate())
                        $result = $cat_lang->save();
                    }
                
            }
            else
            {
                $count = CategoryLang::model()->countByAttributes(array('id'=>$this->id,'id_lang'=>$id_lang));
                if ($count) {
                    $cat_lang = CategoryLang::model();
                    $cat_lang->id  = $this->id;
                    $cat_lang->id_lang  = $id_lang;
                    $cat_lang->attributes = $_POST['CategoryLang'];
                    $cat_lang->id_group = $_POST['CategoryLang']['id_group'][0];
                    $cat_lang->save();
                    
                }
                else {
                    $cat_lang = new CategoryLang();
                    $cat_lang->id  = $this->id;
                    $cat_lang->id_lang  = $id_lang;
                    $cat_lang->attributes = $_POST['CategoryLang'];
                    $cat_lang->id_group = $_POST['CategoryLang']['id_group'][0];
                    $cat_lang->save();
                }

            }
            
            //добавляем аттрибуты продукта
            AttributeCategory::model()->deleteAllByAttributes(array('id_cat'=>$cat_lang->id,'id_lang'=>$id_lang));
            if (!empty($_POST['Attribute'])) {
                
                foreach ($_POST['Attribute'] as $index => $value){
                        $attribute = new AttributeCategory;
                        $attribute->id_attr = $index;
                        $attribute->id_cat = $cat_lang->id;
                        $attribute->id_lang = $id_lang;
                        $attribute->value = $value;
                        $attribute->save();
                   }
            }
            
            
                Yii::app()->getRequest()->redirect(Yii::app()->createUrl('category/update',array('id'=>$cat_lang->id)));
            
            
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
        public static function GetParent($parent,$level,$lang){
            $level++;
            foreach (Category::model()->with('cat_language')->findAll("parent=$parent and id_lang=$lang") as $index=>$cat){
                $prefix='';
                for ($i=1;$i<=$level;$i++) {
                    $prefix .= '. ';
                }
                Category::$list_data[$cat->cat_language[0]->id] = $prefix.$cat->cat_language[0]->name;
                Category::GetParent($cat->id,$level,$lang);
            }
            
        }
}