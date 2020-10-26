<?php

class Pasien_sinkronController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('read', 'readAjax', 'view', 'create', 'update', 'delete', 'excel', 'checkRegistrasi'),
                'users' => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead()
    {
        $mode = Yii::app()->request->getPost('mode');

        $tgl_awal = Yii::app()->request->getPost('awal');

        if ($mode == 'sinkron') {
            $id = Yii::app()->request->getPost('id');
            $data = $this->GetData($id);

            $pasien = new Pasien;
            $pasien->nama = $data['name'];
            $pasien->nik = $data['id_number'];
            $pasien->test_loop = $data['test_loop'];
            $pasien->jenis_kelamin = $data['gender'] == 'Laki-Laki' ? '1' : '2';
            $pasien->tgl_lahir = $data['born_date'];
            $pasien->umur = $data['age'];
            $pasien->alamat = $data['address'];
            $pasien->telephone = $data['phone'];
            $pasien->hp = $data['mobile'];
            if ($pasien->save()) {
                Yii::app()->user->setFlash('success', 'Data Pasien berhasil disimpan');
            } else {
                print_r($pasien->getErrors());
            }
        }

        if ($mode == 'pasien') {
            $id = Yii::app()->request->getPost('id');
            $name = Yii::app()->request->getPost('nama');
            $id_number = Yii::app()->request->getPost('nik');
            $test_loop = Yii::app()->request->getPost('teske');
            $gender = Yii::app()->request->getPost('kelamin');
            $born_date = Yii::app()->request->getPost('tgl_lahir');
            $age = Yii::app()->request->getPost('umur');
            $phone = Yii::app()->request->getPost('telepon');
            $mobile = Yii::app()->request->getPost('hp');
            $address = Yii::app()->request->getPost('alamat');
            //$tgl_awal = Yii::app()->request->getPost('tgl_awal');

            /*$query_update_antrian = "UPDATE registration_patients
                            SET id_number = '$id_number',
                             name = '$name',
                             age = '$age',
                             gender = '$gender',
                             born_date = '$born_date',
                             address = '$address',
                             phone = '$phone',
                             mobile = '$mobile'
                            WHERE (id = '$id')";
            
            //echo $query_update_antrian;  die();
            Yii::app()->db2->createCommand($query_update_antrian)->queryAll();
             * 
             */
            Yii::app()->db2->createCommand()
                ->update(
                    'registration_patients',
                    array(
                        'id_number' => $id_number,
                        'test_loop' => $test_loop,
                        'name' => $name,
                        'age' => $age,
                        'gender' => $gender,
                        'born_date' => $born_date,
                        'address' => $address,
                        'phone' => $phone,
                        'mobile' => $mobile,
                    ),
                    'id=:id',
                    array(':id' => $id)
                );
        }

        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama
            FROM pasien p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            ORDER BY p.nama
            ";
        $query_Sinkron = "SELECT a.*
                            FROM registration_patients a
                            LEFT JOIN registrations b ON a.registration_id = b.id
                            WHERE DATE_FORMAT(b.date, '%Y-%m-%d') <= '$tgl_awal'";
        $pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $pasien_sinkron = Yii::app()->db2->createCommand($query_Sinkron)->queryAll();
        $this->render('read', array(
            'data_pasien' => $pasien,
            'pasien_sinkron' => $pasien_sinkron,
            'awal' => $tgl_awal
        ));
    }

    public function GetData($id)
    {

        $query = "SELECT * 
            FROM registration_patients
            WHERE id='$id'";
        $data = Yii::app()->db2->createCommand($query)->queryRow();
        return $data;
    }


    public function cekData($name, $nik, $address)
    {
        $query = "SELECT count(*) 
            FROM `pasien`
            WHERE nama LIKE '%$name%'
            OR nik LIKE '%$nik%'
            OR alamat LIKE '%$address%'";
        $data = Yii::app()->db->createCommand($query)->queryScalar();
        return $data;
    }
}
