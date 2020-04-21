<?php

class Bahan_jenisController extends Controller {

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
       $query = "SELECT * FROM bahan_jenis";
       $bj = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('read', array(
            'bj' => $bj
        ));
    }
    
     public function actionExcel() {
       $this->layout = false;
       $query = "SELECT * FROM bahan_jenis";
       $bj = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('excel', array(
            'bj' => $bj
        ));
    }

    public function actionView($id) {
        
         $id = Yii::app()->request->getQuery('id');
        $query = "SELECT *
                FROM bahan_jenis
                WHERE id_bahan_jenis='$id'";
        $bj = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('view', array(
            'bj' => $bj
        ));
    }

    public function actionCreate() {
     
           if (!empty($_POST)) {
            $bj = new BahanJenis();
            $bj->nama_bahan_jenis = Yii::app()->request->getPost('nama');
          
            if ($bj->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
            } else {
                print_r($bj->getErrors());
            }
        }
        
        $this->render('create', array( 
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $bj = BahanJenis::model()->findByPk($id);
        if (!empty($_POST)) {
            $bj->nama_bahan_jenis = Yii::app()->request->getPost('nama');
            
          
            if ($bj->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($bj->getErrors());
            }
        }
        $this->render('update', array(
            'bj' => $bj
           
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = BahanJenis::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

