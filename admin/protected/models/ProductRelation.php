<?php

/**
 * This is the model class for table "ProductRelation".
 *
 * The followings are the available columns in table 'ProductRelation':
 * @property integer $id
 * @property integer $id_prod
 * @property integer $id_prod_rel
 * @property integer $active
 * @property string $date_added
 * @property string $date_modified
 */
class ProductRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductRelation the static model class
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
		return 'ProductRelation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_prod, id_prod_rel, date_added', 'required'),
			array('id_prod, id_prod_rel, active', 'numerical', 'integerOnly'=>true),
			array('date_modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_prod, id_prod_rel, active, date_added, date_modified', 'safe', 'on'=>'search'),
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
                    'prod_rel_1' => array(self::HAS_ONE, 'ProductLang', 'id_prod'),
                    'prod_rel_2' => array(self::HAS_ONE, 'ProductLang', array('id_prod'=>'id_prod_rel')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_prod' => 'Id Prod',
			'id_prod_rel' => 'Id Prod Rel',
			'active' => 'Active',
			'date_added' => 'Date Added',
			'date_modified' => 'Date Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                
                $criteria->with = array('prod_rel_1','prod_rel_2');
		$criteria->compare('t.id_prod',$id);
		$criteria->compare('id_prod_rel',$this->id_prod_rel);
		$criteria->compare('active',$this->active);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);

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
}