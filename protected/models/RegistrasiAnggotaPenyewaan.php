<?php

/**
 * This is the model class for table "registrasi_anggota_penyewaan".
 *
 * The followings are the available columns in table 'registrasi_anggota_penyewaan':
 * @property integer $id_registrasi_anggota_penyewaan
 * @property string $no_registrasi_penyewaan
 * @property string $nama_anggota
 * @property string $judul_anggota
 * @property string $status_anggota
 */
class RegistrasiAnggotaPenyewaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registrasi_anggota_penyewaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_registrasi_penyewaan', 'length', 'max'=>20),
			array('nama_anggota', 'length', 'max'=>250),
			array('judul_anggota', 'length', 'max'=>500),
			array('status_anggota', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_registrasi_anggota_penyewaan, no_registrasi_penyewaan, nama_anggota, judul_anggota, status_anggota', 'safe', 'on'=>'search'),
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
			'id_registrasi_anggota_penyewaan' => 'Id Registrasi Anggota Penyewaan',
			'no_registrasi_penyewaan' => 'No Registrasi Penyewaan',
			'nama_anggota' => 'Nama Anggota',
			'judul_anggota' => 'Judul Anggota',
			'status_anggota' => 'Status Anggota',
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

		$criteria->compare('id_registrasi_anggota_penyewaan',$this->id_registrasi_anggota_penyewaan);
		$criteria->compare('no_registrasi_penyewaan',$this->no_registrasi_penyewaan,true);
		$criteria->compare('nama_anggota',$this->nama_anggota,true);
		$criteria->compare('judul_anggota',$this->judul_anggota,true);
		$criteria->compare('status_anggota',$this->status_anggota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrasiAnggotaPenyewaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
