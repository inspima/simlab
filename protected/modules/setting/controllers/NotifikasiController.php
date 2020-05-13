<?php

class NotifikasiController extends Controller {

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
                'actions' => array('read','unread','validasi','input','set_terbaca','set_belum','set_sudah_validasi','set_'),
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
        $tanggal_sekarang = date('Y-m-d');
        $id_user = Yii::app()->user->getId();
        $id_unit_pegawai = Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
        $id_template = Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user}' and status_aktif='1'")->queryScalar();
        /*
        if (!empty($id_unit_pegawai)) {
            $filter_unit = "
                and id_registrasi_pemeriksaan in (
                    select id_registrasi_pemeriksaan 
                    from pasien_pemeriksaan pp
                    join pengujian p on pp.id_pengujian = p.id_pengujian
                    where p.id_unit='{$id_unit_pegawai}'
                )
                ";
            $query_notifikasi = "
            select 
            (select count(*) from registrasi_pemeriksaan where status_registrasi in ('1','2') {$filter_unit}) total,
            (select count(*) from registrasi_pemeriksaan where status_registrasi=0 {$filter_unit}) baru,
            (select count(*) from registrasi_pemeriksaan where status_registrasi=1 {$filter_unit}) proses,
            (select count(*) from registrasi_pemeriksaan where status_registrasi=2 {$filter_unit}) sudah,
            (select count(*) from registrasi_penyewaan where tgl_order_warning < STR_TO_DATE('$tanggal_sekarang','%Y-%m-%d') 
                and no_registrasi_penyewaan not in (select no_registrasi_penyewaan from pembayaran_penyewaan where status_pembayaran=2)
            ) order_warning
            from dual
        ";
        } else {
            $query_notifikasi = "
            select 
            (select count(*) from registrasi_pemeriksaan where status_registrasi in ('1','2')) total,
            (select count(*) from registrasi_pemeriksaan where status_registrasi=0) baru,
            (select count(*) from registrasi_pemeriksaan where status_registrasi=1) proses,
            (select count(*) from registrasi_pemeriksaan where status_registrasi=2) sudah,
            (select count(*) from registrasi_penyewaan where tgl_order_warning < STR_TO_DATE('$tanggal_sekarang','%Y-%m-%d') 
                and no_registrasi_penyewaan not in (select no_registrasi_penyewaan from pembayaran_penyewaan where status_pembayaran=2)
            ) order_warning
            from dual
        ";
        }
        $notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryRow();
        if (in_array($id_template, array(2, 3))) {
            $result = array(
                'total' => $notifikasi['order_warning'],
                'order_warning' => $notifikasi['order_warning'],
                'template' => $id_template,
            );
        } else if (in_array($id_template, array(4))) {
            $result = array(
                'total' => $notifikasi['total'],
                'baru' => $notifikasi['baru'],
                'proses' => $notifikasi['proses'],
                'sudah' => $notifikasi['sudah'],
                'template' => $id_template,
            );
        } else if (in_array($id_template, array(1))) {
            $result = array(
                'total' => $notifikasi['total'] + $notifikasi['order_warning'],
                'baru' => $notifikasi['baru'],
                'proses' => $notifikasi['proses'],
                'sudah' => $notifikasi['sudah'],
                'order_warning' => $notifikasi['order_warning'],
                'template' => $id_template,
            );
        } else {
            $result = array(
                'total' => 0,
                'baru' => 0,
                'proses' => 0,
                'sudah' => 0,
                'template' => $id_template,
            );
        }
         
         */
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1' and baca='0'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('read', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }

    public function actionUnread() {
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1'  and baca='1'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('unread', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }

    public function actionValidasi() {
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1'  and isi_notifikasi like '%telah divalidasi%'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('validasi', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }

    public function actionInput() {
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1'   and isi_notifikasi like '%dimasukkan/diupdate%'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('input', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }
    
    public function actionSet_terbaca() {
        $this->layout=false;
        $id = Yii::app()->request->getPost('id');
        $notifikasi = Notifikasi::model()->findByPk($id);
        $notifikasi->baca=1;
        $notifikasi->save();
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1'  and baca='0'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('set-terbaca', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }

    public function actionSet_validasi() {
        $this->layout=false;
        $id = Yii::app()->request->getPost('id');
        $notifikasi = Notifikasi::model()->findByPk($id);
        $notifikasi->baca=1;
        $notifikasi->save();
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1'  and isi_notifikasi like '%telah divalidasi%'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('set-validasi', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }

    public function actionSet_input() {
        $this->layout=false;
        $id = Yii::app()->request->getPost('id');
        $notifikasi = Notifikasi::model()->findByPk($id);
        $notifikasi->baca=1;
        $notifikasi->save();
        $query_notifikasi ="
            SELECT DATEDIFF(now(),waktu_notifikasi) hitung_tampil,n.* FROM notifikasi n
            WHERE n.tampil='1'  and isi_notifikasi like '%dimasukkan/diupdate%'
            order by waktu_notifikasi desc
            ";
        $data_notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryAll();
        $this->render('set-terbaca', array(
            'data_notifikasi' => $data_notifikasi
        ));
    }

}
