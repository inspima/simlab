<?php

/**
 * This is the model class for table "notifikasi".
 *
 * The followings are the available columns in table 'notifikasi':
 * @property integer $id_notifikasi
 * @property string $judul_notifikasi
 * @property string $isi_notifikasi
 * @property string $link_notifikasi
 * @property string $waktu_notifikasi
 * @property string $tampil
 * @property string $baca
 * @property string $batas_tampil
 */
class Notifikasi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notifikasi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('judul_notifikasi, isi_notifikasi, link_notifikasi, waktu_notifikasi, batas_tampil', 'required'),
			array('judul_notifikasi, link_notifikasi', 'length', 'max'=>150),
			array('isi_notifikasi', 'length', 'max'=>250),
			array('tampil, baca, batas_tampil', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_notifikasi, judul_notifikasi, isi_notifikasi, link_notifikasi, waktu_notifikasi, tampil, baca, batas_tampil', 'safe', 'on'=>'search'),
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
			'id_notifikasi' => 'Id Notifikasi',
			'judul_notifikasi' => 'Judul Notifikasi',
			'isi_notifikasi' => 'Isi Notifikasi',
			'link_notifikasi' => 'Link Notifikasi',
			'waktu_notifikasi' => 'Waktu Notifikasi',
			'tampil' => 'Tampil',
			'baca' => 'Baca',
			'batas_tampil' => 'Batas Tampil',
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

		$criteria->compare('id_notifikasi',$this->id_notifikasi);
		$criteria->compare('judul_notifikasi',$this->judul_notifikasi,true);
		$criteria->compare('isi_notifikasi',$this->isi_notifikasi,true);
		$criteria->compare('link_notifikasi',$this->link_notifikasi,true);
		$criteria->compare('waktu_notifikasi',$this->waktu_notifikasi,true);
		$criteria->compare('tampil',$this->tampil,true);
		$criteria->compare('baca',$this->baca,true);
		$criteria->compare('batas_tampil',$this->batas_tampil,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notifikasi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
