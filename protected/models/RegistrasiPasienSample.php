<?php

/**
 * This is the model class for table "registrasi_pasien_sample".
 *
 * The followings are the available columns in table 'registrasi_pasien_sample':
 * @property integer $id_registrasi_pasien_sample
 * @property integer $id_registrasi_pemeriksaan
 * @property integer $id_sample
 * @property string $kode_sample
 * @property string $waktu_masuk
 * @property integer $jumlah_sample
 * @property string $keterangan_sample
 */
class RegistrasiPasienSample extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registrasi_pasien_sample';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_registrasi_pemeriksaan, id_sample, jumlah_sample', 'numerical', 'integerOnly'=>true),
			array('kode_sample', 'length', 'max'=>50),
			array('keterangan_sample', 'length', 'max'=>100),
			array('waktu_masuk', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_registrasi_pasien_sample, id_registrasi_pemeriksaan, id_sample, kode_sample, waktu_masuk, jumlah_sample, keterangan_sample', 'safe', 'on'=>'search'),
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
			'id_registrasi_pasien_sample' => 'Id Registrasi Pasien Sample',
			'id_registrasi_pemeriksaan' => 'Id Registrasi Pemeriksaan',
			'id_sample' => 'Id Sample',
			'kode_sample' => 'Kode Sample',
			'waktu_masuk' => 'Waktu Masuk',
			'jumlah_sample' => 'Jumlah Sample',
			'keterangan_sample' => 'Keterangan Sample',
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

		$criteria->compare('id_registrasi_pasien_sample',$this->id_registrasi_pasien_sample);
		$criteria->compare('id_registrasi_pemeriksaan',$this->id_registrasi_pemeriksaan);
		$criteria->compare('id_sample',$this->id_sample);
		$criteria->compare('kode_sample',$this->kode_sample,true);
		$criteria->compare('waktu_masuk',$this->waktu_masuk,true);
		$criteria->compare('jumlah_sample',$this->jumlah_sample);
		$criteria->compare('keterangan_sample',$this->keterangan_sample,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrasiPasienSample the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
