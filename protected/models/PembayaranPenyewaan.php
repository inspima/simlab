<?php

/**
 * This is the model class for table "pembayaran_penyewaan".
 *
 * The followings are the available columns in table 'pembayaran_penyewaan':
 * @property integer $id_pembayaran_penyewaan
 * @property string $no_registrasi_penyewaan
 * @property string $no_kwitansi_pembayaran
 * @property string $total_dibayar
 * @property string $total_biaya
 * @property string $potongan
 * @property string $waktu_pembayaran
 * @property string $status_pembayaran
 * @property string $via_pembayaran
 * @property string $keterangan
 * @property string $tgl_jatuh_tempo
 */
class PembayaranPenyewaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pembayaran_penyewaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_registrasi_penyewaan, no_kwitansi_pembayaran', 'length', 'max'=>30),
			array('total_dibayar, total_biaya, potongan', 'length', 'max'=>20),
			array('status_pembayaran, via_pembayaran', 'length', 'max'=>1),
			array('keterangan', 'length', 'max'=>100),
			array('waktu_pembayaran, tgl_jatuh_tempo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pembayaran_penyewaan, no_registrasi_penyewaan, no_kwitansi_pembayaran, total_dibayar, total_biaya, potongan, waktu_pembayaran, status_pembayaran, via_pembayaran, keterangan, tgl_jatuh_tempo', 'safe', 'on'=>'search'),
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
			'id_pembayaran_penyewaan' => 'Id Pembayaran Penyewaan',
			'no_registrasi_penyewaan' => 'No Registrasi Penyewaan',
			'no_kwitansi_pembayaran' => 'No Kwitansi Pembayaran',
			'total_dibayar' => 'Total Dibayar',
			'total_biaya' => 'Total Biaya',
			'potongan' => 'Potongan',
			'waktu_pembayaran' => 'Waktu Pembayaran',
			'status_pembayaran' => 'Status Pembayaran',
			'via_pembayaran' => 'Via Pembayaran',
			'keterangan' => 'Keterangan',
			'tgl_jatuh_tempo' => 'Tgl Jatuh Tempo',
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

		$criteria->compare('id_pembayaran_penyewaan',$this->id_pembayaran_penyewaan);
		$criteria->compare('no_registrasi_penyewaan',$this->no_registrasi_penyewaan,true);
		$criteria->compare('no_kwitansi_pembayaran',$this->no_kwitansi_pembayaran,true);
		$criteria->compare('total_dibayar',$this->total_dibayar,true);
		$criteria->compare('total_biaya',$this->total_biaya,true);
		$criteria->compare('potongan',$this->potongan,true);
		$criteria->compare('waktu_pembayaran',$this->waktu_pembayaran,true);
		$criteria->compare('status_pembayaran',$this->status_pembayaran,true);
		$criteria->compare('via_pembayaran',$this->via_pembayaran,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('tgl_jatuh_tempo',$this->tgl_jatuh_tempo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PembayaranPenyewaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
