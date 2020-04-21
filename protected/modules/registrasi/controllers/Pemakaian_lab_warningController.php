<?php

class Pemakaian_lab_warningController extends Controller {

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

    

    public function actionRead() {
        $tanggal_sekarang = date('Y-m-d');
        $query_view = "
            select rp.*,i.nama_instansi,pt.nama_pasien_tipe,pb.*
            from registrasi_penyewaan rp
            left join instansi i on rp.id_instansi = i.id_instansi
            join pasien_tipe pt on pt.id_pasien_tipe=rp.id_pasien_tipe
            left join registrasi_penyewaan_bayar rpb on rpb.id_registrasi_penyewaan=rp.id_registrasi_penyewaan
            left join penyewaan_biaya pb on pb.id_registrasi_penyewaan_biaya=rpb.id_registrasi_penyewaan_biaya
            where rp.tgl_order_warning < STR_TO_DATE('$tanggal_sekarang','%Y-%m-%d') 
            and rp.no_registrasi_penyewaan not in (
                select no_registrasi_penyewaan from pembayaran_penyewaan where status_pembayaran=2
            )
            order by rp.tgl_order_masuk desc,rp.no_registrasi_penyewaan
            ";
        $data = Yii::app()->db->createCommand($query_view)->queryAll();
        $data_pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_pasien' => $data_pasien
        ));
    }

}
