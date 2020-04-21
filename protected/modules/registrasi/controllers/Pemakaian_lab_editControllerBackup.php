<?php

class Pemakaian_lab_editController extends Controller {

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
        $arr_data = array();
        $query_view = "
            select rp.*,i.nama_instansi,pt.nama_pasien_tipe,pb.*
            from registrasi_penyewaan rp
            left join instansi i on rp.id_instansi = i.id_instansi
            join pasien_tipe pt on pt.id_pasien_tipe=rp.id_pasien_tipe
            left join registrasi_penyewaan_bayar rpb on rpb.id_registrasi_penyewaan=rp.id_registrasi_penyewaan
            left join penyewaan_biaya pb on pb.id_registrasi_penyewaan_biaya=rpb.id_registrasi_penyewaan_biaya
            order by rp.tgl_order_masuk desc,rp.no_registrasi_penyewaan
            ";
        $data = Yii::app()->db->createCommand($query_view)->queryAll();
        $no_regis_index = $data[0]['no_registrasi_penyewaan'];
        $arr_data_temp = array();
        foreach ($data as $dp) {
            if ($no_regis_index != $dp['no_registrasi_penyewaan']) {
                array_push($arr_data, $arr_data_temp);
                $no_regis_index = $dp['no_registrasi_penyewaan'];
            }
            $arr_data_temp = $dp;
        }
        $this->render('read', array(
            'data_pasien' => $arr_data
        ));
    }

    public function actionUpdate() {
        $step = 1;
        $id_pasien = '';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_registrasi_penyewaan_biaya = '';
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $status_biaya = '';
        $jumlah_biaya_fasilitas = 0;
        $jumlah_data_registrasi = Yii::app()->db->createCommand("SELECT count(*) from registrasi_penyewaan where year(tgl_order_masuk)='" . date('y') . "'")->queryScalar();
        $jumlah_data_pembayaran = Yii::app()->db->createCommand("select count(*) from pembayaran_penyewaan")->queryScalar();
        $no_registrasi_auto = 'B' . date('Y') . str_pad($jumlah_data_registrasi + 1, 5, 0, STR_PAD_LEFT);
        $no_daftar_auto = str_pad($jumlah_data_registrasi + 1, 4, 0, STR_PAD_LEFT) . '/PFL/' . date('m') . '/REG/' . date('Y');
        $no_kwitansi_auto = str_pad($jumlah_data_pembayaran + 1, 4, 0, STR_PAD_LEFT) . '/PFL/' . date('m') . '/INV/' . date('Y');
        $id_user_login = Yii::app()->user->getId();
        $data_anggota_registrasi = array();
        $data_registrasi_fasiitas = array();
        $data_registrasi = array();
        $data_pembayaran = array();
        $penyewaan_biaya = array();
        $sudah_bayar_bench_fee=0;
        $sudah_bayar_deposit=0;
        $sudah_bayar_administrasi=0;
        $data_dokumen = DokumenPenyewaan::model()->findAll();

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'registrasi') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                if (!empty($id_registrasi)) {
                    $registrasi = RegistrasiPenyewaan::model()->findByPk($id_registrasi);
                } else {
                    $registrasi = new RegistrasiPenyewaan;
                }
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
                if ($registrasi->save()) {
                    $id_registrasi = $registrasi->id_registrasi_penyewaan;
                    // DELETE DOKUMEN PENYEWAAN
                    Yii::app()->db->createCommand("delete from registrasi_dokumen_penyewaan where no_registrasi_penyewaan='" . $registrasi->no_registrasi_penyewaan . "'")->query();
                    foreach ($_POST['dokumen'] as $dok) {
                        $registrasi_dokumen_penyewaan = new RegistrasiDokumenPenyewaan;
                        $registrasi_dokumen_penyewaan->no_registrasi_penyewaan = $registrasi->no_registrasi_penyewaan;
                        $registrasi_dokumen_penyewaan->id_dokumen_penyewaan = $dok;
                        $registrasi_dokumen_penyewaan->save();
                    }
                    $step = 2;
                    Yii::app()->user->setFlash('success_registrasi', 'Data Registrasi berhasil dimasukkan');
                } else {
                    print_r($registrasi->getErrors());
                }
            } else if ($mode == 'tambah-anggota') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $anggota_penyewaan = new RegistrasiAnggotaPenyewaan;
                $anggota_penyewaan->no_registrasi_penyewaan = $no_registrasi;
                $anggota_penyewaan->nama_anggota = Yii::app()->request->getPost('nama_anggota');
                $anggota_penyewaan->judul_anggota = Yii::app()->request->getPost('judul');
                $anggota_penyewaan->status_anggota = Yii::app()->request->getPost('status_anggota');
                $anggota_penyewaan->save();
                $cek_anggota_penyewaan = Yii::app()->db->createCommand("select count(*) from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryScalar();
                if ($cek_anggota_penyewaan > 0) {
                    Yii::app()->db->createCommand("update registrasi_penyewaan set status_team_penelitian=2 where no_registrasi_penyewaan='{$no_registrasi}'")->query();
                } else if ($cek_anggota_penyewaan == 0) {
                    Yii::app()->db->createCommand("update registrasi_penyewaan set status_team_penelitian=1 where no_registrasi_penyewaan='{$no_registrasi}'")->query();
                }
                Yii::app()->user->setFlash('success_tambah_anggota', 'Data Anggota Berhasil ditambah');
                $step = 2;
            } else if ($mode == 'delete-anggota') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $id_anggota_penyewaan = Yii::app()->request->getPost('id_anggota_penyewaan');
                $anggota_penyewaan = RegistrasiAnggotaPenyewaan::model()->findByPk($id_anggota_penyewaan);
                $anggota_penyewaan->delete();
                $cek_anggota_penyewaan = Yii::app()->db->createCommand("select count(*) from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryScalar();
                if ($cek_anggota_penyewaan > 0) {
                    Yii::app()->db->createCommand("update registrasi_penyewaan set status_team_penelitian=2 where no_registrasi_penyewaan='{$no_registrasi}'")->query();
                } else if ($cek_anggota_penyewaan == 0) {
                    Yii::app()->db->createCommand("update registrasi_penyewaan set status_team_penelitian=1 where no_registrasi_penyewaan='{$no_registrasi}'")->query();
                }
                Yii::app()->user->setFlash('success_delete_anggota', 'Data Anggota Berhasil dihapus');
                $step = 2;
            } else if ($mode == 'penyewaan-biaya') {
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
                $step = 3;
            } else if ($mode == 'tambah-fasilitas') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $pasien_penyewaan = new PasienPenyewaanBarang;
                $pasien_penyewaan->no_registrasi_penyewaan = $no_registrasi;
                $pasien_penyewaan->id_barang_sewa_tarif = Yii::app()->request->getPost('fasilitas');
                $pasien_penyewaan->tgl_awal_penyewaan = Yii::app()->request->getPost('tgl_awal_sewa');
                $pasien_penyewaan->tgl_akhir_penyewaan = Yii::app()->request->getPost('tgl_akhir_sewa');
                $pasien_penyewaan->lama_sewa = Yii::app()->request->getPost('jumlah_pemakaian');
                $pasien_penyewaan->besar_tarif = Yii::app()->request->getPost('tarif_sewa');
                $pasien_penyewaan->save();
                Yii::app()->user->setFlash('success_tambah_fasilitas', 'Data Pemakaian Fasilitas Biaya Berhasil ditambah');
                $step = 3;
            } else if ($mode == 'hapus-fasilitas') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $id_pasien_penyewaan = Yii::app()->request->getPost('id_pasien_penyewaan');
                $pasien_penyewaan = PasienPenyewaanBarang::model()->findByPk($id_pasien_penyewaan);
                $pasien_penyewaan->delete();
                Yii::app()->user->setFlash('success_hapus_fasilitas', 'Data Pemakaian Fasilitas Biaya Berhasil dihapus');
                $step = 3;
            } else if ($mode == 'selesai-fasilitas') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $step = 4;
            } else if ($mode == 'pembayaran') {
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $no_registrasi = Yii::app()->request->getPost('no_registrasi');
                $status_pembayaran = Yii::app()->request->getPost('status_pembayaran');
                $tgl_warning_order = Yii::app()->db->createCommand("select tgl_order_warning from registrasi_penyewaan where id_registrasi_penyewaan='{$id_registrasi}'")->queryScalar();
                $tgl_pembayaran = date('Y-m-d', strtotime(Yii::app()->request->getPost('waktu_pembayaran')));
                if ($tgl_pembayaran <= $tgl_warning_order && $status_pembayaran && $tgl_pembayaran != '') {
                    $pembayaran = new PembayaranPenyewaan;
                    $pembayaran->no_registrasi_penyewaan = $no_registrasi;
                    $pembayaran->no_kwitansi_pembayaran = Yii::app()->request->getPost('no_kwitansi_pembayaran');
                    $pembayaran->waktu_pembayaran = Yii::app()->request->getPost('waktu_pembayaran');
                    $pembayaran->total_biaya = Yii::app()->request->getPost('total_biaya');
                    $pembayaran->potongan = Yii::app()->request->getPost('potongan');
                    $pembayaran->total_dibayar = Yii::app()->request->getPost('total_dibayar');
                    $pembayaran->status_pembayaran = $status_pembayaran;
                    $pembayaran->via_pembayaran = Yii::app()->request->getPost('via_pembayaran');
                    $pembayaran->keterangan = Yii::app()->request->getPost('keterangan');
                    $pembayaran->save();
                    for ($i = 1; $i <= 7; $i++) {
                        $check_biaya = Yii::app()->request->getPost('check_biaya_' . $i);
                        if (!empty($check_biaya)) {
                            $pembayaran_detail = new PembayaranPenyewaanDetail;
                            $pembayaran_detail->id_pembayaran_penyewaan = $pembayaran->id_pembayaran_penyewaan;
                            $pembayaran_detail->nama_biaya = Yii::app()->request->getPost('nama_biaya_' . $i);
                            $pembayaran_detail->besar_biaya = Yii::app()->request->getPost('besar_biaya_' . $i);
                            $pembayaran_detail->save();
                        }
                    }
                    Yii::app()->user->setFlash('success_pembayaran', 'Data Pembayaran Berhasil ditambah');
                } else {
                    Yii::app()->user->setFlash('error_pembayaran', 'Data Pembayaran Gagal ditambah, sudah melebihi tanggal warning order !!!');
                }
                $step = 4;
            }
        }
        if (!empty($id_registrasi)) {
            $data_registrasi = Yii::app()->db->createCommand("select * from registrasi_penyewaan where id_registrasi_penyewaan='{$id_registrasi}'")->queryRow();
            $no_registrasi = $data_registrasi['no_registrasi_penyewaan'];
            $data_anggota_registrasi = Yii::app()->db->createCommand("select * from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();
            $id_registrasi_penyewaan_biaya = Yii::app()->db->createCommand("select id_registrasi_penyewaan_biaya from registrasi_penyewaan_bayar where id_registrasi_penyewaan='{$id_registrasi}'")->queryScalar();
            $penyewaan_biaya = Yii::app()->db->createCommand("select * from penyewaan_biaya where id_registrasi_penyewaan_biaya='{$id_registrasi_penyewaan_biaya}'")->queryRow();
            $jumlah_biaya_fasilitas = Yii::app()->db->createCommand("select sum(besar_tarif) from pasien_penyewaan_barang where no_registrasi_penyewaan='{$no_registrasi}'")->queryScalar();
            $data_pembayaran = $this->getPembayaranPenyewaan($no_registrasi);
            $status_biaya = $data_registrasi['status_biaya'];
            $query_registrasi_fasilitas = "
                    select ppb.*,bs.*,bst.*,ss.nama_satuan
                    from pasien_penyewaan_barang ppb
                    join barang_sewa_tarif bst on bst.id_barang_sewa_tarif=ppb.id_barang_sewa_tarif
                    join barang_sewa bs on bs.id_barang_sewa=bst.id_barang_sewa
                    join satuan_sewa ss on ss.id_satuan_sewa =bst.id_satuan_sewa
                    where ppb.no_registrasi_penyewaan = '{$no_registrasi}'
                    order by bs.id_barang_sewa
                    ";
            $data_registrasi_fasiitas = Yii::app()->db->createCommand($query_registrasi_fasilitas)->queryAll();
            $query_dokumen_penyewaan = "
                    select dp.*,rdp.no_registrasi_penyewaan
                    from dokumen_penyewaan dp
                    left join registrasi_dokumen_penyewaan rdp on rdp.id_dokumen_penyewaan=dp.id_dokumen_penyewaan and rdp.no_registrasi_penyewaan='{$no_registrasi}'
                    ";
            $data_dokumen = Yii::app()->db->createCommand($query_dokumen_penyewaan)->queryAll();
            $query_sudah_bayar_bench_fee ="
                select sum(ppd.besar_biaya) from pembayaran_penyewaan pp
                left join pembayaran_penyewaan_detail ppd on ppd.id_pembayaran_penyewaan=pp.id_pembayaran_penyewaan
                where pp.no_registrasi_penyewaan='B201500005' and ppd.nama_biaya='Bench Fee'
                ";
            $sudah_bayar_bench_fee = Yii::app()->db->createCommand($query_sudah_bayar_bench_fee)->queryScalar();
            $query_sudah_bayar_deposit ="
                select sum(ppd.besar_biaya) from pembayaran_penyewaan pp
                left join pembayaran_penyewaan_detail ppd on ppd.id_pembayaran_penyewaan=pp.id_pembayaran_penyewaan
                where pp.no_registrasi_penyewaan='B201500005' and ppd.nama_biaya='Deposit'
                ";
            $sudah_bayar_deposit = Yii::app()->db->createCommand($query_sudah_bayar_deposit)->queryScalar();
            $query_sudah_bayar_administrasi ="
                select sum(ppd.besar_biaya) from pembayaran_penyewaan pp
                left join pembayaran_penyewaan_detail ppd on ppd.id_pembayaran_penyewaan=pp.id_pembayaran_penyewaan
                where pp.no_registrasi_penyewaan='B201500005' and ppd.nama_biaya='Administrasi'
                ";
            $sudah_bayar_administrasi = Yii::app()->db->createCommand($query_sudah_bayar_administrasi)->queryScalar();
        }
        $query_fasilitas_sewa = "
            select bs.*,bst.*,ss.nama_satuan
            from barang_sewa bs
            join barang_sewa_tarif bst on bst.id_barang_sewa=bs.id_barang_sewa
            join satuan_sewa ss on ss.id_satuan_sewa =bst.id_satuan_sewa
            order by bs.id_barang_sewa
            ";
        $data_fasilitas_sewa = Yii::app()->db->createCommand($query_fasilitas_sewa)->queryAll();
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
            'no_registrasi_auto' => $no_registrasi_auto,
            'no_daftar_auto' => $no_daftar_auto,
            'no_kwitansi_auto' => $no_kwitansi_auto,
            'penyewaan_biaya' => $penyewaan_biaya,
            'jumlah_biaya_fasilitas' => $jumlah_biaya_fasilitas,
            'id_registrasi_penyewaan_biaya' => $id_registrasi_penyewaan_biaya,
            'data_registrasi' => $data_registrasi,
            'data_fasilitas_sewa' => $data_fasilitas_sewa,
            'data_registrasi_fasilitas' => $data_registrasi_fasiitas,
            'data_anggota_registrasi' => $data_anggota_registrasi,
            'data_dokumen' => $data_dokumen,
            'data_pasien_tipe' => $data_pasien_tipe,
            'data_propinsi' => $data_propinsi,
            'data_instansi' => $data_instansi,
            'data_agama' => $data_agama,
            'data_penyewaan_biaya' => $data_penyewaan_biaya,
            'data_pembayaran' => $data_pembayaran,
            'sudah_bayar_bench_fee'=>$sudah_bayar_bench_fee,
            'sudah_bayar_deposit'=>$sudah_bayar_deposit,
            'sudah_bayar_administrasi'=>$sudah_bayar_administrasi,
            'step' => $step
        ));
    }

}
