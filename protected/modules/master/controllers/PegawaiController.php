<?php

class PegawaiController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('read', 'view', 'create', 'update', 'delete', 'excel'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama,j.nama_jabatan, us.username,un.nama_unit
            FROM pegawai p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            LEFT JOIN jabatan j ON j.id_jabatan = p.id_jabatan
            LEFT JOIN unit un on un.id_unit=p.id_unit
            LEFT JOIN user us ON us.id_user = p.id_user
            ORDER BY p.nama_pegawai
            ";
        $pegawai = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'pegawai' => $pegawai
        ));
    }
    
       public function actionExcel() {
         $this->layout = false;
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama,j.nama_jabatan, us.username,un.nama_unit
            FROM pegawai p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            LEFT JOIN jabatan j ON j.id_jabatan = p.id_jabatan
            LEFT JOIN unit un on un.id_unit=p.id_unit
            LEFT JOIN user us ON us.id_user = p.id_user
            ORDER BY p.nama_pegawai
            ";
        $pegawai = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'pegawai' => $pegawai
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama,j.nama_jabatan, us.username,un.nama_unit
            FROM pegawai p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            LEFT JOIN jabatan j ON j.id_jabatan = p.id_jabatan
            LEFT JOIN unit un on un.id_unit=p.id_unit
            LEFT JOIN user us ON us.id_user = p.id_user
            WHERE p.id_pegawai='$id'";
        $pegawai = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('view', array(
            'pegawai' => $pegawai
        ));
    }

    public function actionCreate() {
     
         if (!empty($_POST))
            {
            $pegawai = new Pegawai();
            $pegawai->nama_pegawai = Yii::app()->request->getPost('nama');
            $pegawai->nip = Yii::app()->request->getPost('nip');
            $pegawai->gelar_depan = Yii::app()->request->getPost('g_depan');
            $pegawai->gelar_belakang = Yii::app()->request->getPost('g_belakang');
            $pegawai->id_agama = Yii::app()->request->getPost('agama');
            $pegawai->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $pegawai->id_kota_lahir = Yii::app()->request->getPost('kota');
            $pegawai->id_jabatan = Yii::app()->request->getPost('jabatan');
            $pegawai->id_unit = Yii::app()->request->getPost('unit');
            $pegawai->alamat = Yii::app()->request->getPost('alamat');
            $pegawai->telephone = Yii::app()->request->getPost('telp');
            $pegawai->hp = Yii::app()->request->getPost('hp');
                if ($pegawai->save()) {
                    Yii::app()->user->setFlash('success', 'Data Pegawai berhasil disimpan');
                } else {
                         print_r($pegawai->getErrors()); }
           }
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $data_jabatan = Jabatan::model()->findAll();
        $data_unit = Unit::model()->findAll();
        $this->render('create', array(
            'data_propinsi' => $data_propinsi,
            'data_jabatan'=>$data_jabatan,
            'data_agama' => $data_agama,
            'data_unit' => $data_unit
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $pegawai = Pegawai::model()->findByPk($id);
        if (!empty($_POST)) {
            $pegawai->nama_pegawai = Yii::app()->request->getPost('nama');
            $pegawai->nip = Yii::app()->request->getPost('nip');
            $pegawai->gelar_depan = Yii::app()->request->getPost('g_depan');
            $pegawai->gelar_belakang = Yii::app()->request->getPost('g_belakang');
            $pegawai->id_agama = Yii::app()->request->getPost('agama');
            $pegawai->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $pegawai->id_kota_lahir = Yii::app()->request->getPost('kota');
            $pegawai->id_jabatan = Yii::app()->request->getPost('jabatan');
            $pegawai->id_unit = Yii::app()->request->getPost('unit');
            $pegawai->alamat = Yii::app()->request->getPost('alamat');
            $pegawai->telephone = Yii::app()->request->getPost('telp');
            $pegawai->hp = Yii::app()->request->getPost('hp');
            if ($pegawai->save()) {
                Yii::app()->user->setFlash('success', 'Data Pegawai berhasil dirubah');
            } else {
                print_r($pegawai->getErrors());
            }
        }
        $propinsi_pegawai =  Kota::model()->findByAttributes(array('id_kota'=>$pegawai->id_kota_lahir));
        $data_propinsi = Propinsi::model()->findAll();
        $data_jabatan = Jabatan::model()->findAll();
        $data_kota = Kota::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $data_unit = Unit::model()->findAll();
        $this->render('update', array(
            'pegawai' => $pegawai,
            'data_propinsi' => $data_propinsi,
            'data_kota' => $data_kota,
            'data_agama' => $data_agama,
            'data_jabatan'=>$data_jabatan,
            'propinsi_pegawai' => $propinsi_pegawai,
            'data_unit' => $data_unit
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Pegawai::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}