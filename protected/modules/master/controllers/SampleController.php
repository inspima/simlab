<?php

class SampleController extends Controller {

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
        $sample = Sample::model()->findAll();
        $this->render('read', array(
            'sample' => $sample
        ));
    }
    
    public function actionExcel() {
         $this->layout = false;
        $sample = Sample::model()->findAll();
        $this->render('excel', array(
            'sample' => $sample
        ));
    }


    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $sample = Sample::model()->findByPk($id);
        $this->render('view', array(
            'sample' => $sample
        ));
    }

    public function actionCreate() {

        if (!empty($_POST)) {
            $sample = new Sample();
            $sample->nama_sample = Yii::app()->request->getPost('nama');
            if ($sample->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
            } else {
                print_r($sample->getErrors());
            }
        }
        $this->render('create');
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $sample = Sample::model()->findByPk($id);
        if (!empty($_POST)) {
            $sample->nama_sample = Yii::app()->request->getPost('nama');

            if ($sample->save()) {
                Yii::app()->user->setFlash('success', 'Data berhasil dirubah');
            } else {
                print_r($sample->getErrors());
            }
        }

        $this->render('update', array(
            'sample' => $sample
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Sample::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
