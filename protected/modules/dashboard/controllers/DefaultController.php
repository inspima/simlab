<?php

class DefaultController extends Controller {

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
                'actions' => array('index','getJsonSiswa'),
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
    public function actionIndex() {
        $query_siswa = "select id_siswa,nama_siswa,kekhususan,alamat_longitude,alamat_latitude,alamat from siswa order by nama_siswa";
        $data_siswa = Yii::app()->db->createCommand($query_siswa)->queryAll();
        $this->render('index', array(
            'data_siswa' => $data_siswa,
            'json_siswa' => json_encode($data_siswa),
        ));
    }

    public function actionGetJsonSiswa() {
        $id = Yii::app()->request->getQuery('s');
        $siswa = Siswa::model()->findByPk($id);
        echo json_encode(array(
            "nama_siswa" => $siswa->nama_siswa,
            "alamat_longitude" => $siswa->alamat_longitude,
            "alamat_latitude" => $siswa->alamat_latitude,
            "alamat" => $siswa->alamat,
            "kekhususan" => $siswa->kekhususan,
        ));
    }

}
