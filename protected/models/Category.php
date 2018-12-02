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
        public static function getTree($id) {
            $list_data = array();
	    $criteria = new CDbCriteria;
	    $criteria->with = array('cat_language','category');
	    $criteria->together = true;
	    $criteria->compare('parent',$id);
	    $criteria->compare('active',1);
	    $criteria->order = 't.name ASC';
            $categories = CategoryLang::model()->findAll($criteria);
            foreach ($categories as $category){
                
                if ($category->category[0]->url =='')
                    $list['text'] = CCHtml::link($category->name,array('/category/'.Translite::rusencode($category->name)."-".$category->id));
                else
                    $list['text'] = CCHtml::link($category->name,array('/category/'.$category->category[0]->url));
                $list['children'] = Category::getTree($category->id);
                $list_data[] = $list;
            }
            
            return $list_data;
        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified, parent, active', 'required'),
			array('parent, active', 'numerical', 'integerOnly'=>true),
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
                    'products'=>array(self::MANY_MANY,'ProductLang','ProductCategory(id_cat,id_prod)',),
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
			'parent' => 'Parent',
			'image' => 'Image',
			'active' => 'Active',
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
        public static function GetParent($parent,$level,$lang){
            $level++;
            foreach (Category::model()->with('cat_language')->findAll("parent=$parent and id_lang=$lang") as $index=>$cat){
                $prefix='';
                for ($i=1;$i<=$level;$i++) {
                    $prefix .= '. ';
                }
                Category::$list_data[] = $prefix.$cat->cat_language[0]->name;
                Category::GetParent($cat->id,$level,$lang);
            }
            
        }
}