<?php

/**
 * This is the model class for table "pengujian_kelompok".
 *
 * The followings are the available columns in table 'pengujian_kelompok':
 * @property integer $id_pengujian_kelompok
 * @property string $kode_kelompok
 * @property string $nama_pengujian_kelompok
 */
class PengujianKelompok extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengujian_kelompok';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_kelompok', 'length', 'max'=>10),
			array('nama_pengujian_kelompok', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pengujian_kelompok, kode_kelompok, nama_pengujian_kelompok', 'safe', 'on'=>'search'),
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
			'id_pengujian_kelompok' => 'Id Pengujian Kelompok',
			'kode_kelompok' => 'Kode Kelompok',
			'nama_pengujian_kelompok' => 'Nama Pengujian Kelompok',
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

		$criteria->compare('id_pengujian_kelompok',$this->id_pengujian_kelompok);
		$criteria->compare('kode_kelompok',$this->kode_kelompok,true);
		$criteria->compare('nama_pengujian_kelompok',$this->nama_pengujian_kelompok,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PengujianKelompok the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
