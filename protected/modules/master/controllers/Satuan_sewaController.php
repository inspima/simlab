<?php

class Satuan_sewaController extends Controller {

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
       
       $satuan_sewa = SatuanSewa::model()->findAll();
        $this->render('read', array(
            'satuan_sewa' => $satuan_sewa
        ));
    }

    /* public function actionView($id) {
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
     * 
     */

    public function actionCreate() {
     
           if (!empty($_POST)) {
            $satuan_sewa = new SatuanSewa;
            $satuan_sewa->nama_satuan = Yii::app()->request->getPost('satuan_sewa');
            if ($satuan_sewa->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($satuan_sewa->getErrors());
            }
        }
        
        $this->render('create', array(
           
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $satuan_sewa = SatuanSewa::model()->findByPk($id);
        if (!empty($_POST)) {
            $satuan_sewa->nama_satuan = Yii::app()->request->getPost('satuan_sewa');
          
            if ($satuan_sewa->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($satuan_sewa->getErrors());
            }
        }
        $this->render('update', array(
            'satuan_sewa' => $satuan_sewa
           
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = SatuanSewa::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

