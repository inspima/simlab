<?php

/**
 * This is the model class for table "pengujian".
 *
 * The followings are the available columns in table 'pengujian':
 * @property integer $id_pengujian
 * @property integer $id_pengujian_kelompok
 * @property integer $id_pengujian_group
 * @property integer $id_unit
 * @property integer $id_divisi
 * @property string $kode_pengujian
 * @property string $nama_pengujian
 * @property string $nilai_normal
 * @property integer $tarif_pengujian
 * @property integer $tarif_konsul
 * @property string $jenis_pengujian
 * @property string $flag_parent_group
 */
class Pengujian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengujian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pengujian_kelompok, id_pengujian_group, id_unit, id_divisi, tarif_pengujian, tarif_konsul', 'numerical', 'integerOnly'=>true),
			array('kode_pengujian', 'length', 'max'=>20),
			array('nama_pengujian', 'length', 'max'=>200),
			array('jenis_pengujian, flag_parent_group', 'length', 'max'=>2),
			array('nilai_normal', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pengujian, id_pengujian_kelompok, id_pengujian_group, id_unit, id_divisi, kode_pengujian, nama_pengujian, nilai_normal, tarif_pengujian, tarif_konsul, jenis_pengujian, flag_parent_group', 'safe', 'on'=>'search'),
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
			'id_pengujian' => 'Id Pengujian',
			'id_pengujian_kelompok' => 'Id Pengujian Kelompok',
			'id_pengujian_group' => 'Id Pengujian Group',
			'id_unit' => 'Id Unit',
			'id_divisi' => 'Id Divisi',
			'kode_pengujian' => 'Kode Pengujian',
			'nama_pengujian' => 'Nama Pengujian',
			'nilai_normal' => 'Nilai Normal',
			'tarif_pengujian' => 'Tarif Pengujian',
			'tarif_konsul' => 'Tarif Konsul',
			'jenis_pengujian' => 'Jenis Pengujian',
			'flag_parent_group' => 'Flag Parent Group',
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

		$criteria->compare('id_pengujian',$this->id_pengujian);
		$criteria->compare('id_pengujian_kelompok',$this->id_pengujian_kelompok);
		$criteria->compare('id_pengujian_group',$this->id_pengujian_group);
		$criteria->compare('id_unit',$this->id_unit);
		$criteria->compare('id_divisi',$this->id_divisi);
		$criteria->compare('kode_pengujian',$this->kode_pengujian,true);
		$criteria->compare('nama_pengujian',$this->nama_pengujian,true);
		$criteria->compare('nilai_normal',$this->nilai_normal,true);
		$criteria->compare('tarif_pengujian',$this->tarif_pengujian);
		$criteria->compare('tarif_konsul',$this->tarif_konsul);
		$criteria->compare('jenis_pengujian',$this->jenis_pengujian,true);
		$criteria->compare('flag_parent_group',$this->flag_parent_group,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pengujian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
