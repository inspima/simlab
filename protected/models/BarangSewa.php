<?php

/**
 * This is the model class for table "barang_sewa".
 *
 * The followings are the available columns in table 'barang_sewa':
 * @property integer $id_barang_sewa
 * @property integer $id_unit
 * @property string $nama_barang
 * @property string $jenis_barang
 * @property string $keterangan_barang
 */
class BarangSewa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_sewa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_unit', 'numerical', 'integerOnly'=>true),
			array('nama_barang', 'length', 'max'=>250),
			array('jenis_barang', 'length', 'max'=>1),
			array('keterangan_barang', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang_sewa, id_unit, nama_barang, jenis_barang, keterangan_barang', 'safe', 'on'=>'search'),
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
			'id_barang_sewa' => 'Id Barang Sewa',
			'id_unit' => 'Id Unit',
			'nama_barang' => 'Nama Barang',
			'jenis_barang' => 'Jenis Barang',
			'keterangan_barang' => 'Keterangan Barang',
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

		$criteria->compare('id_barang_sewa',$this->id_barang_sewa);
		$criteria->compare('id_unit',$this->id_unit);
		$criteria->compare('nama_barang',$this->nama_barang,true);
		$criteria->compare('jenis_barang',$this->jenis_barang,true);
		$criteria->compare('keterangan_barang',$this->keterangan_barang,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BarangSewa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
