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
                // Insert Tabel Sinkron
                Yii::app()->db->createCommand()
                    ->insert(
                        'sync_antrian',
                        array(
                            'id_pasien' => $pasien->id_pasien,
                            'id_antrian_reg_pasien' => $data['id'],
                        )
                    );
                Yii::app()->user->setFlash('success', 'Data Pasien berhasil disimpan');
            } else {
                print_r($pasien->getErrors());
            }
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


    public function cekData($id)
    {
        $query = "SELECT count(*) 
            FROM sync_antrian
            WHERE ='$id'";
        $data = Yii::app()->db->createCommand($query)->queryScalar();
        return $data;
    }
}
