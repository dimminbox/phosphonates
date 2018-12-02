<?php

/**
 * This is the model class for table "Order".
 *
 * The followings are the available columns in table 'Order':
 * @property integer $id
 * @property integer $id_user
 * @property string $date_created
 * @property string $date_posted
 * @property string $date_payment
 * @property integer $id_delivery
 * @property double $summ
 * @property integer $delivery_type
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Order the static model class
	 */
        public $lastname;
        public $firstname;
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, date_created, id_delivery, summ, delivery_type', 'required'),
			array('id_user, id_delivery, delivery_type', 'numerical', 'integerOnly'=>true),
			array('summ', 'numerical'),
                        array('text','length', 'min'=>0),
                        array('notification','boolean'),
			array('date_posted, date_payment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, date_created, date_posted, date_payment, id_delivery, summ, delivery_type', 'safe', 'on'=>'search'),
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
                    'products' => array(self::BELONGS_TO, 'OrderProduct', 'id'),
                    'code' => array(self::HAS_ONE, 'Code', array('id'=>'id_code')),
                    'major' => array(self::BELONGS_TO, 'Major', 'id_delivery'),
                    'russianpost' => array(self::BELONGS_TO, 'RussianPost', 'id_delivery'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Номер' => 'Номер',
			'id_user' => 'Id User',
			'date_created' => 'Дата создания',
			'date_posted' => 'Дата отправки',
			'date_payment' => 'Дата оплаты',
			'id_delivery' => 'Id Delivery',
			'summ' => 'Сумма',
			'delivery_type' => 'Delivery Type',
                        'notification' => 'Уведомление'
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_posted',$this->date_posted,true);
		$criteria->compare('date_payment',$this->date_payment,true);
		$criteria->compare('id_delivery',$this->id_delivery);
		$criteria->compare('summ',$this->summ);
		$criteria->compare('delivery_type',$this->delivery_type);

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
				$this->date_created=date('Y-m-d H:i:s');	
			}
			return true;
		}
		else
			return false;
	}
}