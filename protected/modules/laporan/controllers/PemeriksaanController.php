<?php

class PemeriksaanController extends Controller {

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
                'actions' => array('read', 'excel', 'pengirim', 
                                   'pendapatan', 'PflBulanan','PflBulananRead', 
                                   'Lks', 'ExcelPengirim', 'ExcelLks', 
                                   'ExcelPendapatan', 'ExcelPfl', 'pendLab', 
                                   'CtkPendLab', 'piutang', 'ctkPiutang', 'pel_piutang', 
                                   'CtkPel_piutang', 'Pendapatan_2', 'pascovid','ExcelPascovid','excelPendLab'),
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
        $query_view = "SELECT DATE_FORMAT(waktu_registrasi,'%Y') AS tahun
                        FROM `registrasi_pemeriksaan`
                        GROUP BY tahun";
        $tahun = Yii::app()->db->createCommand($query_view)->queryAll();
        $data_kelompok_uji = PengujianKelompok::model()->findAll();
        if (!empty($_POST)) {
            $pil_tahun = Yii::app()->request->getPost('tahun');
            $data_sample = Dokter::model()->findAll();
            $this->render('read', array(
                'tahun' => $tahun,
                'data_kelompok_uji' => $data_kelompok_uji,
                'pil_tahun' => $pil_tahun
            ));
        } else {
            $pil_tahun = null;
            $this->render('read', array(
                'tahun' => $tahun,
                'data_kelompok_uji' => array(),
                'pil_tahun' => $pil_tahun
            ));
        }
    }

    public function actionPengirim() {
        $query_view = "SELECT DATE_FORMAT(waktu_registrasi,'%Y') AS tahun
                        FROM `registrasi_pemeriksaan`
                        GROUP BY tahun";
        $query_distinct_kota = "SELECT DISTINCT(b.nama_kota), a.id_kota_instansi
                                FROM  instansi a LEFT JOIN kota b 
                                ON a.id_kota_instansi = b.id_kota
                                ORDER BY nama_kota";
        $data_kota = Yii::app()->db->createCommand($query_distinct_kota)->queryAll();
        $tahun = Yii::app()->db->createCommand($query_view)->queryAll();
        $data_jenis_instansi = InstansiJenis::model()->findAll();
        if (!empty($_POST)) {
            $pil_tahun = Yii::app()->request->getPost('tahun');
            $data_sample = Dokter::model()->findAll();
            $this->render('pengirim', array(
                'tahun' => $tahun,
                'data_jenis_instansi' => $data_jenis_instansi,
                'pil_tahun' => $pil_tahun,
                'data_kota' => $data_kota
            ));
        } else {
            $pil_tahun = null;
            $this->render('pengirim', array(
                'tahun' => $tahun,
                'data_jenis_instansi' => array(),
                'pil_tahun' => $pil_tahun,
                'data_kota' => array()
            ));
        }
    }

    public function actionExcelPengirim($id) {
        $pil_tahun = Yii::app()->request->getQuery('id');
        $this->layout = false;
        $query_distinct_kota = "SELECT DISTINCT(b.nama_kota), a.id_kota_instansi
                                FROM  instansi a LEFT JOIN kota b 
                                ON a.id_kota_instansi = b.id_kota
                                ORDER BY nama_kota";
        $data_kota = Yii::app()->db->createCommand($query_distinct_kota)->queryAll();
        $data_jenis_instansi = InstansiJenis::model()->findAll();
        $data_sample = Dokter::model()->findAll();
        $this->render('excelPengirim', array(
            'data_jenis_instansi' => $data_jenis_instansi,
            'pil_tahun' => $pil_tahun,
            'data_kota' => $data_kota
        ));
    }

    public function actionExcel($id) {
        $pil_tahun = Yii::app()->request->getQuery('id');
        $this->layout = false;
        $data_kelompok_uji = PengujianKelompok::model()->findAll();
        //$pil_tahun = Yii::app()->request->getPost('tahun');
        $data_sample = Dokter::model()->findAll();

        $this->render('excel', array(
            'data_kelompok_uji' => $data_kelompok_uji,
            'pil_tahun' => $pil_tahun
        ));
    }

    public function actionPendapatan() {
        $unit = Unit::model()->findAll(array('order'=>'id_unit DESC'));

        if (!empty($_POST)) {
            $pil_unit = Yii::app()->request->getPost('unit');
            $nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->request->getPost('awal');
            $akhir = Yii::app()->request->getPost('akhir');
            $this->render('pendapatan', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'nama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
        } else {
            $pil_unit = null;
            $this->render('pendapatan', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'awal' => null,
                'akhir' => null
            ));
        }
    }
    
    public function actionPendapatan_2() {
        $unit = Unit::model()->findAll(array('order'=>'id_unit DESC'));

        if (!empty($_POST)) {
            $pil_unit = Yii::app()->request->getPost('unit');
            $nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->request->getPost('awal');
            $akhir = Yii::app()->request->getPost('akhir');
            $this->render('pendapatan_2', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'nama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
        } else {
            $pil_unit = null;
            $this->render('pendapatan_2', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'awal' => null,
                'akhir' => null
            ));
        }
    }
    
    public function actionExcelPendapatan($id,$b,$e) {
            $this->layout = false;
            $pil_unit = Yii::app()->request->getQuery('id');
            $nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->getRequest()->getQuery('b');
            $akhir = Yii::app()->getRequest()->getQuery('e');
            $this->render('excelPendapatan', array(
                'id' => $id,
                'pil_unit' => $pil_unit,
                'nama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
    }
    
    
    

    public function actionPflBulanan() {
        $this->layout='wide_main';
        $query_bulan = "SELECT DISTINCT DATE_FORMAT(a.tgl_order_masuk,'%Y-%m') as BLN
                       FROM registrasi_penyewaan a ORDER BY tgl_order_masuk DESC";
        $bulan = Yii::app()->db->createCommand($query_bulan)->queryAll();
        $pil_bulan = Yii::app()->request->getPost('bulan');
        $jenis_tampilan = Yii::app()->request->getParam('jenis_tampilan');
        if($jenis_tampilan==1){
            $view= 'pflBulanan_registrasi';
        }else if($jenis_tampilan==2){
            $view= 'pflBulanan_pelunasan';
        }else{
            $view= 'pflBulanan';
        }
        $data = 1;
        $this->render($view, array(
            'bulan' => $bulan,
            'jenis_tampilan'=>$jenis_tampilan,
            'pil_bulan'=>$pil_bulan
        ));
    }

    public function actionPflBulananRead() {

        $this->render('pflBulananRead');
    }
    
    public function actionExcelPfl($id) {
        $this->layout = false;
        $pil_bulan = Yii::app()->request->getQuery('id');
        $jenis_tampilan = Yii::app()->request->getParam('jenis_tampilan');
        if($jenis_tampilan==1){
            $view= 'excelPfl_registrasi';
        }else if($jenis_tampilan==2){
            $view= 'excelPfl_pelunasan';
        }else{
            $view= 'excelPfl';
        }
        $this->render($view, array(
            'pil_bulan'=>$pil_bulan
        ));
    }

    public function actionLks() {
        $query_view = "SELECT DATE_FORMAT(tgl_order_masuk,'%Y') AS tahun
                        FROM `registrasi_penyewaan`
                        GROUP BY tahun";
        $tahun = Yii::app()->db->createCommand($query_view)->queryAll();
        $pasien_riset = PasienTipe::model()->findAllByAttributes(array('jenis_pasien_tipe' => '1'));
        $pasien_klinik = PasienTipe::model()->findAllByAttributes(array('jenis_pasien_tipe' => '2'));
        if (!empty($_POST)) {
            $pil_tahun = Yii::app()->request->getPost('tahun');
        } else {
            $pil_tahun = null;
        }
        $this->render('lks-baru', array(
            'pasien_riset' => $pasien_riset,
            'pasien_klinik' => $pasien_klinik,
            'tahun' => $tahun,
            'pil_tahun' => $pil_tahun
        ));
    }

    public function actionExcelLks($id) {
        $pil_tahun = Yii::app()->request->getQuery('id');
        $this->layout = false;
        $pasien_riset = PasienTipe::model()->findAllByAttributes(array('jenis_pasien_tipe' => '1'));
        $pasien_klinik = PasienTipe::model()->findAllByAttributes(array('jenis_pasien_tipe' => '2'));
        $this->render('excelLks', array(
            'pasien_riset' => $pasien_riset,
            'pasien_klinik' => $pasien_klinik,
            'pil_tahun' => $pil_tahun
        ));
    }

    public function actionPendLab() {
             $unit = Unit::model()->findAll(array('order'=>'id_unit DESC'));
             //$pil_instansi = Yii::app()->request->getQuery('id');
             
        if (!empty($_POST)) {
            $pil_unit = Yii::app()->request->getPost('unit');
            $nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->request->getPost('awal');
            $akhir = Yii::app()->request->getPost('akhir');
            $this->render('pendLab', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'nnama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
        } else {
            //$awal = "0000-00-00";
            //$akhir = "0000-00-00";
            $pil_unit = null;
            $this->render('pendLab', array(
                'unit' => $unit,
                'pil_unit' => null,
                'nama_unit' => null,
                'awal' =>  NULL,
                'akhir' => null
            ));
            }
    
    }
    
    public function actionCtkPendLab($id, $e, $b){
            $this->layout = 'wide_main';
            $pil_unit = Yii::app()->request->getQuery('id');
            $awal = Yii::app()->request->getQuery('b');
            $akhir = Yii::app()->request->getQuery('e');
            $this->render('ctkPendLab', array(
                'pil_unit' => $pil_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
        
    }
    
    public function actionPiutang() {
        $instansi = Instansi::model()->findAll();
        $data_dokter = Dokter::model()->findAll();
        if (!empty($_POST)) {
            $pil_instansi = Yii::app()->request->getPost('instansi');
            $nama_instansi = Instansi::model()->findByAttributes(array('id_instansi' => $pil_instansi));
            $awal = Yii::app()->request->getPost('awal');
            $akhir = Yii::app()->request->getPost('akhir');
            $pil_dokter = Yii::app()->request->getPost('dokter');
            $status_bayar = Yii::app()->request->getPost('status_bayar');
            $this->render('piutang', array(
                'instansi' => $instansi,
                'pil_instansi' => $pil_instansi,
                'nama_instansi' => $nama_instansi,
                'awal' => $awal,
                'akhir' => $akhir,
                'data_dokter' => $data_dokter,
                'pil_dokter' => $pil_dokter,
                'status_bayar' => $status_bayar
            ));
        } else {
            $pil_unit = null;
            $this->render('piutang', array(
                'instansi' => $instansi,
                'pil_instansi' => null,
                'nama_instansi' => null,
                'awal' => null,
                'akhir' => null,
                'data_dokter' => $data_dokter,
                'pil_dokter' => null,
                'status_bayar' => null
                
            ));
            }
        
    }
    
    
    public function actionPel_piutang(){
        //$this->layout = 'wide_main';
        if (!empty($_POST)) {
          $awal = Yii::app()->request->getPost('awal');
          $akhir = Yii::app()->request->getPost('akhir');  
          $awal_pel = Yii::app()->request->getPost('awal_pel');
          $akhir_pel = Yii::app()->request->getPost('akhir_pel'); 
          $pil = 2;
          $this->render('pel_piutang', array(
          'pil_unit' => null,
          'awal' => $awal,
          'akhir' => $akhir,
          'awal_pel' => $awal_pel,
          'akhir_pel' => $akhir_pel,
          'pil' => $pil
              
            )); 
        }
        else{
          $this->render('pel_piutang', array(
          'pil_unit' => null,
          'awal' => null,
          'akhir' => null,
          'awal_pel' => null,
          'akhir_pel' => null,
          'pil'=> null
              ));
        }
        
    }
    
     public function actionCtkPel_piutang($p){
            $this->layout = 'wide_main';
            $q = Yii::app()->request->getQuery('p');
            $pelunasan = explode('--', $q);
            $awal_pel = $pelunasan[0];
            $akhir_pel = $pelunasan[1];
            $this->render('ctkPelpiutang', array(
                'awal_pel' => $awal_pel,
                'akhir_pel' => $akhir_pel
            ));
        
    }
    
    
    public function actionCtkPiutang($id,$b,$e, $d, $sp) {
            $this->layout = 'wide_main';
            $pil_instansi = Yii::app()->request->getQuery('id');
            $nama_instansi = Instansi::model()->findByAttributes(array('id_instansi' => $pil_instansi));
            $awal = Yii::app()->request->getQuery('b');
            $akhir = Yii::app()->request->getQuery('e');
            $pil_dokter = Yii::app()->request->getQuery('d'); 
            $status_bayar = Yii::app()->request->getQuery('sp');
            $this->render('ctkPiutang', array(
                'pil_instansi' => $pil_instansi,
                'nama_instansi' => $nama_instansi,
                'awal' => $awal,
                'akhir' => $akhir,
                'status_bayar' => $status_bayar,
                'pil_dokter' => $pil_dokter
            ));
       
            
        
    }
    
     public function actionPascovid() {
        $unit = Unit::model()->findAll(array('order'=>'id_unit DESC'));

        if (!empty($_POST)) {
            $pil_unit = Yii::app()->request->getPost('unit');
            $nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->request->getPost('awal');
            $akhir = Yii::app()->request->getPost('akhir');
            $this->render('pascovid', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'nama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
        } else {
            $pil_unit = null;
            $this->render('pascovid', array(
                'unit' => $unit,
                'pil_unit' => $pil_unit,
                'awal' => null,
                'akhir' => null
            ));
        }
    }
    
    public function actionExcelPascovid($b,$e) {
            $this->layout = false;
            //$pil_unit = Yii::app()->request->getQuery('id');
            //$nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->getRequest()->getQuery('b');
            $akhir = Yii::app()->getRequest()->getQuery('e');
            $this->render('excelPascovid', array(
                //'id' => $id,
                //'pil_unit' => $pil_unit,
                //'nama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
    }
    
    public function actionExcelPendLab($b,$e) {
            $this->layout = false;
            //$pil_unit = Yii::app()->request->getQuery('id');
            //$nama_unit = Unit::model()->findByAttributes(array('id_unit' => $pil_unit));
            $awal = Yii::app()->getRequest()->getQuery('b');
            $akhir = Yii::app()->getRequest()->getQuery('e');
            $this->render('excelPendLab', array(
                //'id' => $id,
                //'pil_unit' => $pil_unit,
                //'nama_unit' => $nama_unit,
                'awal' => $awal,
                'akhir' => $akhir
            ));
    }
}
