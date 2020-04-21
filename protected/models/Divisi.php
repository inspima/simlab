<?php

/**
 * This is the model class for table "divisi".
 *
 * The followings are the available columns in table 'divisi':
 * @property integer $id_divisi
 * @property integer $id_unit
 * @property string $kode_divisi
 * @property string $nama_divisi
 */
class Divisi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'divisi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_divisi', 'required'),
			array('id_divisi, id_unit', 'numerical', 'integerOnly'=>true),
			array('kode_divisi', 'length', 'max'=>20),
			array('nama_divisi', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_divisi, id_unit, kode_divisi, nama_divisi', 'safe', 'on'=>'search'),
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
			'id_divisi' => 'Id Divisi',
			'id_unit' => 'Id Unit',
			'kode_divisi' => 'Kode Divisi',
			'nama_divisi' => 'Nama Divisi',
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

		$criteria->compare('id_divisi',$this->id_divisi);
		$criteria->compare('id_unit',$this->id_unit);
		$criteria->compare('kode_divisi',$this->kode_divisi,true);
		$criteria->compare('nama_divisi',$this->nama_divisi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Divisi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
