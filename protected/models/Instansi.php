                                <?php

/**
 * This is the model class for table "instansi".
 *
 * The followings are the available columns in table 'instansi':
 * @property integer $id_instansi
 * @property string $kode_instansi
 * @property integer $id_kota_instansi
 * @property integer $id_instansi_jenis
 * @property string $nama_instansi
 * @property string $alamat_instansi
 * @property string $telephone
 */
class Instansi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'instansi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kota_instansi, id_instansi_jenis', 'numerical', 'integerOnly'=>true),
			array('kode_instansi', 'length', 'max'=>10),
			array('nama_instansi', 'length', 'max'=>250),
			array('alamat_instansi', 'length', 'max'=>500),
			array('telephone, fax', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_instansi, kode_instansi, id_kota_instansi, id_instansi_jenis, nama_instansi, alamat_instansi, telephone, fax', 'safe', 'on'=>'search'),
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
			'id_instansi' => 'Id Instansi',
			'kode_instansi' => 'Kode Instansi',
			'id_kota_instansi' => 'Id Kota Instansi',
			'id_instansi_jenis' => 'Id Instansi Jenis',
			'nama_instansi' => 'Nama Instansi',
			'alamat_instansi' => 'Alamat Instansi',
			'telephone' => 'Telephone',
			'fax' => 'Fax',
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

		$criteria->compare('id_instansi',$this->id_instansi);
		$criteria->compare('kode_instansi',$this->kode_instansi,true);
		$criteria->compare('id_kota_instansi',$this->id_kota_instansi);
		$criteria->compare('id_instansi_jenis',$this->id_instansi_jenis);
		$criteria->compare('nama_instansi',$this->nama_instansi,true);
		$criteria->compare('alamat_instansi',$this->alamat_instansi,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('fax',$this->fax,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Instansi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

                            