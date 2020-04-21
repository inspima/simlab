<?php

class Pemakaian_lab_perpanjanganController extends Controller {

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

    private function getPembayaranPenyewaan($no_registrasi) {
        $result = array();

        $data_pembayaran = Yii::app()->db->createCommand("select * from pembayaran_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();
        foreach ($data_pembayaran as $d) {
            array_push($result, array_merge($d, array(
                'detail' => Yii::app()->db->createCommand("select * from pembayaran_penyewaan_detail where id_pembayaran_penyewaan='{$d['id_pembayaran_penyewaan']}'")->queryAll()
            )));
        }
        return $result;
    }

    public function actionRead() {
        $query_view = "
            select rp.*,i.nama_instansi,pt.nama_pasien_tipe,pb.*
            from registrasi_penyewaan rp
            left join instansi i on rp.id_instansi = i.id_instansi
            join pasien_tipe pt on pt.id_pasien_tipe=rp.id_pasien_tipe
            left join registrasi_penyewaan_bayar rpb on rpb.id_registrasi_penyewaan=rp.id_registrasi_penyewaan
            left join penyewaan_biaya pb on pb.id_registrasi_penyewaan_biaya=rpb.id_registrasi_penyewaan_biaya
            where rp.status_perpanjangan=1
            order by rp.tgl_order_masuk desc,rp.no_registrasi_penyewaan
            ";
        $data_pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_pasien' => $data_pasien
        ));
    }

    public function actionUpdate() {
        $step = 1;
        $id_pasien = '';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_registrasi_penyewaan_biaya = '';
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $jumlah_biaya_fasilitas = 0;
        $jumlah_data_registrasi = Yii::app()->db->createCommand("SELECT count(*) from registrasi_penyewaan where year(tgl_order_masuk)='".date('Y')."' and status_perpanjangan=2")->queryScalar();
        $perpanjangan_ke = Yii::app()->db->createCommand("select count(*) from registrasi_penyewaan where no_registrasi_penyewaan='{$no_registrasi}' and status_perpanjangan=2")->queryScalar();
        $no_daftar_auto = str_pad($jumlah_data_registrasi + 1, 4, 0, STR_PAD_LEFT) . '/PFL/' . date('m') . '/REG-P' . ($perpanjangan_ke + 1) . '/' . date('Y');
        $id_user_login = Yii::app()->user->getId();
         $status_biaya = '';
        $data_anggota_registrasi = array();
        $data_registrasi_fasiitas = array();
        $data_registrasi = array();
        $data_pembayaran = array();
        $penyewaan_biaya = array();
        $data_dokumen = DokumenPenyewaan::model()->findAll();

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'registrasi') {
                $registrasi = new RegistrasiPenyewaan;
                $registrasi->no_registrasi_penyewaan = Yii::app()->request->getPost('no_registrasi');
                $registrasi->id_petugas_penerima = $id_user_login;
                $registrasi->instansi_asal = Yii::app()->request->getPost('instansi_asal');
                $registrasi->status_biaya = Yii::app()->request->getPost('status_biaya');
                $registrasi->id_pasien_tipe = Yii::app()->request->getPost('pasien_tipe');
                $registrasi->tgl_order_masuk = Yii::app()->request->getPost('tgl_order_masuk');
                $registrasi->tgl_order_warning = Yii::app()->request->getPost('tgl_order_warning');
                $registrasi->no_surat_permohonan = Yii::app()->request->getPost('no_surat_permohonan');
                $registrasi->tgl_surat_permohonan = Yii::app()->request->getPost('tgl_surat_permohonan');
                $registrasi->no_kwitansi_daftar = Yii::app()->request->getPost('no_kwitansi_daftar');
                $registrasi->tgl_surat_daftar = Yii::app()->request->getPost('tgl_surat_daftar');
                $registrasi->nama_penanggung_jawab = Yii::app()->request->getPost('nama_penanggung_jawab');
                $registrasi->no_telp = Yii::app()->request->getPost('no_telp');
                $registrasi->no_hp = Yii::app()->request->getPost('no_hp');
                $registrasi->alamat_saat_ini = Yii::app()->request->getPost('alamat_saat_ini');
                $registrasi->keterangan_registrasi = Yii::app()->request->getPost('keterangan_registrasi');
                $registrasi->judul_penelitian = Yii::app()->request->getPost('judul_penelitian');
                $registrasi->status_team_penelitian = Yii::app()->db->createCommand("select status_team_penelitian from registrasi_penyewaan where id_registrasi_penyewaan='{$id_registrasi}'")->queryScalar();
                $registrasi->status_perpanjangan = 2;
                $registrasi->perpanjangan_ke = $perpanjangan_ke + 1;
                $registrasi->status_registrasi = 0;
                $registrasi->status_pembayaran = 0;
                if ($registrasi->save()) {
                    Yii::app()->user->setFlash('success_registrasi', 'Data Perpanjangan berhasil dimasukkan');
                    $id_registrasi = $registrasi->id_registrasi_penyewaan;
                    $step = 2;
                } else {
                    print_r($registrasi->getErrors());
                }
            }else if ($mode == 'penyewaan-biaya') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $regisrasi_penyewaan_biaya = Yii::app()->request->getPost('penyewaan_biaya');
                $cek_registrasi_penyewaan_biaya = Yii::app()->db->createCommand("select * from registrasi_penyewaan_bayar where id_registrasi_penyewaan='{$id_registrasi}'")->queryRow();
                if (!empty($cek_registrasi_penyewaan_biaya)) {
                    $penyewaan_bayar = RegistrasiPenyewaanBayar::model()->findByPk($cek_registrasi_penyewaan_biaya['id_registrasi_penyewaan_bayar']);
                    $penyewaan_bayar->id_registrasi_penyewaan = $id_registrasi;
                    $penyewaan_bayar->id_registrasi_penyewaan_biaya = $regisrasi_penyewaan_biaya;
                    if ($penyewaan_bayar->save()) {
                        $id_registrasi_penyewaan_biaya = $penyewaan_bayar->id_registrasi_penyewaan_biaya;
                        Yii::app()->user->setFlash('success_penyewaan_biaya', 'Data Penyewaan Biaya Berhasil diupdate');
                    } else {
                        print_r($penyewaan_bayar->getErrors());
                    }
                } else {
                    $penyewaan_bayar = new RegistrasiPenyewaanBayar;
                    $penyewaan_bayar->id_registrasi_penyewaan = $id_registrasi;
                    $penyewaan_bayar->id_registrasi_penyewaan_biaya = $regisrasi_penyewaan_biaya;
                    if ($penyewaan_bayar->save()) {
                        $id_registrasi_penyewaan_biaya = $penyewaan_bayar->id_registrasi_penyewaan_biaya;
                        Yii::app()->user->setFlash('success_penyewaan_biaya', 'Data Penyewaan Biaya Berhasil diupdate');
                    } else {
                        print_r($penyewaan_bayar->getErrors());
                    }
                }
                $step = 2;
            }
        }
        if (!empty($id_registrasi)) {
            $data_registrasi = Yii::app()->db->createCommand("select * from registrasi_penyewaan where id_registrasi_penyewaan='{$id_registrasi}'")->queryRow();
            $no_registrasi = $data_registrasi['no_registrasi_penyewaan'];
            $id_registrasi_penyewaan_biaya = Yii::app()->db->createCommand("select id_registrasi_penyewaan_biaya from registrasi_penyewaan_bayar where id_registrasi_penyewaan='{$id_registrasi}'")->queryScalar();
            $penyewaan_biaya = Yii::app()->db->createCommand("select * from penyewaan_biaya where id_registrasi_penyewaan_biaya='{$id_registrasi_penyewaan_biaya}'")->queryRow();
            $query_dokumen_penyewaan = "
                    select dp.*,rdp.no_registrasi_penyewaan
                    from dokumen_penyewaan dp
                    left join registrasi_dokumen_penyewaan rdp on rdp.id_dokumen_penyewaan=dp.id_dokumen_penyewaan and rdp.no_registrasi_penyewaan='{$no_registrasi}'
                    ";
            $data_dokumen = Yii::app()->db->createCommand($query_dokumen_penyewaan)->queryAll();
            $status_biaya = $data_registrasi['status_biaya'];
        }
        $data_pasien_tipe = PasienTipe::model()->findAll();
        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $data_instansi = Instansi::model()->findAll();
        if (!empty($status_biaya)) {
            $data_penyewaan_biaya = PenyewaanBiaya::model()->findAllByAttributes(array('status_biaya' => $status_biaya));
        } else {
            $data_penyewaan_biaya = PenyewaanBiaya::model()->findAll();
        }
        $this->render('update', array(
            'id_pasien' => $id_pasien,
            'id_registrasi' => $id_registrasi,
            'no_registrasi' => $no_registrasi,
            'no_daftar_auto' => $no_daftar_auto,
            'penyewaan_biaya' => $penyewaan_biaya,
            'jumlah_biaya_fasilitas' => $jumlah_biaya_fasilitas,
            'id_registrasi_penyewaan_biaya' => $id_registrasi_penyewaan_biaya,
            'data_registrasi' => $data_registrasi,
            'data_registrasi_fasilitas' => $data_registrasi_fasiitas,
            'data_anggota_registrasi' => $data_anggota_registrasi,
            'data_dokumen' => $data_dokumen,
            'data_pasien_tipe' => $data_pasien_tipe,
            'data_propinsi' => $data_propinsi,
            'data_instansi' => $data_instansi,
            'data_agama' => $data_agama,
            'data_penyewaan_biaya' => $data_penyewaan_biaya,
            'data_pembayaran' => $data_pembayaran,
            'step' => $step
        ));
    }

}
