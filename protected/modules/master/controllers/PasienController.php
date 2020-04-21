<?php

class PasienController extends Controller {

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
                'actions' => array('read','readAjax', 'view', 'create', 'update', 'delete', 'excel'),
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
            SELECT p.*,k.nama_kota,ag.nama_agama
            FROM pasien p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            ORDER BY p.nama
            ";
        $pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_pasien' => $pasien
        ));
    }

    public function actionReadAjax(){
        $id_user_login = Yii::app()->user->getId();
        $start = Yii::app()->request->getParam('start');
        $length = Yii::app()->request->getParam('length');
        $draw = Yii::app()->request->getParam('draw');
        $search_arr = Yii::app()->request->getParam('search');
        $search = $search_arr['value'];
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama
            FROM pasien p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            where lower(p.nama) like lower('%{$search}%') 
           or lower(p.alamat) like lower('%{$search}%')
            ORDER BY p.nama
            limit {$start},{$length}
            ";

        $query_view_search = "
            SELECT p.*,k.nama_kota,ag.nama_agama
            FROM pasien p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
             where lower(p.nama) like lower('%{$search}%') 
            or lower(p.alamat) like lower('%{$search}%')
            ORDER BY p.nama
            ";
        $data = Yii::app()->db->createCommand($query_view)->queryAll();

        $data_search = Yii::app()->db->createCommand($query_view_search)->queryAll();
        $jumlah_all = Pasien::model()->count();
        $jumlah_filtered = count($data_search); 
        $no = 1;
        $result=array();    
        foreach($data as $d){
            $action=' <a class="btn" title="View" href="'.Yii::app()->createUrl('master/pasien/view?id=' . $d['id_pasien']).'" ><i class="icon-search"></i></a>';
            $action .='<a class="btn" title="Edit" href="'.Yii::app()->createUrl('master/pasien/update?id=' . $d['id_pasien']).'"><i class="icon-edit"></i></a>';
            $action .='<a class="btn pasien-delete-button" title="Delete" id="'.$d['id_pasien'].'" ><i class="icon-remove"></i></a>';
            
            array_push($result, array(
                            $d['nama'],
                            $d['nama_kota'].'<br/>'.date('d-m-Y', strtotime($d['tgl_lahir'])),
                            $d['jenis_kelamin'] == 1 ? "Laki-laki" : "Perempuan",
                            $d['nama_agama'],
                            $d['alamat'],
                            $d['telephone'].','.$d['hp'],
                            $action
                            ));
            
        }
        echo json_encode(array('draw' => $draw, 'recordsTotal' => $jumlah_all , 'recordsFiltered' => $jumlah_filtered, 'data' => $result));
    }

    public function actionExcel() {
        $this->layout = false;
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama
            FROM pasien p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            ORDER BY p.nama
            ";
        $pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'pasien' => $pasien
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $query_view = "
            SELECT p.*,k.nama_kota,ag.nama_agama,j.nama_jabatan
            FROM pasien p 
            LEFT JOIN kota k ON k.id_kota=p.id_kota_lahir
            LEFT JOIN agama ag ON ag.id_agama=p.id_agama
            WHERE p.id_pasien='$id'";
        $pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('view', array(
            'pasien' => $pasien
        ));
    }

    public function actionCreate() {

        if (!empty($_POST)) {
            $pasien = new Pasien;
            $pasien->no_id_pasien = Yii::app()->request->getPost('no_id_pasien');
            $pasien->nama = Yii::app()->request->getPost('nama');
            $pasien->jenis_kelamin = Yii::app()->request->getPost('jenis_kelamin');
            $pasien->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $pasien->umur = Yii::app()->request->getPost('umur');
            $pasien->id_kota_lahir = Yii::app()->request->getPost('kota');
            $pasien->id_agama = Yii::app()->request->getPost('agama');
            $pasien->alamat = Yii::app()->request->getPost('alamat');
            $pasien->telephone = Yii::app()->request->getPost('telepon');
            $pasien->hp = Yii::app()->request->getPost('hp');
            if ($pasien->save()) {
                Yii::app()->user->setFlash('success', 'Data Pegawai berhasil disimpan');
            } else {
                print_r($pasien->getErrors());
            }
        }
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('create', array(
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama,
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $pasien = Pasien::model()->findByPk($id);
        if (!empty($_POST)) {
            $pasien->no_id_pasien = Yii::app()->request->getPost('no_id_pasien');
            $pasien->nama = Yii::app()->request->getPost('nama');
            $pasien->jenis_kelamin = Yii::app()->request->getPost('jenis_kelamin');
            $pasien->tgl_lahir = Yii::app()->request->getPost('tgl_lahir');
            $pasien->umur = Yii::app()->request->getPost('umur');
            $pasien->id_kota_lahir = Yii::app()->request->getPost('kota');
            $pasien->id_agama = Yii::app()->request->getPost('agama');
            $pasien->alamat = Yii::app()->request->getPost('alamat');
            $pasien->telephone = Yii::app()->request->getPost('telepon');
            $pasien->hp = Yii::app()->request->getPost('hp');
            if ($pasien->save()) {
                Yii::app()->user->setFlash('success', 'Data Pegawai berhasil dirubah');
            } else {
                print_r($pasien->getErrors());
            }
        }
        $propinsi_pasien = Kota::model()->findByAttributes(array('id_kota' => $pasien->id_kota_lahir));
        $data_propinsi = Propinsi::model()->findAll();
        $data_kota = Kota::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('update', array(
            'pasien' => $pasien,
            'data_propinsi' => $data_propinsi,
            'data_kota' => $data_kota,
            'data_agama' => $data_agama,
            'propinsi_pasien' => $propinsi_pasien,
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Pasien::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
