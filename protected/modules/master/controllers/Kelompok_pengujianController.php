<?php

class Kelompok_pengujianController extends Controller {

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
       $kel_pengujian = PengujianKelompok::model()->findAll();
        $this->render('read', array(
            'kel_pengujian' => $kel_pengujian
        ));
    }
    
     public function actionExcel() {
       $this->layout = false;
       $kel_pengujian = PengujianKelompok::model()->findAll();
        $this->render('excel', array(
            'kel_pengujian' => $kel_pengujian
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $kelompok_pengujian = PengujianKelompok::model()->findByPk($id);
        $this->render('view', array(
            'kelompok_pengujian' => $kelompok_pengujian
        ));
    }

    public function actionCreate() {
     
         if (!empty($_POST))
            {
            $kelompok_pengujian = new PengujianKelompok();
            $kelompok_pengujian->kode_kelompok = Yii::app()->request->getPost('kode');
            $kelompok_pengujian->nama_pengujian_kelompok = Yii::app()->request->getPost('kelompok');
               if ($kelompok_pengujian->save()) {
                Yii::app()->user->setFlash('success', 'Data Kelompok Penujian berhasil disimpan');
            } else {
                print_r($kelompok_pengujian->getErrors());
            }
           }
        
        $this->render('create', array());
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $kelompok_pengujian = PengujianKelompok::model()->findByPk($id);
        if (!empty($_POST)) {
            $kelompok_pengujian->kode_kelompok = Yii::app()->request->getPost('kode');
            $kelompok_pengujian->nama_pengujian_kelompok = Yii::app()->request->getPost('kelompok');
          
            if ($kelompok_pengujian->save()) {
                Yii::app()->user->setFlash('success', 'Data Pegawai berhasil dirubah');
            } else {
                print_r($kelompok_pengujian->getErrors());
            }
        }
        
        $this->render('update', array(
            'kelompok_pengujian' => $kelompok_pengujian
           
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = PengujianKelompok::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

