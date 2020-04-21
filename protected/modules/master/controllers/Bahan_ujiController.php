<?php

class Bahan_ujiController extends Controller {

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
                'actions' => array('read', 'view', 'create', 'update', 'delete', 'barcode', 'excel'),
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
            SELECT a.*, b.nama_bahan_jenis
            FROM bahan_pengujian a
            LEFT JOIN bahan_jenis b ON a.id_bahan_jenis = b.id_bahan_jenis
            ";
        $bp = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'bp' => $bp
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $query_view = "
            SELECT a.*, b.nama_bahan_jenis
            FROM bahan_pengujian a
            LEFT JOIN bahan_jenis b ON a.id_bahan_jenis = b.id_bahan_jenis
            WHERE a.id_bahan_pengujian='$id'";
        $bp = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('view', array(
            'bp' => $bp
        ));
    }

    public function actionCreate() {
     
          if (!empty($_POST)) {
            $bp = new BahanPengujian();
            $bp->kode_bahan = Yii::app()->request->getPost('kode');
            $bp->id_bahan_jenis = Yii::app()->request->getPost('jenis');
            $bp->nama_bahan = Yii::app()->request->getPost('nama');
            $bp->harga_bahan = Yii::app()->request->getPost('harga');
            $bp->keterangan_bahan = Yii::app()->request->getPost('ket');
            
            if ($bp->save()) {
              $bp->save();
                Yii::app()->user->setFlash('success', 'Data Bahan Pengujian berhasil disimpan');
            } else {
                print_r($bp->getErrors());
            }
        }
        
        $bj = BahanJenis::model()->findAll();
        $this->render('create', array(
            'bj' => $bj
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $bp= BahanPengujian::model()->findByPk($id);
        
        if (!empty($_POST)) {
            $bp->kode_bahan = Yii::app()->request->getPost('kode');
            $bp->id_bahan_jenis = Yii::app()->request->getPost('jenis');
            $bp->nama_bahan = Yii::app()->request->getPost('nama');
            $bp->harga_bahan = Yii::app()->request->getPost('harga');
            $bp->keterangan_bahan = Yii::app()->request->getPost('ket');
            
            if ($bp->save()) {
                Yii::app()->user->setFlash('success', 'Data Barang berhasil dirubah');
            } else {
                print_r($bp->getErrors());
            }
        }
        
        $bj = BahanJenis::model()->findAll();
        $bj_bahan = BahanJenis::model()->findByAttributes(array('id_bahan_jenis'=>$bp->id_bahan_jenis));
        
        $this->render('update', array(
            'bp' => $bp,
            'bj' => $bj,
            'bj_bahan' => $bj_bahan
            
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $id = Yii::app()->request->getParam('id');
            $model = BahanPengujian::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }
   
    
      public function actionExcel() {
         $this->layout = false;
        $query_view = "
            SELECT a.*, b.nama_bahan_jenis
            FROM bahan_pengujian a
            LEFT JOIN bahan_jenis b ON a.id_bahan_jenis = b.id_bahan_jenis
            ";
        $bp = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'bp' => $bp
        ));
    }

}

