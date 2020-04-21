<?php

/**
 * This is the model class for table "rekanan".
 *
 * The followings are the available columns in table 'rekanan':
 * @property integer $id_rekanan
 * @property string $nama_rekanan
 * @property string $alamat_rekanan
 * @property string $telp
 * @property string $no_surat_mou
 * @property string $tgl_mou_mulai
 * @property string $tgl_mou_selesai
 */
class Rekanan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rekanan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('no_surat_mou, tgl_mou_mulai, tgl_mou_selesai', 'required'),
			array('nama_rekanan', 'length', 'max'=>250),
			array('alamat_rekanan', 'length', 'max'=>500),
			array('telp', 'length', 'max'=>20),
			array('no_surat_mou', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_rekanan, nama_rekanan, alamat_rekanan, telp, no_surat_mou, tgl_mou_mulai, tgl_mou_selesai', 'safe', 'on'=>'search'),
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
			'id_rekanan' => 'Id Rekanan',
			'nama_rekanan' => 'Nama Rekanan',
			'alamat_rekanan' => 'Alamat Rekanan',
			'telp' => 'Telp',
			'no_surat_mou' => 'No Surat Mou',
			'tgl_mou_mulai' => 'Tgl Mou Mulai',
			'tgl_mou_selesai' => 'Tgl Mou Selesai',
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

		$criteria->compare('id_rekanan',$this->id_rekanan);
		$criteria->compare('nama_rekanan',$this->nama_rekanan,true);
		$criteria->compare('alamat_rekanan',$this->alamat_rekanan,true);
		$criteria->compare('telp',$this->telp,true);
		$criteria->compare('no_surat_mou',$this->no_surat_mou,true);
		$criteria->compare('tgl_mou_mulai',$this->tgl_mou_mulai,true);
		$criteria->compare('tgl_mou_selesai',$this->tgl_mou_selesai,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rekanan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
