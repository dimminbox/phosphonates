<?php

/**
 * This is the model class for table "Major".
 *
 * The followings are the available columns in table 'Major':
 * @property integer $id
 * @property integer $id_country
 * @property string $country
 * @property integer $region_id
 * @property string $region
 * @property string $form
 * @property integer $weight
 * @property double $cost
 * @property double $price
 * @property double $insurance
 * @property string $delivery_time
 * @property integer $order_id
 */
class Major extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Major the static model class
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
		return 'Major';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_country, region_id, form, weight, cost, price, insurance, delivery_time, order_id', 'required'),
			array('id_country, region_id, weight, order_id', 'numerical', 'integerOnly'=>true),
			array('cost, price, insurance', 'numerical'),
			array('delivery_time', 'length', 'max'=>255),
			array('form', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_country, region_id, form, weight, cost, price, insurance, delivery_time, order_id', 'safe', 'on'=>'search'),
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
			'id_country' => 'Id Country',
			'region_id' => 'Region',
			'form' => 'Form',
			'weight' => 'Weight',
			'cost' => 'Cost',
			'price' => 'Price',
			'insurance' => 'Insurance',
			'delivery_time' => 'Delivery Time',
			'order_id' => 'Order',
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
		$criteria->compare('id_country',$this->id_country);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('form',$this->form,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('price',$this->price);
		$criteria->compare('insurance',$this->insurance);
		$criteria->compare('delivery_time',$this->delivery_time,true);
		$criteria->compare('order_id',$this->order_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}