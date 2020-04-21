<?php

/**
 * This is the model class for table "penyewaan_biaya".
 *
 * The followings are the available columns in table 'penyewaan_biaya':
 * @property integer $id_registrasi_penyewaan_biaya
 * @property string $nama_biaya
 * @property string $besar_biaya
 * @property string $besar_deposit
 * @property string $besar_biaya_administrasi
 * @property string $toal_biaya
 * @property string $status_biaya
 */
class PenyewaanBiaya extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'penyewaan_biaya';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_biaya', 'length', 'max'=>200),
			array('besar_biaya, besar_deposit, besar_biaya_administrasi, toal_biaya', 'length', 'max'=>10),
			array('status_biaya', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_registrasi_penyewaan_biaya, nama_biaya, besar_biaya, besar_deposit, besar_biaya_administrasi, toal_biaya, status_biaya', 'safe', 'on'=>'search'),
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
			'id_registrasi_penyewaan_biaya' => 'Id Registrasi Penyewaan Biaya',
			'nama_biaya' => 'Nama Biaya',
			'besar_biaya' => 'Besar Biaya',
			'besar_deposit' => 'Besar Deposit',
			'besar_biaya_administrasi' => 'Besar Biaya Administrasi',
			'toal_biaya' => 'Toal Biaya',
			'status_biaya' => 'Status Biaya',
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

		$criteria->compare('id_registrasi_penyewaan_biaya',$this->id_registrasi_penyewaan_biaya);
		$criteria->compare('nama_biaya',$this->nama_biaya,true);
		$criteria->compare('besar_biaya',$this->besar_biaya,true);
		$criteria->compare('besar_deposit',$this->besar_deposit,true);
		$criteria->compare('besar_biaya_administrasi',$this->besar_biaya_administrasi,true);
		$criteria->compare('toal_biaya',$this->toal_biaya,true);
		$criteria->compare('status_biaya',$this->status_biaya,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PenyewaanBiaya the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
