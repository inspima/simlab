<?php

class Subkelompok_pengujianController extends Controller {

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
                'actions' => array('read', 'view', 'create', 'update', 'delete'),
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
       $query = "SELECT a.*, b.nama_kelompok_pengujian 
                FROM pengujian_subkelompok a
                LEFT JOIN pengujian_kelompok b ON b.id_pengujian_kelompok = a.id_pengujian_kelompok";
       $subkelompok_pengujian = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('read', array(
            'subkelompok_pengujian' => $subkelompok_pengujian
        ));
    }

    public function actionView($id) {
         $id = Yii::app()->request->getQuery('id');
        $query = "SELECT a.*, b.nama_kelompok_pengujian 
                FROM pengujian_subkelompok a
                LEFT JOIN pengujian_kelompok b ON b.id_pengujian_kelompok = a.id_pengujian_kelompok
                WHERE id_pengujian_subkelompok='$id'";
       $subkelompok_pengujian = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('view', array(
            'subkelompok_pengujian' => $subkelompok_pengujian
        ));
    }

    public function actionCreate() {
     
           if (!empty($_POST)) {
            $subkelompok_pengujian = new PengujianSubkelompok();
            $subkelompok_pengujian->kode_subkelompok = Yii::app()->request->getPost('kode');
            $subkelompok_pengujian->id_pengujian_kelompok = Yii::app()->request->getPost('kelompok');
            $subkelompok_pengujian->nama_subkelompok=Yii::app()->request->getPost('sub_kelompok');
          
            if ($subkelompok_pengujian->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($subkelompok_pengujian->getErrors());
            }
        }
        $data_kelompok_pengujian = PengujianKelompok::model()->findAll();
        
        $this->render('create', array(
          'data_kelompok_pengujian' => $data_kelompok_pengujian  
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $subkelompok_pengujian = PengujianSubkelompok::model()->findByPk($id);
        if (!empty($_POST)) {
            $subkelompok_pengujian->kode_subkelompok = Yii::app()->request->getPost('kode');
            $subkelompok_pengujian->id_pengujian_kelompok = Yii::app()->request->getPost('kelompok');
            $subkelompok_pengujian->nama_subkelompok=Yii::app()->request->getPost('sub_kelompok');
          
            if ($subkelompok_pengujian->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($subkelompok_pengujian->getErrors());
            }
        }
        $data_kelompok_pengujian = PengujianKelompok::model()->findAll();
        $this->render('update', array(
            'data_kelompok_pengujian' => $data_kelompok_pengujian,
            'subkelompok_pengujian' => $subkelompok_pengujian
           
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = PengujianSubkelompok::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

