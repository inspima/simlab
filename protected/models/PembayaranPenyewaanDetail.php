<?php

/**
 * This is the model class for table "pembayaran_penyewaan_detail".
 *
 * The followings are the available columns in table 'pembayaran_penyewaan_detail':
 * @property integer $id_pembayaran_penyewaan_detail
 * @property integer $id_pembayaran_penyewaan
 * @property string $nama_biaya
 * @property string $besar_biaya
 */
class PembayaranPenyewaanDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pembayaran_penyewaan_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pembayaran_penyewaan', 'numerical', 'integerOnly'=>true),
			array('nama_biaya', 'length', 'max'=>30),
			array('besar_biaya', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pembayaran_penyewaan_detail, id_pembayaran_penyewaan, nama_biaya, besar_biaya', 'safe', 'on'=>'search'),
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
			'id_pembayaran_penyewaan_detail' => 'Id Pembayaran Penyewaan Detail',
			'id_pembayaran_penyewaan' => 'Id Pembayaran Penyewaan',
			'nama_biaya' => 'Nama Biaya',
			'besar_biaya' => 'Besar Biaya',
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

		$criteria->compare('id_pembayaran_penyewaan_detail',$this->id_pembayaran_penyewaan_detail);
		$criteria->compare('id_pembayaran_penyewaan',$this->id_pembayaran_penyewaan);
		$criteria->compare('nama_biaya',$this->nama_biaya,true);
		$criteria->compare('besar_biaya',$this->besar_biaya,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PembayaranPenyewaanDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
