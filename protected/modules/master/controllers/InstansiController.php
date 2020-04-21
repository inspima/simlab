<?php

class InstansiController extends Controller {

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
           select i.*,ij.nama_instansi_jenis, k.nama_kota
           from instansi i 
           left join instansi_jenis ij on ij.id_instansi_jenis=i.id_instansi_jenis
           left join kota k on i.id_kota_instansi = k.id_kota
           order by ij.nama_instansi_jenis,i.nama_instansi
           ";
        $data_instansi = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_instansi' => $data_instansi
        ));
    }

    public function actionCreate() {

        if (!empty($_POST)) {
            $instansi = new Instansi();
            $instansi->nama_instansi = Yii::app()->request->getPost('nama');
            $instansi->kode_instansi = Yii::app()->request->getPost('kode');
            $instansi->alamat_instansi = Yii::app()->request->getPost('alamat');
            $instansi->telephone = Yii::app()->request->getPost('telp');
            $instansi->fax = Yii::app()->request->getPost('fax');
            $instansi->id_instansi_jenis = Yii::app()->request->getPost('jenis');
            $instansi->id_kota_instansi = Yii::app()->request->getPost('kota');
            if ($instansi->save()) {
                Yii::app()->user->setFlash('success', 'Data Instansi berhasil disimpan');
            } else {
                print_r($instansi->getErrors());
            }
        }
        $data_propinsi = Propinsi::model()->findAll();
        $data_instansi_jenis = InstansiJenis::model()->findAll();
        $this->render('create', array(
            'data_propinsi' => $data_propinsi,
            'data_instansi_jenis' => $data_instansi_jenis
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $instansi = Instansi::model()->findByPk($id);
        if (!empty($_POST)) {
            $instansi = Instansi::model()->findByPk($id);
            $instansi->nama_instansi = Yii::app()->request->getPost('nama');
            $instansi->kode_instansi = Yii::app()->request->getPost('kode');
            $instansi->alamat_instansi = Yii::app()->request->getPost('alamat');
            $instansi->telephone = Yii::app()->request->getPost('telp');
            $instansi->fax = Yii::app()->request->getPost('fax');
            $instansi->id_instansi_jenis = Yii::app()->request->getPost('jenis');
            $instansi->id_kota_instansi = Yii::app()->request->getPost('kota');
            if ($instansi->save()) {
                Yii::app()->user->setFlash('success', 'Data Instansi berhasil dirubah');
            } else {
                print_r($instansi->getErrors());
            }
        }
        $propinsi_instansi = Kota::model()->findByAttributes(array('id_kota' => $instansi->id_kota_instansi));
        $data_propinsi = Propinsi::model()->findAll();
        $data_kota = Kota::model()->findAll();
        $data_instansi_jenis = InstansiJenis::model()->findAll();
        $this->render('update', array(
            'instansi' => $instansi,
            'data_kota' => $data_kota,
            'data_propinsi' => $data_propinsi,
            'data_instansi_jenis' => $data_instansi_jenis,
            'propinsi_instansi' => $propinsi_instansi
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Instansi::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

    public function actionExcel() {
        $this->layout = false;
        $query_view = "
           select i.*,ij.nama_instansi_jenis, k.nama_kota
           from instansi i 
           left join instansi_jenis ij on ij.id_instansi_jenis=i.id_instansi_jenis
           left join kota k on i.id_kota_instansi = k.id_kota
           order by ij.nama_instansi_jenis,i.nama_instansi
           ";
        $data_instansi = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'data_instansi' => $data_instansi
        ));
    }

}
                       