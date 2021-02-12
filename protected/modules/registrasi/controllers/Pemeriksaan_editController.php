<?php

    class Pemeriksaan_editController extends Controller
    {

        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
                'accessControl', // perform access control for CRUD operations
            );
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         * @return array access control rules
         */
        public function accessRules()
        {
            return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('read', 'update', 'delete', 'readDataAjax'),
                    'users' => array('@'),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        private function getPasienPemeriksan($id_registrasi)
        {
            $result = array();
            $data_pasien_pemeriksaan = Yii::app()->db->createCommand("
                    select pp.*,p.nama_pengujian,p.nilai_normal,p.kode_pengujian 
                    from pasien_pemeriksaan pp
                    join pengujian p on pp.id_pengujian=p.id_pengujian
                    where pp.id_registrasi_pemeriksaan='{$id_registrasi}'
                    ")->queryAll();
            foreach ($data_pasien_pemeriksaan as $d) {
                $query_sample_pasien = "
            select rps.*,s.nama_sample,ps.id_pemeriksaan_sample
            from registrasi_pasien_sample rps
            join sample s on rps.id_sample=s.id_sample
            left join pemeriksaan_sample ps on ps.id_registrasi_pasien_sample =rps.id_registrasi_pasien_sample and ps.id_pasien_pemeriksaan='{$d['id_pasien_pemeriksaan']}'
            where rps.id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'
            order by rps.waktu_masuk desc,s.nama_sample
            ";
                $data_sample = Yii::app()->db->createCommand($query_sample_pasien)->queryAll();

                $query_bahan_pasien = "
            select bps.*,bp.*,bpp.id_bahan_pengujian_pasien
            from bahan_pasien bps
            join bahan_pengujian bp on bp.id_bahan_pengujian=bps.id_bahan_pengujian
            left join bahan_pengujian_pasien bpp on bpp.id_bahan_pasien = bps.id_bahan_pasien and bpp.id_pasien_pemeriksaan='{$d['id_pasien_pemeriksaan']}'
            where bps.id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'
            order by bp.nama_bahan
            ";
                $data_bahan_pasien = Yii::app()->db->createCommand($query_bahan_pasien)->queryAll();
                $result[] = array_merge($d, array('data_sample' => $data_sample, 'data_bahan' => $data_bahan_pasien));

            }
            return $result;
        }

        private function getDataPengujian()
        {
            $arr_result = array();
            $data_kelompok = Yii::app()->db->createCommand("select * from pengujian_kelompok order by id_pengujian_kelompok")->queryAll();
            foreach ($data_kelompok as $dk) {
                $arr_data_pengujian = array();
                $data_pengujian = Yii::app()->db->createCommand("select * from pengujian where id_pengujian_kelompok='{$dk['id_pengujian_kelompok']}'")->queryAll();
                foreach ($data_pengujian as $dp) {
                    if ($dp['jenis_pengujian'] == '2' && $dp['id_pengujian_group'] == '') {
                        array_push($arr_data_pengujian, $dp);
                    } else if ($dp['jenis_pengujian'] == '1' && $dp['id_pengujian_group'] == '') {
                        $data_anak_pengujian = Yii::app()->db->createCommand("select * from pengujian where id_pengujian_group='{$dp['id_pengujian']}'")->queryAll();
                        array_push($arr_data_pengujian, array_merge($dp, array('data_anak' => $data_anak_pengujian)));
                    }
                }
                array_push($arr_result, array_merge($dk, array('data_pengujian' => $arr_data_pengujian)));
            }
            return $arr_result;
        }

        private function getJumlahPasienPemeriksaan($id_registrasi)
        {
            return Yii::app()->db->createCommand("select count(*) from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryScalar();
        }

        private function getPembayaranPemeriksaan($id_registrasi)
        {
            return Yii::app()->db->createCommand("select * from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryAll();
        }

        private function getJumlahPembayaranPemeriksaan($id_registrasi)
        {
            return Yii::app()->db->createCommand("select sum(total_biaya) total_biaya,sum(potongan) potongan,sum(total_dibayar) total_bayar from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
        }

        public function actionRead()
        {
            $id_user_login = Yii::app()->user->getId();
            $id_template_user = Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user_login}' and status_aktif='1'")->queryScalar();

            //$data_pasien = Yii::app()->db->createCommand($query_view)->queryAll();
            $this->render('read', array(
                //'data_pasien' => $data_pasien,
                'id_template_user' => $id_template_user
            ));
        }

        public function actionReadDataAjax()
        {
            $id_user_login = Yii::app()->user->getId();
            $id_template_user = Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user_login}' and status_aktif='1'")->queryScalar();
            $start = Yii::app()->request->getParam('start');
            $length = Yii::app()->request->getParam('length');
            $draw = Yii::app()->request->getParam('draw');
            $search_arr = Yii::app()->request->getParam('search');
            $search = $search_arr['value'];
            $query_view = "
            select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi,pemp.*
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join instansi i on i.id_instansi=r.id_instansi
            left join (
                select id_registrasi_pemeriksaan,
                   coalesce(sum(total_biaya),0) total_biaya,
                   coalesce(sum(potongan),0) potongan,
                   coalesce(sum(total_dibayar),0) total_bayar 
                from pembayaran_pemeriksaan
                group by id_registrasi_pemeriksaan
            ) as pemp on pemp.id_registrasi_pemeriksaan=r.id_registrasi_pemeriksaan
            where lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            order by r.waktu_registrasi desc
            limit {$start},{$length}
            ";

            $query_view_search = "
            select p.*,r.*,i.nama_instansi
            from pasien p
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join instansi i on i.id_instansi=r.id_instansi
             where lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
            order by r.waktu_registrasi desc
            ";
            $data = Yii::app()->db->createCommand($query_view)->queryAll();

            $data_search = Yii::app()->db->createCommand($query_view_search)->queryAll();
            $jumlah_all = RegistrasiPemeriksaan::model()->count();
            $jumlah_filtered = count($data_search);
            $no = 1;
            $result = array();
            foreach ($data as $d) {
                // AUTO UPDATE DATA STATUS PEMBAYARAN
                if ($d['total_bayar'] > 0 && $d['total_biaya'] == ($d['total_bayar'] + $d['potongan'])) {
                    $d['status_pembayaran'] = 1;
                    Yii::app()->db->createCommand("update registrasi_pemeriksaan set status_pembayaran=1 where id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'")->query();
                } else {
                    Yii::app()->db->createCommand("update registrasi_pemeriksaan set status_pembayaran=0 where id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'")->query();
                }
                if ($d['status_registrasi'] == 0) {
                    $status_registrasi = '<span class="btn btn-info">Baru</span>';
                } else if ($d['status_registrasi'] == 1) {
                    $status_registrasi = '<span class="btn btn-warning">Proses Pengujian</span>';
                } else if ($d['status_registrasi'] == 2) {
                    $status_registrasi = '<span class="btn btn-success">Sudah Selesai</span>';
                }

                if ($d['status_pembayaran'] == 0) {
                    $status_pembayaran = '<span class="btn btn-danger">Belum Ada</span>';
                } else if ($d['status_pembayaran'] == 1) {
                    $status_pembayaran = '<span class="btn btn-success">Lunas</span>';
                }
                $action = '<a class="btn" title="Registrasi" href="' . Yii::app()->createUrl('registrasi/pemeriksaan_edit/update?reg=' . $d['id_registrasi_pemeriksaan']) . '" ><i class=" icon-list-alt"></i></a>';
                if (in_array($id_template_user, array(1))) {
                    $action .= '<a class="btn registrasi-pemeriksaan-delete-button" title="Delete" id="' . $d['id_registrasi_pemeriksaan'] . '" ><i class="icon-remove"></i></a>';
                }

                $result[] = [
                    $d['no_registrasi'],
                    $d['waktu_registrasi'],
                    $d['nama'] . '<br/>' . $d['nama_instansi'],
                    $d['keluhan_diagnosa'],
                    $status_registrasi,
                    $status_pembayaran,
                    $action
                ];

            }
            echo json_encode(array('draw' => $draw, 'recordsTotal' => $jumlah_all, 'recordsFiltered' => $jumlah_filtered, 'data' => $result));
        }

        public function actionUpdate()
        {
            $step = 1;
            $id_pasien = Yii::app()->request->getParam('pasien');
            $id_registrasi = Yii::app()->request->getParam('reg');
            $id_user_login = Yii::app()->user->getId();
            $data_pasien_pemeriksaan = array();
            $data_pasien = array();
            $data_registrasi = array();
            $data_pembayaran = array();
            $data_sample_pasien = array();
            $data_bahan_pasien = array();
            $data_biaya_tambahan = array();
            if (!empty($_POST)) {
                $mode = Yii::app()->request->getPost('mode');
                if ($mode == 'pasien') {
                    $id_pasien = Yii::app()->request->getPost('id_pasien');
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
                        $id_pasien = $pasien->id_pasien;
                        $step = 1;
                        Yii::app()->user->setFlash('success_pasien', 'Data Pasien berhasil dimasukkan');
                    } else {
                        print_r($pasien->getErrors());
                    }
                } else if ($mode == 'registrasi') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    if (!empty($id_registrasi)) {
                        $registrasi = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                    } else {
                        $registrasi = new RegistrasiPemeriksaan;
                    }

                    $registrasi->id_pasien = Yii::app()->request->getPost('pasien');
                    $registrasi->id_pasien_tipe = Yii::app()->request->getPost('pasien_tipe');
                    $registrasi->id_dokter_pengirim = Yii::app()->request->getPost('dokter_pengirim');
                    $registrasi->id_instansi = Yii::app()->request->getPost('instansi');
                    $registrasi->id_petugas_penerima = $id_user_login;
                    $registrasi->no_registrasi = Yii::app()->request->getPost('no_registrasi');
                    $registrasi->waktu_registrasi = Yii::app()->request->getPost('waktu_registrasi');
                    $registrasi->keluhan_diagnosa = Yii::app()->request->getPost('keluhan');
                    $registrasi->keterangan_registrasi = Yii::app()->request->getPost('keterangan');
                    $registrasi->uji_keperluan = Yii::app()->request->getPost('uji_keperluan');
                    $registrasi->uji_parameter = Yii::app()->request->getPost('uji_parameter');
                    $registrasi->uji_metode = Yii::app()->request->getPost('uji_metode');
                    $registrasi->status_registrasi = 0;
                    $registrasi->status_pembayaran = 0;
                    if ($registrasi->save()) {
                        $id_registrasi = $registrasi->id_registrasi_pemeriksaan;
                        $step = 2;
                        Yii::app()->user->setFlash('success_registrasi', 'Data Registrasi berhasil dimasukkan');
                    } else {
                        print_r($registrasi->getErrors());
                    }
                } else if ($mode == 'pemeriksaan') {
                    $jumlah_data = Yii::app()->request->getPost('jumlah_data');
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    for ($i = 1; $i < $jumlah_data; $i++) {
                        $id_pengujian = Yii::app()->request->getPost('pengujian_' . $i);
                        if (!empty($id_pengujian)) {
                            $pengujian = Pengujian::model()->findByPk($id_pengujian);
                            $pasien_pemeriksaan = new PasienPemeriksaan;
                            $pasien_pemeriksaan->id_pengujian = $id_pengujian;
                            $pasien_pemeriksaan->id_registrasi_pemeriksaan = $id_registrasi;
                            $pasien_pemeriksaan->besar_tarif = $pengujian->tarif_pengujian;
                            $pasien_pemeriksaan->besar_tarif_jasa = $pengujian->tarif_konsul;
                            $pasien_pemeriksaan->save();
                        }
                    }
                    // CEK PENGUJIAN GROUP
                    $data_pengujian_group_pasien = Yii::app()->db->createCommand("
                    select * from pengujian
                    where id_pengujian in (
                        select id_pengujian from pasien_pemeriksaan
                        where id_registrasi_pemeriksaan='{$id_registrasi}'
                    ) and jenis_pengujian='1'
                    ")->queryAll();
                    foreach ($data_pengujian_group_pasien as $dpg) {
                        // DELETE DATA PENGUJIAN ANAK PENGUJIAN
                        Yii::app()->db->createCommand("
                        delete from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}' and
                        id_pengujian in (select id_pengujian from pengujian where id_pengujian_group='{$dpg['id_pengujian']}')
                        ")->query();
                    }
                    Yii::app()->user->setFlash('success_pemeriksaan', 'Data Pemeriksaan berhasil dimasukkan');
                    $step = 3;
                } else if ($mode == 'tambah-sample') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    $sample_pasien = new RegistrasiPasienSample;
                    $sample_pasien->id_registrasi_pemeriksaan = $id_registrasi;
                    $sample_pasien->id_sample = Yii::app()->request->getPost('sample');
                    $sample_pasien->kode_sample = Yii::app()->request->getPost('kode');
                    $sample_pasien->waktu_masuk = Yii::app()->request->getPost('waktu_masuk');
                    $sample_pasien->jumlah_sample = Yii::app()->request->getPost('jumlah');
                    $sample_pasien->keterangan_sample = Yii::app()->request->getPost('keterangan');
                    if ($sample_pasien->save()) {
                        Yii::app()->user->setFlash('success_sample', 'Data Sample berhasil ditambah');
                    } else {
                        print_r($sample_pasien->getErrors());
                    }
                    $step = 3;
                } else if ($mode == 'tambah-bahan') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    $bahan_pasien = new BahanPasien;
                    $bahan_pasien->id_registrasi_pemeriksaan = $id_registrasi;
                    $bahan_pasien->id_bahan_pengujian = Yii::app()->request->getPost('bahan');
                    $bahan_pasien->jumlah_bahan = Yii::app()->request->getPost('jumlah_bahan');
                    $bahan_pasien->tarif_bahan = Yii::app()->request->getPost('tarif_bahan');
                    $bahan_pasien->total_tarif = Yii::app()->request->getPost('harga_total_bahan');
                    if ($bahan_pasien->save()) {
                        Yii::app()->user->setFlash('success_bahan', 'Data Bahan berhasil ditambah');
                    } else {
                        print_r($bahan_pasien->getErrors());
                    }
                    $step = 3;
                } else if ($mode == 'sample-pemeriksaan') {
                    $jumlah_data = Yii::app()->request->getPost('jumlah_data');
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');

                    $step = 4;
                } else if ($mode == 'tambah-biaya-tambahan') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    $biaya_tambahan = new PemeriksaanBiayaTambahan;
                    $biaya_tambahan->id_registrasi_pemeriksaan = $id_registrasi;
                    $biaya_tambahan->nama_biaya = Yii::app()->request->getPost('nama_biaya');
                    $biaya_tambahan->besar_biaya = Yii::app()->request->getPost('besar_biaya');
                    $biaya_tambahan->save();
                    Yii::app()->user->setFlash('success_tambah_biaya', 'Data Biaya Tambahan berhasil dimasukkan');
                    $step = 4;
                } else if ($mode == 'hapus-biaya-tambahan') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    $id_biaya_tambahan = Yii::app()->request->getPost('id_pemeriksaan_biaya_tambahan');
                    $biaya_tambahan = PemeriksaanBiayaTambahan::model()->findByPk($id_biaya_tambahan);
                    $biaya_tambahan->delete();
                    Yii::app()->user->setFlash('success_hapus_biaya', 'Data Biaya Tambahan berhasil dihapus');
                    $step = 4;
                } else if ($mode == 'pasien_pemeriksaan') {
                    $jumlah_data = Yii::app()->request->getPost('jumlah_data');
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    for ($i = 1; $i < $jumlah_data; $i++) {
                        $id_pasien_pemeriksaan = Yii::app()->request->getPost('pasien_pemeriksaan_' . $i);
                        $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                        $pasien_pemeriksaan->besar_tarif = Yii::app()->request->getPost('tp_pasien_pemeriksaan_' . $i);
                        $pasien_pemeriksaan->potongan = Yii::app()->request->getPost('pot_pasien_pemeriksaan_' . $i);
                        $pasien_pemeriksaan->tgl_selesai = Yii::app()->request->getPost('tgl_selesai_pasien_pemeriksaan' . $i);
                        $pasien_pemeriksaan->save();
                        // UPDATE SAMPLE
                        $sample = Yii::app()->request->getPost('sample' . $i);
                        Yii::app()->db->createCommand("delete from pemeriksaan_sample where id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->query();
                        if (count($sample) > 0) {
                            foreach ($sample as $sp) {
                                $pemeriksaan_sample = new PemeriksaanSample;
                                $pemeriksaan_sample->id_pasien_pemeriksaan = $id_pasien_pemeriksaan;
                                $pemeriksaan_sample->id_registrasi_pasien_sample = $sp;
                                $pemeriksaan_sample->save();
                            }
                        }
                        //UPDATE BAHAN
                        $bahan = Yii::app()->request->getPost('bahan' . $i);
                        Yii::app()->db->createCommand("delete from bahan_pengujian_pasien where id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->query();
                        if (count($bahan) > 0) {
                            foreach ($bahan as $b) {
                                $bahan_pengujian_pasien = new BahanPengujianPasien;
                                $bahan_pengujian_pasien->id_pasien_pemeriksaan = $id_pasien_pemeriksaan;
                                $bahan_pengujian_pasien->id_bahan_pasien = $b;
                                $bahan_pengujian_pasien->save();
                            }
                        }
                    }
                    Yii::app()->user->setFlash('success_update_pasien_pemeriksaan', 'Data Pasien Pemeriksaan berhasil diupdate');
                    $step = 4;
                } else if ($mode == 'pembayaran') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    $pembayaran = new PembayaranPemeriksaan;
                    $pembayaran->id_registrasi_pemeriksaan = $id_registrasi;
                    $pembayaran->waktu_pembayaran = Yii::app()->request->getPost('waktu_pembayaran');
                    $pembayaran->total_biaya = Yii::app()->request->getPost('total_biaya');
                    $pembayaran->potongan = Yii::app()->request->getPost('potongan');
                    $pembayaran->total_dibayar = Yii::app()->request->getPost('total_dibayar');
                    if (!empty(Yii::app()->request->getPost('tgl_jatuh_tempo'))) {
                        $pembayaran->tgl_jatuh_tempo = Yii::app()->request->getPost('tgl_jatuh_tempo');
                    }
                    $pembayaran->status_pembayaran = Yii::app()->request->getPost('status_pembayaran');
                    $pembayaran->via_pembayaran = Yii::app()->request->getPost('via_pembayaran');
                    $pembayaran->keterangan = Yii::app()->request->getPost('keterangan');
                    $pembayaran->save();
                    Yii::app()->user->setFlash('success_pembayaran', 'Data Pembayaran Berhasil di tambah');
                    $step = 4;
                } else if ($mode == 'kirim_whatsapp') {
                    $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                    $registrasi = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                    // Sync update status pasien antrian
                    $query_cek_integrasi = "SELECT * 
                        FROM sync_antrian
                        WHERE id_pasien='{$registrasi->id_pasien}'";
                    $data = Yii::app()->db->createCommand($query_cek_integrasi)->queryRow();
                    if (!empty($data)) {
                        // Send API Update Status
                        $response = Yii::app()->curl->get(Yii::app()->params['api_registrasi'] . '/registrasi/update-status/' . $data['id_antrian_reg_pasien'],
                            [
                                'status' => 2
                            ]
                        );
                        $response = json_decode($response);
                        if (!empty($response) && $response->status == '1') {
                            Yii::app()->user->setFlash('success_notifikasi', 'Notifikasi WhatsApp berhasil dikirim');
                        } else {
                            Yii::app()->user->setFlash('error_notifikasi', 'Gagal kirim notifikasi, silahkan ulangi lagi');
                        }
                    }
                    $step = 4;

                }
            }
            if (!empty($id_pasien)) {
                $data_pasien = Yii::app()->db->createCommand("select * from pasien where id_pasien='{$id_pasien}'")->queryRow();
            }
            if (!empty($id_registrasi)) {
                $data_pasien = Yii::app()->db->createCommand("select * from pasien where id_pasien in (select id_pasien from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}')")->queryRow();
                $data_registrasi = Yii::app()->db->createCommand("select * from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                $data_biaya_tambahan = Yii::app()->db->createCommand("select * from pemeriksaan_biaya_tambahan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryAll();
                $data_pasien_pemeriksaan = $this->getPasienPemeriksan($id_registrasi);
                $query_sample_pasien = "
            select rps.*,s.nama_sample
            from registrasi_pasien_sample rps
            join sample s on rps.id_sample=s.id_sample
            where rps.id_registrasi_pemeriksaan='{$id_registrasi}'
            order by rps.waktu_masuk desc,s.nama_sample
            ";
                $data_sample_pasien = Yii::app()->db->createCommand($query_sample_pasien)->queryAll();

                $query_bahan_pasien = "
            select bps.*,bp.*
            from bahan_pasien bps
            join bahan_pengujian bp on bp.id_bahan_pengujian=bps.id_bahan_pengujian
            where bps.id_registrasi_pemeriksaan='{$id_registrasi}'
            order by bp.nama_bahan
            ";
                $data_bahan_pasien = Yii::app()->db->createCommand($query_bahan_pasien)->queryAll();
                $data_pembayaran = $this->getPembayaranPemeriksaan($id_registrasi);
            }
            $data_jenis_sample = Sample::model()->findAll();
            $data_pasien_tipe = PasienTipe::model()->findAll();
            $data_propinsi = Propinsi::model()->findAll();
            $data_agama = Agama::model()->findAll();
            $data_instansi = Instansi::model()->findAll();
            $data_dokter = Dokter::model()->findAll();
            $data_bahan = BahanPengujian::model()->findAll();
            $data_pengujian = $this->getDataPengujian();
            $this->render('update_new', array(
                'id_pasien' => $id_pasien,
                'id_registrasi' => $id_registrasi,
                'data_pasien' => $data_pasien,
                'data_registrasi' => $data_registrasi,
                'data_pasien_tipe' => $data_pasien_tipe,
                'data_pengujian' => $data_pengujian,
                'data_propinsi' => $data_propinsi,
                'data_dokter' => $data_dokter,
                'data_instansi' => $data_instansi,
                'data_agama' => $data_agama,
                'data_bahan' => $data_bahan,
                'data_sample_pasien' => $data_sample_pasien,
                'data_bahan_pasien' => $data_bahan_pasien,
                'data_jenis_sample' => $data_jenis_sample,
                'data_pasien_pemeriksaan' => $data_pasien_pemeriksaan,
                'data_biaya_tambahan' => $data_biaya_tambahan,
                'data_pembayaran' => $data_pembayaran,
                'step' => $step
            ));
        }

        public function actionDelete()
        {
            $this->layout = false;
            $id_registrasi_pemeriksaan = Yii::app()->request->getPost('id');
            // DELETE BY PASIEN PEMERIKSAAN
            Yii::app()->db->createCommand("delete from bahan_pengujian_pasien where id_pasien_pemeriksaan in (select id_pasien_pemeriksaan from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}')")->query();
            Yii::app()->db->createCommand("delete from pemeriksaan_sample where id_pasien_pemeriksaan in (select id_pasien_pemeriksaan from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}')")->query();
            // DELETE BY REGISTRASI PEMERIKSAAN
            Yii::app()->db->createCommand("delete from registrasi_pasien_sample where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}'")->query();
            Yii::app()->db->createCommand("delete from pemeriksaan_biaya_tambahan where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}'")->query();
            Yii::app()->db->createCommand("delete from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}'")->query();
            Yii::app()->db->createCommand("delete from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}'")->query();
            Yii::app()->db->createCommand("delete from bahan_pasien where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}'")->query();
            Yii::app()->db->createCommand("delete from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi_pemeriksaan}'")->query();
            Yii::app()->end();
        }

    }
