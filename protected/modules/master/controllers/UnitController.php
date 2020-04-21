<?php

class UnitController extends Controller {

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
        $unit = Unit::model()->findAll();
        $this->render('read', array(
            'unit' => $unit
        ));
    }
    
      public function actionExcel() {
         $this->layout = false;
        $unit = Unit::model()->findAll();
        $this->render('excel', array(
            'unit' => $unit
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $unit = Unit::model()->findByPk($id);
        $this->render('view', array(
            'unit' => $unit
        ));
    }

    public function actionCreate() {
     
         if (!empty($_POST))
            {
            $unit = new Unit();
            $unit->kode_unit = Yii::app()->request->getPost('kode');
            $unit->nama_unit = Yii::app()->request->getPost('nama');
                if ($unit ->save()) {
                    Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
                } else {
                         print_r($unit ->getErrors()); }
           }
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('create', array(
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $unit = Unit::model()->findByPk($id);
        if (!empty($_POST)) {
            $unit->kode_unit = Yii::app()->request->getPost('kode');
            $unit->nama_unit = Yii::app()->request->getPost('nama');
           
            if ($unit->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($unit->getErrors());
            }
        }
      
        $this->render('update', array(
            'unit' => $unit
          
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Unit::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}

