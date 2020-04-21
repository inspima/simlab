<?php

/**
 * This is the model class for table "dokumen_penyewaan".
 *
 * The followings are the available columns in table 'dokumen_penyewaan':
 * @property integer $id_dokumen_penyewaan
 * @property string $nama_dokumen
 * @property string $status_dokumen
 */
class DokumenPenyewaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dokumen_penyewaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_dokumen_penyewaan', 'numerical', 'integerOnly'=>true),
			array('nama_dokumen', 'length', 'max'=>100),
			array('status_dokumen', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_dokumen_penyewaan, nama_dokumen, status_dokumen', 'safe', 'on'=>'search'),
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
			'id_dokumen_penyewaan' => 'Id Dokumen Penyewaan',
			'nama_dokumen' => 'Nama Dokumen',
			'status_dokumen' => 'Status Dokumen',
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

		$criteria->compare('id_dokumen_penyewaan',$this->id_dokumen_penyewaan);
		$criteria->compare('nama_dokumen',$this->nama_dokumen,true);
		$criteria->compare('status_dokumen',$this->status_dokumen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DokumenPenyewaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
