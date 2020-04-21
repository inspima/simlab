<?php

/**
 * This is the model class for table "pengujian_bahan".
 *
 * The followings are the available columns in table 'pengujian_bahan':
 * @property integer $id_pengujian_bahan
 * @property integer $id_pengujian
 * @property integer $id_bahan
 * @property integer $jumlah_pemakaian
 */
class PengujianBahan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pengujian_bahan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pengujian, id_bahan, jumlah_pemakaian', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_pengujian_bahan, id_pengujian, id_bahan, jumlah_pemakaian', 'safe', 'on'=>'search'),
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
			'id_pengujian_bahan' => 'Id Pengujian Bahan',
			'id_pengujian' => 'Id Pengujian',
			'id_bahan' => 'Id Bahan',
			'jumlah_pemakaian' => 'Jumlah Pemakaian',
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

		$criteria->compare('id_pengujian_bahan',$this->id_pengujian_bahan);
		$criteria->compare('id_pengujian',$this->id_pengujian);
		$criteria->compare('id_bahan',$this->id_bahan);
		$criteria->compare('jumlah_pemakaian',$this->jumlah_pemakaian);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PengujianBahan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
