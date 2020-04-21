<?php

/**
 * This is the model class for table "registrasi_penyewaan".
 *
 * The followings are the available columns in table 'registrasi_penyewaan':
 * @property integer $id_registrasi_penyewaan
 * @property integer $id_petugas_penerima
 * @property integer $id_pasien_tipe
 * @property string $no_registrasi_penyewaan
 * @property integer $id_instansi
 * @property string $instansi_asal
 * @property integer $status_biaya
 * @property string $nama_penanggung_jawab
 * @property string $judul_penelitian
 * @property string $tgl_order_masuk
 * @property string $tgl_order_warning
 * @property string $tgl_order_selesai
 * @property string $tgl_surat_permohonan
 * @property string $tgl_surat_daftar
 * @property string $no_surat_permohonan
 * @property string $no_kwitansi_daftar
 * @property string $alamat_saat_ini
 * @property string $no_telp
 * @property string $no_hp
 * @property string $keterangan_registrasi
 * @property string $status_team_penelitian
 * @property string $status_perpanjangan
 * @property string $status_registrasi
 * @property string $status_pembayaran
 * @property string $perpanjangan_ke
 */
class RegistrasiPenyewaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registrasi_penyewaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_biaya', 'required'),
			array('id_petugas_penerima, id_pasien_tipe, id_instansi, status_biaya', 'numerical', 'integerOnly'=>true),
			array('no_registrasi_penyewaan, no_surat_permohonan, no_kwitansi_daftar', 'length', 'max'=>50),
			array('instansi_asal', 'length', 'max'=>200),
			array('nama_penanggung_jawab, alamat_saat_ini', 'length', 'max'=>250),
			array('judul_penelitian', 'length', 'max'=>500),
			array('no_telp', 'length', 'max'=>20),
			array('no_hp', 'length', 'max'=>30),
			array('keterangan_registrasi', 'length', 'max'=>100),
			array('status_team_penelitian, status_perpanjangan, status_registrasi, status_pembayaran, perpanjangan_ke', 'length', 'max'=>1),
			array('tgl_order_masuk, tgl_order_warning, tgl_order_selesai, tgl_surat_permohonan, tgl_surat_daftar', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_registrasi_penyewaan, id_petugas_penerima, id_pasien_tipe, no_registrasi_penyewaan, id_instansi, instansi_asal, status_biaya, nama_penanggung_jawab, judul_penelitian, tgl_order_masuk, tgl_order_warning, tgl_order_selesai, tgl_surat_permohonan, tgl_surat_daftar, no_surat_permohonan, no_kwitansi_daftar, alamat_saat_ini, no_telp, no_hp, keterangan_registrasi, status_team_penelitian, status_perpanjangan, status_registrasi, status_pembayaran, perpanjangan_ke', 'safe', 'on'=>'search'),
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
			'id_registrasi_penyewaan' => 'Id Registrasi Penyewaan',
			'id_petugas_penerima' => 'Id Petugas Penerima',
			'id_pasien_tipe' => 'Id Pasien Tipe',
			'no_registrasi_penyewaan' => 'No Registrasi Penyewaan',
			'id_instansi' => 'Id Instansi',
			'instansi_asal' => 'Instansi Asal',
			'status_biaya' => 'Status Biaya',
			'nama_penanggung_jawab' => 'Nama Penanggung Jawab',
			'judul_penelitian' => 'Judul Penelitian',
			'tgl_order_masuk' => 'Tgl Order Masuk',
			'tgl_order_warning' => 'Tgl Order Warning',
			'tgl_order_selesai' => 'Tgl Order Selesai',
			'tgl_surat_permohonan' => 'Tgl Surat Permohonan',
			'tgl_surat_daftar' => 'Tgl Surat Daftar',
			'no_surat_permohonan' => 'No Surat Permohonan',
			'no_kwitansi_daftar' => 'No Kwitansi Daftar',
			'alamat_saat_ini' => 'Alamat Saat Ini',
			'no_telp' => 'No Telp',
			'no_hp' => 'No Hp',
			'keterangan_registrasi' => 'Keterangan Registrasi',
			'status_team_penelitian' => 'Status Team Penelitian',
			'status_perpanjangan' => 'Status Perpanjangan',
			'status_registrasi' => 'Status Registrasi',
			'status_pembayaran' => 'Status Pembayaran',
			'perpanjangan_ke' => 'Perpanjangan Ke',
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

		$criteria->compare('id_registrasi_penyewaan',$this->id_registrasi_penyewaan);
		$criteria->compare('id_petugas_penerima',$this->id_petugas_penerima);
		$criteria->compare('id_pasien_tipe',$this->id_pasien_tipe);
		$criteria->compare('no_registrasi_penyewaan',$this->no_registrasi_penyewaan,true);
		$criteria->compare('id_instansi',$this->id_instansi);
		$criteria->compare('instansi_asal',$this->instansi_asal,true);
		$criteria->compare('status_biaya',$this->status_biaya);
		$criteria->compare('nama_penanggung_jawab',$this->nama_penanggung_jawab,true);
		$criteria->compare('judul_penelitian',$this->judul_penelitian,true);
		$criteria->compare('tgl_order_masuk',$this->tgl_order_masuk,true);
		$criteria->compare('tgl_order_warning',$this->tgl_order_warning,true);
		$criteria->compare('tgl_order_selesai',$this->tgl_order_selesai,true);
		$criteria->compare('tgl_surat_permohonan',$this->tgl_surat_permohonan,true);
		$criteria->compare('tgl_surat_daftar',$this->tgl_surat_daftar,true);
		$criteria->compare('no_surat_permohonan',$this->no_surat_permohonan,true);
		$criteria->compare('no_kwitansi_daftar',$this->no_kwitansi_daftar,true);
		$criteria->compare('alamat_saat_ini',$this->alamat_saat_ini,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('no_hp',$this->no_hp,true);
		$criteria->compare('keterangan_registrasi',$this->keterangan_registrasi,true);
		$criteria->compare('status_team_penelitian',$this->status_team_penelitian,true);
		$criteria->compare('status_perpanjangan',$this->status_perpanjangan,true);
		$criteria->compare('status_registrasi',$this->status_registrasi,true);
		$criteria->compare('status_pembayaran',$this->status_pembayaran,true);
		$criteria->compare('perpanjangan_ke',$this->perpanjangan_ke,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrasiPenyewaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
