<?php

/**
 * This is the model class for table "RussianPost".
 *
 * The followings are the available columns in table 'RussianPost':
 * @property integer $id
 * @property string $country
 * @property integer $weight
 * @property double $price
 * @property double $cost
 * @property string $method
 * @property integer $method_id
 * @property integer $country_id
 */
class RussianPost extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RussianPost the static model class
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
		return 'RussianPost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country, weight, price, method, method_id, country_id, index,country, method, city,address,cost', 'required'),
			array('weight, method_id, country_id', 'numerical', 'integerOnly'=>true),
			array('price, cost', 'numerical'),
			array('country, method, city', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, country, weight, price, cost, method, method_id, index, country_id', 'safe', 'on'=>'search'),
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
			'country' => 'Страна',
			'weight' => 'Weight',
			'price' => 'Price',
			'cost' => 'Cost',
			'method' => 'Вид отправления',
			'method_id' => 'Method',
			'country_id' => 'Country',
                        'city'=>'Город',
                        'index'=>'Индекс',
                        'address'=>'Улица,дом,кв',
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
		$criteria->compare('country',$this->country,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('price',$this->price);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('method_id',$this->method_id);
		$criteria->compare('country_id',$this->country_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}