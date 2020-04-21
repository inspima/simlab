<?php

class Barang_sewaController extends Controller {

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
            SELECT bs.*, u.*, bst.jumlah_satuan_sewa, bst.tarif_sewa, ss.nama_satuan
            FROM barang_sewa bs
            LEFT JOIN unit u ON u.id_unit = bs.id_unit
            LEFT JOIN barang_sewa_tarif bst ON bst.id_barang_sewa = bs.id_barang_sewa
            LEFT JOIN satuan_sewa ss ON   bst.id_satuan_sewa = ss.id_satuan_sewa
            ";
        $barang = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'barang' => $barang
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $query_view = "
            SELECT bs.*, u.*, bst.jumlah_satuan_sewa, bst.tarif_sewa, ss.nama_satuan
            FROM barang_sewa bs
            LEFT JOIN unit u ON u.id_unit = bs.id_unit
            LEFT JOIN barang_sewa_tarif bst ON bst.id_barang_sewa = bs.id_barang_sewa
            LEFT JOIN satuan_sewa ss ON   bst.id_satuan_sewa = ss.id_satuan_sewa
            WHERE bs.id_barang_sewa='$id'";
        $barang = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('view', array(
            'barang' => $barang
        ));
    }

    public function actionCreate() {
     
          if (!empty($_POST)) {
            $barang = new BarangSewa();
            $tarif_barang = new BarangSewaTarif();
            $barang->nama_barang = Yii::app()->request->getPost('nama');
            $barang->id_unit = Yii::app()->request->getPost('unit');
            $tarif_barang->jumlah_satuan_sewa = Yii::app()->request->getPost('jumlah');
            $tarif_barang->id_satuan_sewa = Yii::app()->request->getPost('satuan');
            $tarif_barang->tarif_sewa = Yii::app()->request->getPost('tarif');
            $barang->jenis_barang= Yii::app()->request->getPost('jenis_barang');
            $barang->keterangan_barang = Yii::app()->request->getPost('keterangan');
            
            if ($barang->save()) {
                $newID = Yii::app()->db->createCommand()
                ->select('max(id_barang_sewa) as max')
                ->from('barang_sewa')
                ->queryScalar();
              $tarif_barang->id_barang_sewa = $newID;
              $tarif_barang->save();
                Yii::app()->user->setFlash('success', 'Data Barang berhasil disimpan');
            } else {
                print_r($barang->getErrors());
                print_r($tarif_barang->getErrors());
            }
        }
        
        $data_unit = Unit::model()->findAll();
        $data_satuan = SatuanSewa::model()->findAll();
        $this->render('create', array(
            'data_unit' => $data_unit,
            'data_satuan' => $data_satuan
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $barang = BarangSewa::model()->findByPk($id);
        $tarif_barang = BarangSewaTarif::model()->findByAttributes(array('id_barang_sewa'=>$barang->id_barang_sewa));
        if (!empty($_POST)) {
            $barang->nama_barang = Yii::app()->request->getPost('nama');
            $barang->id_unit = Yii::app()->request->getPost('unit');
            $tarif_barang->jumlah_satuan_sewa = Yii::app()->request->getPost('jumlah');
            $tarif_barang->id_satuan_sewa = Yii::app()->request->getPost('satuan');
            $tarif_barang->tarif_sewa = Yii::app()->request->getPost('tarif');
            $barang->jenis_barang= Yii::app()->request->getPost('jenis_barang');
            $barang->keterangan_barang = Yii::app()->request->getPost('keterangan');
            
            if ($barang->save()&&$tarif_barang->save()) {
                Yii::app()->user->setFlash('success', 'Data Barang berhasil dirubah');
            } else {
                print_r($barang->getErrors());
                print_r($tarif_barang->getErrors());
            }
        }
        
        $data_unit = Unit::model()->findAll();
        $data_satuan = SatuanSewa::model()->findAll();
        $unit_barang = Unit::model()->findByAttributes(array('id_unit'=>$barang->id_unit));
        $satuan_barang = SatuanSewa::model()->findByAttributes(array('id_satuan_sewa'=>$tarif_barang->id_satuan_sewa));
        
        $this->render('update', array(
            'barang' => $barang,
            'data_unit' => $data_unit,
            'data_satuan' => $data_satuan,
            'unit_barang' => $unit_barang,
            'tarif_barang' => $tarif_barang,
            'satuan_barang' => $satuan_barang
            
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $id = Yii::app()->request->getParam('id');
            $model = BarangSewa::model()->findByPk(Yii::app()->request->getParam('id'));
            $model_tarif = BarangSewaTarif::model()->findByAttributes(array('id_barang_sewa'=>$id));
            $model->delete();
            $model_tarif->delete();
            $this->redirect('read');
        }
    }
    
    public function actionBarcode($id) {
        $this->layout = false;
        $id = Yii::app()->request->getQuery('id');
        $width  = 180;  
        //Height of the barcode image.
        $height = 84;
        //Quality of the barcode image. Only for JPEG.
        $quality = 100;
        //1 if text should appear below the barcode. Otherwise 0.
        $text =1;
        // Location of barcode image storage.
        $location = Yii::getPathOfAlias("webroot").'/barcode/'.$id.'.jpg';
        Yii::import("application.extensions.barcode.*");                      
        barcode::Barcode39($id, $width , $height , $quality, $text, $location);
        //$this->redirect('view?id='.$id);
        $this->render('barcode', array(
         
            'id' => $id,
            
            
        ));
    }
    
      public function actionExcel() {
         $this->layout = false;
        $query_view = "
            SELECT bs.*, u.*, bst.jumlah_satuan_sewa, bst.tarif_sewa, ss.nama_satuan
            FROM barang_sewa bs
            LEFT JOIN unit u ON u.id_unit = bs.id_unit
            LEFT JOIN barang_sewa_tarif bst ON bst.id_barang_sewa = bs.id_barang_sewa
            LEFT JOIN satuan_sewa ss ON   bst.id_satuan_sewa = ss.id_satuan_sewa
            ";
        $barang = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('excel', array(
            'barang' => $barang
        ));
    }

}

