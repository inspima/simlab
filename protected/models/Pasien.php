<?php

/**
 * This is the model class for table "pasien".
 *
 * The followings are the available columns in table 'pasien':
 * @property integer $id_pasien
 * @property string $no_id_pasien
 * @property string $nama
 * @property string $jenis_kelamin
 * @property integer $id_agama
 * @property integer $id_kota_lahir
 * @property string $tgl_lahir
 * @property string $alamat
 * @property string $umur
 * @property string $telephone
 * @property string $hp
 */
class Pasien extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pasien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_agama, id_kota_lahir', 'numerical', 'integerOnly'=>true),
			array('no_id_pasien', 'length', 'max'=>50),
			array('nama', 'length', 'max'=>250),
			array('jenis_kelamin', 'length', 'max'=>1),
			array('alamat', 'length', 'max'=>500),
			array('umur, telephone, hp', 'length', 'max'=>30),
			array('tgl_lahir', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pasien, no_id_pasien, nama, jenis_kelamin, id_agama, id_kota_lahir, tgl_lahir, alamat, umur, telephone, hp', 'safe', 'on'=>'search'),
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
			'id_pasien' => 'Id Pasien',
			'no_id_pasien' => 'No Id Pasien',
			'nama' => 'Nama',
			'jenis_kelamin' => 'Jenis Kelamin',
			'id_agama' => 'Id Agama',
			'id_kota_lahir' => 'Id Kota Lahir',
			'tgl_lahir' => 'Tgl Lahir',
			'alamat' => 'Alamat',
			'umur' => 'Umur',
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

		$criteria->compare('id_pasien',$this->id_pasien);
		$criteria->compare('no_id_pasien',$this->no_id_pasien,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('id_agama',$this->id_agama);
		$criteria->compare('id_kota_lahir',$this->id_kota_lahir);
		$criteria->compare('tgl_lahir',$this->tgl_lahir,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('umur',$this->umur,true);
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
	 * @return Pasien the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
