<?php

/**
 * This is the model class for table "registrasi_pemeriksaan".
 *
 * The followings are the available columns in table 'registrasi_pemeriksaan':
 * @property integer $id_registrasi_pemeriksaan
 * @property integer $id_pasien
 * @property integer $id_pasien_tipe
 * @property integer $id_dokter_pengirim
 * @property integer $id_instansi
 * @property integer $id_petugas_penerima
 * @property string $no_registrasi
 * @property string $waktu_registrasi
 * @property string $keluhan_diagnosa
 * @property string $keterangan_registrasi
 * @property string $status_registrasi
 * @property string $status_pembayaran
 * @property integer $jumlah_print_pemeriksaan
 */
class RegistrasiPemeriksaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registrasi_pemeriksaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pasien, id_pasien_tipe, id_dokter_pengirim, id_instansi, id_petugas_penerima, jumlah_print_pemeriksaan', 'numerical', 'integerOnly'=>true),
			array('no_registrasi', 'length', 'max'=>50),
			array('keluhan_diagnosa, keterangan_registrasi', 'length', 'max'=>200),
			array('status_registrasi, status_pembayaran', 'length', 'max'=>1),
			array('waktu_registrasi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_registrasi_pemeriksaan, id_pasien, id_pasien_tipe, id_dokter_pengirim, id_instansi, id_petugas_penerima, no_registrasi, waktu_registrasi, keluhan_diagnosa, keterangan_registrasi, status_registrasi, status_pembayaran, jumlah_print_pemeriksaan', 'safe', 'on'=>'search'),
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
			'id_registrasi_pemeriksaan' => 'Id Registrasi Pemeriksaan',
			'id_pasien' => 'Id Pasien',
			'id_pasien_tipe' => 'Id Pasien Tipe',
			'id_dokter_pengirim' => 'Id Dokter Pengirim',
			'id_instansi' => 'Id Instansi',
			'id_petugas_penerima' => 'Id Petugas Penerima',
			'no_registrasi' => 'No Registrasi',
			'waktu_registrasi' => 'Waktu Registrasi',
			'keluhan_diagnosa' => 'Keluhan Diagnosa',
			'keterangan_registrasi' => 'Keterangan Registrasi',
			'status_registrasi' => 'Status Registrasi',
			'status_pembayaran' => 'Status Pembayaran',
			'jumlah_print_pemeriksaan' => 'Jumlah Print Pemeriksaan',
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

		$criteria->compare('id_registrasi_pemeriksaan',$this->id_registrasi_pemeriksaan);
		$criteria->compare('id_pasien',$this->id_pasien);
		$criteria->compare('id_pasien_tipe',$this->id_pasien_tipe);
		$criteria->compare('id_dokter_pengirim',$this->id_dokter_pengirim);
		$criteria->compare('id_instansi',$this->id_instansi);
		$criteria->compare('id_petugas_penerima',$this->id_petugas_penerima);
		$criteria->compare('no_registrasi',$this->no_registrasi,true);
		$criteria->compare('waktu_registrasi',$this->waktu_registrasi,true);
		$criteria->compare('keluhan_diagnosa',$this->keluhan_diagnosa,true);
		$criteria->compare('keterangan_registrasi',$this->keterangan_registrasi,true);
		$criteria->compare('status_registrasi',$this->status_registrasi,true);
		$criteria->compare('status_pembayaran',$this->status_pembayaran,true);
		$criteria->compare('jumlah_print_pemeriksaan',$this->jumlah_print_pemeriksaan);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrasiPemeriksaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
