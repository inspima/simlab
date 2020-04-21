<?php

class Group_pengujianController extends Controller {

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
        $query_view = "SELECT p.*, nama_pengujian_kelompok, nama_unit, nama_divisi  
        FROM pengujian p
        LEFT JOIN pengujian_kelompok a ON a.id_pengujian_kelompok = p.id_pengujian_kelompok
        LEFT JOIN unit b ON b.id_unit = p.id_unit
        LEFT JOIN divisi c ON c.id_divisi = p.id_divisi
        WHERE jenis_pengujian=1";
        $gruoup_uji = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'gruoup_uji' => $gruoup_uji
        ));
    }
    
      public function actionExcel() {
        $this->layout = false;
        $query_view = "SELECT p.*, nama_pengujian_kelompok, nama_unit, nama_divisi  
        FROM pengujian p
        LEFT JOIN pengujian_kelompok a ON a.id_pengujian_kelompok = p.id_pengujian_kelompok
        LEFT JOIN unit b ON b.id_unit = p.id_unit
        LEFT JOIN divisi c ON c.id_divisi = p.id_divisi
        WHERE jenis_pengujian=1";
        $gruoup_uji = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'gruoup_uji' => $gruoup_uji
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $query_view = "
            SELECT p.*, nama_pengujian_kelompok, nama_unit, nama_divisi  
            FROM pengujian p
            LEFT JOIN pengujian_kelompok a ON a.id_pengujian_kelompok = p.id_pengujian_kelompok
            LEFT JOIN unit b ON b.id_unit = p.id_unit
            LEFT JOIN divisi c ON c.id_divisi = p.id_divisi
            WHERE jenis_pengujian=1
            AND p.id_pengujian='$id'";
        $data_uji = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('view', array(
            'data_uji' => $data_uji
        ));
    }

    public function actionCreate() {
        if (!empty($_POST)) {
            $pengujian = new Pengujian();
            $pengujian->jenis_pengujian = 1;
            $pengujian->kode_pengujian = Yii::app()->request->getPost('kode');
            $pengujian->nama_pengujian = Yii::app()->request->getPost('nama');
            $pengujian->id_pengujian_kelompok = Yii::app()->request->getPost('kelompok');
            $pengujian->id_unit = Yii::app()->request->getPost('unit');
            $pengujian->id_divisi = Yii::app()->request->getPost('divisi');
            $pengujian->tarif_pengujian = Yii::app()->request->getPost('t_uji_grup');
            $pengujian->tarif_konsul = Yii::app()->request->getPost('t_konsul');
            if ($pengujian->save()) {
                Yii::app()->user->setFlash('success', 'Berhasil Tambah data group');
            } else {
                print_r($pengujian->getErrors());
            }
        }
        $data_kelompok = PengujianKelompok::model()->findAll();
        $data_unit = Unit::model()->findAll();
        $data_divisi = Divisi::model()->findAll();
       
        $this->render('create', array(
           
            'data_kelompok' => $data_kelompok,
            'data_unit' => $data_unit,
            'data_divisi' => $data_divisi
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $pengujian = Pengujian::model()->findByPk($id);
        if (!empty($_POST)) {
            $pengujian->kode_pengujian = Yii::app()->request->getPost('kode');
            $pengujian->nama_pengujian = Yii::app()->request->getPost('nama');
            $pengujian->id_pengujian_kelompok = Yii::app()->request->getPost('kelompok');
            $pengujian->id_unit = Yii::app()->request->getPost('unit');
            $pengujian->id_divisi = Yii::app()->request->getPost('divisi');
            $pengujian->tarif_pengujian = Yii::app()->request->getPost('t_uji_grup');
            $pengujian->tarif_konsul = Yii::app()->request->getPost('t_konsul');
            
            
            if ($pengujian->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($pengujian->getErrors());
            }
        }
      
        $data_kelompok = PengujianKelompok::model()->findAll();
        $data_unit = Unit::model()->findAll();
        $data_divisi = Divisi::model()->findAll();
       
        $this->render('update', array(
            'pengujian' => $pengujian,
            'data_kelompok' => $data_kelompok,
            'data_unit' => $data_unit,
            'data_divisi' => $data_divisi

        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Pengujian::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
