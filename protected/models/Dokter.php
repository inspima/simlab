<?php

/**
 * This is the model class for table "dokter".
 *
 * The followings are the available columns in table 'dokter':
 * @property integer $id_dokter
 * @property integer $id_user
 * @property integer $id_jabatan
 * @property integer $id_instansi
 * @property integer $id_agama
 * @property string $nama_dokter
 * @property string $gelar_depan
 * @property string $gelar_belakang
 * @property string $jenis_kelamin
 * @property string $tgl_lahir
 * @property integer $id_kota_lahir
 * @property string $alamat
 * @property string $telephone
 * @property string $hp
 */
class Dokter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dokter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_jabatan, id_instansi, id_agama, id_kota_lahir', 'numerical', 'integerOnly'=>true),
			array('nama_dokter', 'length', 'max'=>250),
			array('gelar_depan, gelar_belakang', 'length', 'max'=>50),
			array('jenis_kelamin', 'length', 'max'=>2),
			array('alamat', 'length', 'max'=>500),
			array('telephone', 'length', 'max'=>20),
			array('hp', 'length', 'max'=>30),
			array('tgl_lahir', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_dokter, id_user, id_jabatan, id_instansi, id_agama, nama_dokter, gelar_depan, gelar_belakang, jenis_kelamin, tgl_lahir, id_kota_lahir, alamat, telephone, hp', 'safe', 'on'=>'search'),
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
			'id_dokter' => 'Id Dokter',
			'id_user' => 'Id User',
			'id_jabatan' => 'Id Jabatan',
			'id_instansi' => 'Id Instansi',
			'id_agama' => 'Id Agama',
			'nama_dokter' => 'Nama Dokter',
			'gelar_depan' => 'Gelar Depan',
			'gelar_belakang' => 'Gelar Belakang',
			'jenis_kelamin' => 'Jenis Kelamin',
			'tgl_lahir' => 'Tgl Lahir',
			'id_kota_lahir' => 'Id Kota Lahir',
			'alamat' => 'Alamat',
			'telephone' => 'Telephone',
			'hp' => 'Hp',
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

		$criteria->compare('id_dokter',$this->id_dokter);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_jabatan',$this->id_jabatan);
		$criteria->compare('id_instansi',$this->id_instansi);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('nama_dokter',$this->nama_dokter,true);
		$criteria->compare('gelar_depan',$this->gelar_depan,true);
		$criteria->compare('gelar_belakang',$this->gelar_belakang,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('id_kota_lahir',$this->id_kota_lahir);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('hp',$this->hp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dokter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
