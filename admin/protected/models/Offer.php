<?php

/**
 * This is the model class for table "Offer".
 *
 * The followings are the available columns in table 'Offer':
 * @property integer $id
 * @property string $image
 * @property integer $active
 * @property string $date_begin
 * @property string $date_end
 * @property string $date_added
 * @property string $date_modified
 */
class Offer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Offer the static model class
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
		return 'Offer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, date_begin, date_end, date_added', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>1024),
			array('date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image, active, date_begin, date_end, date_added, date_modified', 'safe', 'on'=>'search'),
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
			'active' => 'Active',
			'date_begin' => 'Date Begin',
			'date_end' => 'Date End',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('date_begin',$this->date_begin,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public function AfterSave(){
            $language = isset($_GET['language']) ? $_GET['language'] : 'ru';
            $id_lang = Language::model()->findByAttributes(array('code'=>$language))->id;
            if ($this->getIsNewRecord()){
                $of_lang = new OfferLang;
                $of_lang->attributes = $_POST['OfferLang'];
                $of_lang->id_offer = Yii::app()->db->getLastInsertID();
                $of_lang->id_lang  = $id_lang;
                $of_lang->save();
                /*if ($news_lang->save()){
                    Yii::app()->getRequest()->redirect(Yii::app()->createUrl('category/update',array('id'=>$cat_lang->id)));
                }*/
                
            }
           else
            {
                $count = OfferLang::model()->countByAttributes(array('id_offer'=>$this->id,'id_lang'=>$id_lang));
                if ($count) {
                    $of_lang = OfferLang::model();
                    $of_lang->id_offer  = $this->id;
                    $of_lang->id_lang  = $id_lang;
                    $of_lang->attributes = $_POST['OfferLang'];
                    $of_lang->save();
                    
                }
                else {
                    $of_lang = new OfferLang();
                    $of_lang->id_offer  = $this->id;
                    $of_lang->id_lang  = $id_lang;
                    $of_lang->attributes = $_POST['OfferLang'];
                    $of_lang->save();
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