<?php

/**
 * This is the model class for table "pasien_pemeriksaan".
 *
 * The followings are the available columns in table 'pasien_pemeriksaan':
 * @property integer $id_pasien_pemeriksaan
 * @property integer $id_registrasi_pemeriksaan
 * @property integer $id_pengujian
 * @property integer $id_registrasi_pasien_sample
 * @property integer $id_petugas_pemeriksa
 * @property integer $id_petugas_validasi
 * @property string $tgl_selesai
 * @property string $besar_tarif
 * @property string $besar_tarif_jasa
 * @property string $hasil_pengujian
 * @property string $keterangan_pemeriksaan
 * @property string $status_validasi
 * @property string $potongan
 */
class PasienPemeriksaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pasien_pemeriksaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_registrasi_pemeriksaan, id_pengujian, id_registrasi_pasien_sample, id_petugas_pemeriksa, id_petugas_validasi', 'numerical', 'integerOnly'=>true),
			array('besar_tarif, besar_tarif_jasa, potongan', 'length', 'max'=>10),
			array('hasil_pengujian, keterangan_pemeriksaan', 'length', 'max'=>500),
			array('status_validasi', 'length', 'max'=>1),
			array('tgl_selesai', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pasien_pemeriksaan, id_registrasi_pemeriksaan, id_pengujian, id_registrasi_pasien_sample, id_petugas_pemeriksa, id_petugas_validasi, tgl_selesai, besar_tarif, besar_tarif_jasa, hasil_pengujian, keterangan_pemeriksaan, status_validasi, potongan', 'safe', 'on'=>'search'),
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
			'id_pasien_pemeriksaan' => 'Id Pasien Pemeriksaan',
			'id_registrasi_pemeriksaan' => 'Id Registrasi Pemeriksaan',
			'id_pengujian' => 'Id Pengujian',
			'id_registrasi_pasien_sample' => 'Id Registrasi Pasien Sample',
			'id_petugas_pemeriksa' => 'Id Petugas Pemeriksa',
			'id_petugas_validasi' => 'Id Petugas Validasi',
			'tgl_selesai' => 'Tgl Selesai',
			'besar_tarif' => 'Besar Tarif',
			'besar_tarif_jasa' => 'Besar Tarif Jasa',
			'hasil_pengujian' => 'Hasil Pengujian',
			'keterangan_pemeriksaan' => 'Keterangan Pemeriksaan',
			'status_validasi' => 'Status Validasi',
			'potongan' => 'Potongan',
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

		$criteria->compare('id_pasien_pemeriksaan',$this->id_pasien_pemeriksaan);
		$criteria->compare('id_registrasi_pemeriksaan',$this->id_registrasi_pemeriksaan);
		$criteria->compare('id_pengujian',$this->id_pengujian);
		$criteria->compare('id_registrasi_pasien_sample',$this->id_registrasi_pasien_sample);
		$criteria->compare('id_petugas_pemeriksa',$this->id_petugas_pemeriksa);
		$criteria->compare('id_petugas_validasi',$this->id_petugas_validasi);
		$criteria->compare('tgl_selesai',$this->tgl_selesai,true);
		$criteria->compare('besar_tarif',$this->besar_tarif,true);
		$criteria->compare('besar_tarif_jasa',$this->besar_tarif_jasa,true);
		$criteria->compare('hasil_pengujian',$this->hasil_pengujian,true);
		$criteria->compare('keterangan_pemeriksaan',$this->keterangan_pemeriksaan,true);
		$criteria->compare('status_validasi',$this->status_validasi,true);
		$criteria->compare('potongan',$this->potongan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PasienPemeriksaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
