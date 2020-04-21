<?php

class DokterController extends Controller {

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
            select d.*,k.nama_kota,ag.nama_agama, i.*
            from dokter d 
            left join kota k on k.id_kota=d.id_kota_lahir
            left join agama ag on ag.id_agama=d.id_agama
            left join instansi i on i.id_instansi=d.id_instansi
            order by d.nama_dokter
            ";
        $data_dokter = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_dokter' => $data_dokter
        ));
    }
    
      public function actionExcel() {
        $this->layout = false;
        $query_view = "
            select d.*,k.nama_kota,ag.nama_agama, i.*
            from dokter d 
            left join kota k on k.id_kota=d.id_kota_lahir
            left join agama ag on ag.id_agama=d.id_agama
            left join instansi i on i.id_instansi=d.id_instansi
            order by d.nama_dokter
            ";
        $data_dokter = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'data_dokter' => $data_dokter
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $dokter = Dokter::model()->findByPk($id);

        $data_kota = Kota::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $data_instansi = Instansi::model()->findAll();
        $this->render('view', array(
            'dokter' => $dokter,
            'data_kota' => $data_kota,
            'data_agama' => $data_agama,
            'data_instansi' => $data_instansi
        ));
    }

    public function actionCreate() {
        if (!empty($_POST)) {
            $dokter = new Dokter;
            $dokter->nama_dokter = Yii::app()->request->getPost('nama');
            $dokter->gelar_depan = Yii::app()->request->getPost('g_depan');
            $dokter->gelar_belakang = Yii::app()->request->getPost('g_belakang');
            $dokter->id_agama = Yii::app()->request->getPost('agama');
            $dokter->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $dokter->id_kota_lahir = Yii::app()->request->getPost('kota');
            $dokter->jenis_kelamin = Yii::app()->request->getPost('jenis_kelamin');
            $dokter->alamat = Yii::app()->request->getPost('alamat');
            $dokter->id_instansi = Yii::app()->request->getPost('instansi');
            if ($dokter->save()) {
                Yii::app()->user->setFlash('success', 'Data Dokter berhasil dimasukkan');
            } else {
                print_r($dokter->getErrors());
            }
        }
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $data_instansi = Instansi::model()->findAll();
        $this->render('create', array(
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama,
            'data_instansi' => $data_instansi
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $dokter = Dokter::model()->findByPk($id);
        if (!empty($_POST)) {
            $dokter->nama_dokter = Yii::app()->request->getPost('nama');
            $dokter->gelar_depan = Yii::app()->request->getPost('g_depan');
            $dokter->gelar_belakang = Yii::app()->request->getPost('g_belakang');
            $dokter->id_agama = Yii::app()->request->getPost('agama');
            $dokter->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $dokter->id_kota_lahir = Yii::app()->request->getPost('kota');
            $dokter->jenis_kelamin = Yii::app()->request->getPost('jenis_kelamin');
            $dokter->alamat = Yii::app()->request->getPost('alamat');
            $dokter->id_instansi = Yii::app()->request->getPost('instansi');
            if ($dokter->save()) {
                Yii::app()->user->setFlash('success', 'Data Dokter berhasil dirubah');
            } else {
                print_r($dokter->getErrors());
            }
        }
        $propinsi_dokter =  Kota::model()->findByAttributes(array('id_kota'=>$dokter->id_kota_lahir));
        $data_propinsi = Propinsi::model()->findAll();
        $data_kota = Kota::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $data_instansi = Instansi::model()->findAll();
        $this->render('update', array(
            'dokter' => $dokter,
            'data_propinsi' => $data_propinsi,
            'data_kota' => $data_kota,
            'data_agama' => $data_agama,
            'data_instansi' => $data_instansi,
            'propinsi_dokter' => $propinsi_dokter
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Dokter::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
