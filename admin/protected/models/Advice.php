<?php

/**
 * This is the model class for table "News".
 *
 * The followings are the available columns in table 'News':
 * @property integer $news_id
 * @property string $image
 * @property string $date_added
 * @property string $date_modified
 * @property integer $active
 * @property integer $sort
 */
class Advice extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Advice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, date_modified, active', 'required'),
			array('active, sort, id_prefix', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>128),
			array('date_added, date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image, date_added, date_modified, active, sort', 'safe', 'on'=>'search'),
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
                    'advice_lang' => array(self::HAS_ONE, 'AdviceLang', 'id_advice'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Advice',
			'image' => 'Image',
			'date_added' => 'Date Added',
			'date_modified' => 'Date Modified',
			'active' => 'Active',
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
                
                $criteria->with = array('advice_lang');
		$criteria->compare('id',$this->id);
		$criteria->compare('active',$this->active);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function AfterSave(){
            $language = isset($_GET['language']) ? $_GET['language'] : 'ru';
            $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
            if ($this->getIsNewRecord()){
                $advice_lang = new AdviceLang;
                $advice_lang->attributes = $_POST['AdviceLang'];
                $advice_lang->id_advice = Yii::app()->db->getLastInsertID();
                $advice_lang->id_lang  = $id_lang;
                $advice_lang->save();
                
                
            }
           else
            {
                $count = AdviceLang::model()->countByAttributes(array('id_advice'=>$this->id,'id_lang'=>$id_lang));
                if ($count) {
                    $advice_lang = AdviceLang::model();
                    $advice_lang->id_advice  = $this->id;
                    $advice_lang->id_lang  = $id_lang;
                    $advice_lang->attributes = $_POST['AdviceLang'];
                    $advice_lang->save();
                    
                }
                else {
                    $advice_lang = new AdviceLang();
                    $advice_lang->id_advice  = $this->id;
                    $advice_lang->id_lang  = $id_lang;
                    $advice_lang->attributes = $_POST['AdviceLang'];
                    $advice_lang->save();
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