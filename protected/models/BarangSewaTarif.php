<?php

/**
 * This is the model class for table "barang_sewa_tarif".
 *
 * The followings are the available columns in table 'barang_sewa_tarif':
 * @property integer $id_barang_sewa_tarif
 * @property integer $id_barang_sewa
 * @property integer $id_satuan_sewa
 * @property integer $jumlah_satuan_sewa
 * @property string $tarif_sewa
 * @property string $keterangan_tarif
 */
class BarangSewaTarif extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_sewa_tarif';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_barang_sewa, id_satuan_sewa, jumlah_satuan_sewa', 'numerical', 'integerOnly'=>true),
			array('tarif_sewa', 'length', 'max'=>10),
			array('keterangan_tarif', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang_sewa_tarif, id_barang_sewa, id_satuan_sewa, jumlah_satuan_sewa, tarif_sewa, keterangan_tarif', 'safe', 'on'=>'search'),
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
			'id_barang_sewa_tarif' => 'Id Barang Sewa Tarif',
			'id_barang_sewa' => 'Id Barang Sewa',
			'id_satuan_sewa' => 'Id Satuan Sewa',
			'jumlah_satuan_sewa' => 'Jumlah Satuan Sewa',
			'tarif_sewa' => 'Tarif Sewa',
			'keterangan_tarif' => 'Keterangan Tarif',
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

		$criteria->compare('id_barang_sewa_tarif',$this->id_barang_sewa_tarif);
		$criteria->compare('id_barang_sewa',$this->id_barang_sewa);
		$criteria->compare('id_satuan_sewa',$this->id_satuan_sewa);
		$criteria->compare('jumlah_satuan_sewa',$this->jumlah_satuan_sewa);
		$criteria->compare('tarif_sewa',$this->tarif_sewa,true);
		$criteria->compare('keterangan_tarif',$this->keterangan_tarif,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BarangSewaTarif the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
