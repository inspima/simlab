<?php

class UserController extends Controller {

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
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama,j.nama_jabatan, us.username,un.nama_unit,us.nama_user
            FROM pegawai p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            LEFT JOIN jabatan j ON j.id_jabatan = p.id_jabatan
            LEFT JOIN unit un on un.id_unit=p.id_unit
            LEFT JOIN user us ON us.id_user = p.id_user
            ORDER BY p.nama_pegawai
            ";
        $data_personil = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_personil' => $data_personil
        ));
    }

    public function actionCreate() {
        $id = Yii::app()->request->getQuery('id');
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama,j.nama_jabatan, us.username,un.nama_unit
            FROM pegawai p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            LEFT JOIN jabatan j ON j.id_jabatan = p.id_jabatan
            LEFT JOIN unit un on un.id_unit=p.id_unit
            LEFT JOIN user us ON us.id_user = p.id_user
            where p.id_pegawai='{$id}'
            order by p.nama_pegawai
            ";
        $personil = Yii::app()->db->createCommand($query_view)->queryRow();
        if (!empty($_POST)) {
            $user = new User;
            $user->username = Yii::app()->request->getPost('username');
            $salt = sha1('l4b0r4t0r1um');
            $password_hash = crypt(Yii::app()->request->getPost('password'), $salt);
            $user->password = $password_hash;
            $user->nama_user = Yii::app()->request->getPost('nama');
            if ($user->save()) {
                $personil_update = Pegawai::model()->findByPk($id);
                $personil_update->id_user= $user->id_user;
                $personil_update->save();
                Yii::app()->user->setFlash('success', 'Data Pegawai berhasil dimasukkan');
            } else {
                print_r($user->getErrors());
            }
            $this->redirect('read');
        }
        $this->render('create',array(
            'personil'=>$personil
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $user = Yii::app()->request->getQuery('user');
       
        if (!empty($_POST)) {
            $user = User::model()->findByPk($user);
            $user->username = Yii::app()->request->getPost('username');
            $salt = sha1('l4b0r4t0r1um');
            $password_hash = crypt(Yii::app()->request->getPost('password'), $salt);
            $user->password = $password_hash;
            $user->nama_user = Yii::app()->request->getPost('nama');
            if ($user->save()) {
                Yii::app()->user->setFlash('success', 'Data Personil berhasil dimasukkan');
            } else {
                print_r($user->getErrors());
            }
        }
         $query_view = "
            select p.*,k.nama_kota,ag.nama_agama,jab.nama_jabatan,u.*
            from pegawai p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            left join jabatan jab on jab.id_jabatan=p.id_jabatan
            left join user u on u.id_user=p.id_user
            where p.id_pegawai='{$id}'
            order by p.nama_pegawai
            ";
        $personil = Yii::app()->db->createCommand($query_view)->queryRow();
        $this->render('update',array(
            'personil'=>$personil
        ));
    }

    

}
