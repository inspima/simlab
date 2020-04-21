<?php

/**
 * This is the model class for table "pasien_penyewaan_barang".
 *
 * The followings are the available columns in table 'pasien_penyewaan_barang':
 * @property integer $id_pasien_penyewaan_barang
 * @property string $no_registrasi_penyewaan
 * @property integer $id_barang_sewa_tarif
 * @property string $tgl_awal_penyewaan
 * @property string $tgl_akhir_penyewaan
 * @property string $lama_sewa
 * @property string $besar_tarif
 * @property string $keterangan_penyewaan
 */
class PasienPenyewaanBarang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pasien_penyewaan_barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_barang_sewa_tarif', 'numerical', 'integerOnly'=>true),
			array('no_registrasi_penyewaan', 'length', 'max'=>30),
			array('lama_sewa, besar_tarif', 'length', 'max'=>10),
			array('keterangan_penyewaan', 'length', 'max'=>100),
			array('tgl_awal_penyewaan, tgl_akhir_penyewaan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pasien_penyewaan_barang, no_registrasi_penyewaan, id_barang_sewa_tarif, tgl_awal_penyewaan, tgl_akhir_penyewaan, lama_sewa, besar_tarif, keterangan_penyewaan', 'safe', 'on'=>'search'),
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
			'id_pasien_penyewaan_barang' => 'Id Pasien Penyewaan Barang',
			'no_registrasi_penyewaan' => 'No Registrasi Penyewaan',
			'id_barang_sewa_tarif' => 'Id Barang Sewa Tarif',
			'tgl_awal_penyewaan' => 'Tgl Awal Penyewaan',
			'tgl_akhir_penyewaan' => 'Tgl Akhir Penyewaan',
			'lama_sewa' => 'Lama Sewa',
			'besar_tarif' => 'Besar Tarif',
			'keterangan_penyewaan' => 'Keterangan Penyewaan',
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

		$criteria->compare('id_pasien_penyewaan_barang',$this->id_pasien_penyewaan_barang);
		$criteria->compare('no_registrasi_penyewaan',$this->no_registrasi_penyewaan,true);
		$criteria->compare('id_barang_sewa_tarif',$this->id_barang_sewa_tarif);
		$criteria->compare('tgl_awal_penyewaan',$this->tgl_awal_penyewaan,true);
		$criteria->compare('tgl_akhir_penyewaan',$this->tgl_akhir_penyewaan,true);
		$criteria->compare('lama_sewa',$this->lama_sewa,true);
		$criteria->compare('besar_tarif',$this->besar_tarif,true);
		$criteria->compare('keterangan_penyewaan',$this->keterangan_penyewaan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PasienPenyewaanBarang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
