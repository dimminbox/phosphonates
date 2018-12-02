<?php

/**
 * This is the model class for table "Manufacture".
 *
 * The followings are the available columns in table 'Manufacture':
 * @property integer $id
 * @property string $image
 * @property string $date_added
 * @property string $date_modified
 * @property integer $active
 */
class Manufacture extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Manufacture the static model class
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
		return 'Manufacture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, active', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>255),
			array('date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image, date_added, date_modified, active', 'safe', 'on'=>'search'),
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
			'image' => 'Image',
			'date_added' => 'Date Added',
			'date_modified' => 'Date Modified',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function AfterSave(){
            $language = isset($_GET['language']) ? $_GET['language'] : 'ru';
            $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
            if ($this->getIsNewRecord()){
                $man_lang = new ManufactureLang;
                $man_lang->attributes = $_POST['ManufactureLang'];
                $man_lang->id_man = Yii::app()->db->getLastInsertID();
                $man_lang->id_lang  = $id_lang;
                $man_lang->save();
                /*if ($news_lang->save()){
                    Yii::app()->getRequest()->redirect(Yii::app()->createUrl('category/update',array('id'=>$cat_lang->id)));
                }*/
                
            }
           else
            {
                $count = ManufactureLang::model()->countByAttributes(array('id_man'=>$this->id,'id_lang'=>$id_lang));
                if ($count) {
                    $man_lang = ManufactureLang::model();
                    $man_lang->id_man  = $this->id;
                    $man_lang->id_lang  = $id_lang;
                    $man_lang->attributes = $_POST['ManufactureLang'];
                    $man_lang->save();
                    
                }
                else {
                    $man_lang = new ManufactureLang();
                    $man_lang->id_man  = $this->id;
                    $man_lang->id_lang  = $id_lang;
                    $man_lang->attributes = $_POST['ManufactureLang'];
                    $man_lang->save();
                }

            }
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