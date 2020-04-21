<?php

/**
 * This is the model class for table "bahan_pasien".
 *
 * The followings are the available columns in table 'bahan_pasien':
 * @property integer $id_bahan_pasien
 * @property integer $id_bahan_pengujian
 * @property integer $id_registrasi_pemeriksaan
 * @property integer $tarif_bahan
 * @property integer $jumlah_bahan
 * @property integer $total_tarif
 */
class BahanPasien extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bahan_pasien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_bahan_pengujian, id_registrasi_pemeriksaan, tarif_bahan, jumlah_bahan, total_tarif', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_bahan_pasien, id_bahan_pengujian, id_registrasi_pemeriksaan, tarif_bahan, jumlah_bahan, total_tarif', 'safe', 'on'=>'search'),
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
			'id_bahan_pasien' => 'Id Bahan Pasien',
			'id_bahan_pengujian' => 'Id Bahan Pengujian',
			'id_registrasi_pemeriksaan' => 'Id Registrasi Pemeriksaan',
			'tarif_bahan' => 'Tarif Bahan',
			'jumlah_bahan' => 'Jumlah Bahan',
			'total_tarif' => 'Total Tarif',
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

		$criteria->compare('id_bahan_pasien',$this->id_bahan_pasien);
		$criteria->compare('id_bahan_pengujian',$this->id_bahan_pengujian);
		$criteria->compare('id_registrasi_pemeriksaan',$this->id_registrasi_pemeriksaan);
		$criteria->compare('tarif_bahan',$this->tarif_bahan);
		$criteria->compare('jumlah_bahan',$this->jumlah_bahan);
		$criteria->compare('total_tarif',$this->total_tarif);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BahanPasien the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
