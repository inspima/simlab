<?php

/**
 * This is the model class for table "pemeriksaan_sample".
 *
 * The followings are the available columns in table 'pemeriksaan_sample':
 * @property integer $id_pemeriksaan_sample
 * @property integer $id_registrasi_pasien_sample
 * @property integer $id_pasien_pemeriksaan
 */
class PemeriksaanSample extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pemeriksaan_sample';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_registrasi_pasien_sample, id_pasien_pemeriksaan', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pemeriksaan_sample, id_registrasi_pasien_sample, id_pasien_pemeriksaan', 'safe', 'on'=>'search'),
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
			'id_pemeriksaan_sample' => 'Id Pemeriksaan Sample',
			'id_registrasi_pasien_sample' => 'Id Registrasi Pasien Sample',
			'id_pasien_pemeriksaan' => 'Id Pasien Pemeriksaan',
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

		$criteria->compare('id_pemeriksaan_sample',$this->id_pemeriksaan_sample);
		$criteria->compare('id_registrasi_pasien_sample',$this->id_registrasi_pasien_sample);
		$criteria->compare('id_pasien_pemeriksaan',$this->id_pasien_pemeriksaan);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PemeriksaanSample the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
