<?php

/**
 * This is the model class for table "bahan_pengujian".
 *
 * The followings are the available columns in table 'bahan_pengujian':
 * @property integer $id_bahan_pengujian
 * @property integer $id_bahan_jenis
 * @property string $kode_bahan
 * @property string $nama_bahan
 * @property integer $harga_bahan
 * @property string $keterangan_bahan
 */
class BahanPengujian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bahan_pengujian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_bahan_jenis, harga_bahan', 'numerical', 'integerOnly'=>true),
			array('kode_bahan', 'length', 'max'=>20),
			array('nama_bahan, keterangan_bahan', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_bahan_pengujian, id_bahan_jenis, kode_bahan, nama_bahan, harga_bahan, keterangan_bahan', 'safe', 'on'=>'search'),
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
			'id_bahan_pengujian' => 'Id Bahan Pengujian',
			'id_bahan_jenis' => 'Id Bahan Jenis',
			'kode_bahan' => 'Kode Bahan',
			'nama_bahan' => 'Nama Bahan',
			'harga_bahan' => 'Harga Bahan',
			'keterangan_bahan' => 'Keterangan Bahan',
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

		$criteria->compare('id_bahan_pengujian',$this->id_bahan_pengujian);
		$criteria->compare('id_bahan_jenis',$this->id_bahan_jenis);
		$criteria->compare('kode_bahan',$this->kode_bahan,true);
		$criteria->compare('nama_bahan',$this->nama_bahan,true);
		$criteria->compare('harga_bahan',$this->harga_bahan);
		$criteria->compare('keterangan_bahan',$this->keterangan_bahan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BahanPengujian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
