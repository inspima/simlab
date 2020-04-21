<?php

class DivisiController extends Controller {

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
       $query = "SELECT a.*, b.nama_unit
                FROM divisi a
                LEFT JOIN unit b ON b.id_unit = a.id_unit";
       $divisi = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('read', array(
            'divisi' => $divisi
        ));
    }
    
     public function actionExcel() {
       $this->layout = false;
       $query = "SELECT a.*, b.nama_unit
                FROM divisi a
                LEFT JOIN unit b ON b.id_unit = a.id_unit";
       $divisi = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('excel', array(
            'divisi' => $divisi
        ));
    }

    public function actionView($id) {
        
         $id = Yii::app()->request->getQuery('id');
        $query = "SELECT a.*, b.nama_unit
                FROM divisi a
                LEFT JOIN unit b ON b.id_unit = a.id_unit
                WHERE id_divisi='$id'";
       $divisi = Yii::app()->db->createCommand($query)->queryAll();
        $this->render('view', array(
            'divisi' => $divisi
        ));
    }

    public function actionCreate() {
     
           if (!empty($_POST)) {
            $divisi = new Divisi();
            $divisi->id_divisi = Yii::app()->request->getPost('id');
            $divisi->id_unit = Yii::app()->request->getPost('unit');
            $divisi->nama_divisi = Yii::app()->request->getPost('divisi');
          
            if ($divisi->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($divisi->getErrors());
            }
        }
         $data_unit = Unit::model()->findAll();
        
        $this->render('create', array(
          'data_unit' => $data_unit  
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $divisi = Divisi::model()->findByPk($id);
        if (!empty($_POST)) {
            $divisi->id_divisi = Yii::app()->request->getPost('id');
            $divisi->id_unit = Yii::app()->request->getPost('unit');
            $divisi->nama_divisi = Yii::app()->request->getPost('divisi');
            
          
            if ($divisi->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($divisi->getErrors());
            }
        }
        $divisi_unit = Unit::model()->findByAttributes(array('id_unit'=>$divisi->id_unit));
        $data_unit = Unit::model()->findAll();
        $this->render('update', array(
            'divisi_unit' => $divisi_unit,
            'divisi' => $divisi,
            'data_unit' => $data_unit
           
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Divisi::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

