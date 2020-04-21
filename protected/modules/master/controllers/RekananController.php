<?php

class RekananController extends Controller {

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
       
        $rekanan = Rekanan::model()->findAll();
        $this->render('read', array(
            'rekanan' => $rekanan
        ));
    }
    
     public function actionExcel() {
        $this->layout = false;
        $rekanan = Rekanan::model()->findAll();
        $this->render('excel', array(
            'rekanan' => $rekanan
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $rekanan = Rekanan::model()->findByPk($id);
        $this->render('view', array(
            'rekanan' => $rekanan
        ));
    }

    public function actionCreate() {
     
         if (!empty($_POST))
            {
            $rekanan = new Rekanan();
            $rekanan->nama_rekanan = Yii::app()->request->getPost('nama');
            $rekanan->alamat_rekanan = Yii::app()->request->getPost('alamat');
            $rekanan->telp = Yii::app()->request->getPost('telp');
            $rekanan->no_surat_mou = Yii::app()->request->getPost('surat');
            $rekanan->tgl_mou_mulai = Yii::app()->request->getPost('tgl_mulai');
            $rekanan->tgl_mou_selesai = Yii::app()->request->getPost('tgl_akhir');
                if ($rekanan->save()) {
                    Yii::app()->user->setFlash('success', 'Data Rekanan berhasil disimpan');
                } else {
                         print_r($rekanan->getErrors()); }
           }
        
        $this->render('create', array(
            
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $rekanan = Rekanan::model()->findByPk($id);
        if (!empty($_POST)) {
            $rekanan->nama_rekanan = Yii::app()->request->getPost('nama');
            $rekanan->alamat_rekanan = Yii::app()->request->getPost('alamat');
            $rekanan->telp = Yii::app()->request->getPost('telp');
            $rekanan->no_surat_mou = Yii::app()->request->getPost('surat');
            $rekanan->tgl_mou_mulai = Yii::app()->request->getPost('tgl_mulai');
            $rekanan->tgl_mou_selesai = Yii::app()->request->getPost('tgl_akhir');
            if ($rekanan->save()) {
                Yii::app()->user->setFlash('success', 'Data Rekanan berhasil dirubah');
            } else {
                print_r($rekanan->getErrors());
            }
        }
        
        $this->render('update', array(
            'rekanan' => $rekanan
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Rekanan::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

