<?php

/**
 * This is the model class for table "notifikasi_count".
 *
 * The followings are the available columns in table 'notifikasi_count':
 * @property integer $id_notifikasi_count
 * @property integer $total
 * @property integer $baru
 * @property integer $proses
 * @property integer $sudah
 * @property integer $order_warning
 */
class NotifikasiCount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notifikasi_count';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total, baru, proses, sudah, order_warning', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_notifikasi_count, total, baru, proses, sudah, order_warning', 'safe', 'on'=>'search'),
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
			'id_notifikasi_count' => 'Id Notifikasi Count',
			'total' => 'Total',
			'baru' => 'Baru',
			'proses' => 'Proses',
			'sudah' => 'Sudah',
			'order_warning' => 'Order Warning',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_notifikasi_count',$this->id_notifikasi_count);
		$criteria->compare('total',$this->total);
		$criteria->compare('baru',$this->baru);
		$criteria->compare('proses',$this->proses);
		$criteria->compare('sudah',$this->sudah);
		$criteria->compare('order_warning',$this->order_warning);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotifikasiCount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
