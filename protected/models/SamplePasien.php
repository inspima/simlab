<?php

/**
 * This is the model class for table "sample_pasien".
 *
 * The followings are the available columns in table 'sample_pasien':
 * @property integer $id_sample_pasien
 * @property integer $id_pasien
 * @property integer $id_registrasi
 * @property integer $id_sample
 * @property string $waktu_masuk
 * @property string $keterangan_sample
 */
class SamplePasien extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sample_pasien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pasien, id_registrasi, id_sample', 'numerical', 'integerOnly'=>true),
			array('keterangan_sample', 'length', 'max'=>100),
			array('waktu_masuk', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_sample_pasien, id_pasien, id_registrasi, id_sample, waktu_masuk, keterangan_sample', 'safe', 'on'=>'search'),
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
			'id_sample_pasien' => 'Id Sample Pasien',
			'id_pasien' => 'Id Pasien',
			'id_registrasi' => 'Id Registrasi',
			'id_sample' => 'Id Sample',
			'waktu_masuk' => 'Waktu Masuk',
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

		$criteria->compare('id_sample_pasien',$this->id_sample_pasien);
		$criteria->compare('id_pasien',$this->id_pasien);
		$criteria->compare('id_registrasi',$this->id_registrasi);
		$criteria->compare('id_sample',$this->id_sample);
		$criteria->compare('waktu_masuk',$this->waktu_masuk,true);
		$criteria->compare('keterangan_sample',$this->keterangan_sample,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SamplePasien the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
