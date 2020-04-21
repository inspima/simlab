<?php

/**
 * This is the model class for table "pasien_pemeriksaan_hasil".
 *
 * The followings are the available columns in table 'pasien_pemeriksaan_hasil':
 * @property integer $id_pasien_pemeriksaan_hasil
 * @property integer $id_registrasi_pemeriksaan
 * @property integer $id_pengujian
 * @property integer $id_pasien_pemeriksaan
 * @property string $hasil_pengujian
 * @property string $keterangan
 */
class PasienPemeriksaanHasil extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pasien_pemeriksaan_hasil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_registrasi_pemeriksaan, id_pengujian, id_pasien_pemeriksaan', 'numerical', 'integerOnly'=>true),
			array('hasil_pengujian, keterangan', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pasien_pemeriksaan_hasil, id_registrasi_pemeriksaan, id_pengujian, id_pasien_pemeriksaan, hasil_pengujian, keterangan', 'safe', 'on'=>'search'),
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
			'id_pasien_pemeriksaan_hasil' => 'Id Pasien Pemeriksaan Hasil',
			'id_registrasi_pemeriksaan' => 'Id Registrasi Pemeriksaan',
			'id_pengujian' => 'Id Pengujian',
			'id_pasien_pemeriksaan' => 'Id Pasien Pemeriksaan',
			'hasil_pengujian' => 'Hasil Pengujian',
			'keterangan' => 'Keterangan',
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

		$criteria->compare('id_pasien_pemeriksaan_hasil',$this->id_pasien_pemeriksaan_hasil);
		$criteria->compare('id_registrasi_pemeriksaan',$this->id_registrasi_pemeriksaan);
		$criteria->compare('id_pengujian',$this->id_pengujian);
		$criteria->compare('id_pasien_pemeriksaan',$this->id_pasien_pemeriksaan);
		$criteria->compare('hasil_pengujian',$this->hasil_pengujian,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PasienPemeriksaanHasil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
