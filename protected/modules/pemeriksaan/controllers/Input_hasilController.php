<?php

    class Input_hasilController extends Controller
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
                array(
                    'allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('read', 'readDataAjax', 'input', 'excel', 'template_excel'),
                    'users' => array('@'),
                ),
                array(
                    'deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        private function getAgePatient($birth)
        {
            if (!empty($birth)) {
                $bday = new DateTime(date('d-m-Y', strtotime($birth))); // Your date of birth
                $today = new Datetime(date('d-m-Y'));
                $diff = $today->diff($bday);
                return $diff->y . ' Tahun, ' . $diff->m . ' Bulan,' . $diff->d . ' Hari';
            } else {
                return '-';
            }
        }

        private function getPasienPemeriksan($id_registrasi)
        {
            $id_user = Yii::app()->user->getId();
            $id_unit_user = Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
            $q_unit_user = $id_unit_user == '' ? "" : " and p.id_unit='{$id_unit_user}'";
            $result = array();
            $query = "
            select pp.*,p.nilai_normal,p.flag_parent_group,p.nama_pengujian,p.kode_pengujian,s.nama_sample,peg.nama_pegawai nama_validator
            from pasien_pemeriksaan pp
            join pengujian p on pp.id_pengujian=p.id_pengujian
            left join registrasi_pasien_sample rps on rps.id_registrasi_pasien_sample=pp.id_registrasi_pasien_sample
            left join pegawai peg on peg.id_pegawai = pp.id_petugas_validasi
            left join sample s on s.id_sample = rps.id_sample
            where pp.id_registrasi_pemeriksaan='{$id_registrasi}' $q_unit_user
            order by pp.id_pasien_pemeriksaan
            ";
            $data_pasien_pemeriksaan = Yii::app()->db->createCommand($query)->queryAll();
            foreach ($data_pasien_pemeriksaan as $d) {
                if ($d['flag_parent_group'] == '1') {
                    $query_child = "
                selecT p.*,p.id_pengujian as id_pengujian_child,pph.*,pph.keterangan as keterangan_hasil from pengujian p
                left join pasien_pemeriksaan_hasil pph on pph.id_pengujian = p.id_pengujian and pph.id_registrasi_pemeriksaan='{$id_registrasi}'
                where p.id_pengujian_group ='{$d['id_pengujian']}'";
                    $data_pengujian_child = Yii::app()->db->createCommand($query_child)->queryAll();

                    // $data_pengujian_child = array(); perbaikan
                } else {
                    $data_pengujian_child = array();
                }
                $query_sample_pasien = "
            select rps.*,s.nama_sample,ps.id_pemeriksaan_sample
            from registrasi_pasien_sample rps
            join sample s on rps.id_sample=s.id_sample
            left join pemeriksaan_sample ps on ps.id_registrasi_pasien_sample =rps.id_registrasi_pasien_sample and ps.id_pasien_pemeriksaan='{$d['id_pasien_pemeriksaan']}'
            where rps.id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'
            order by rps.waktu_masuk desc,s.nama_sample
            ";
                $data_sample = Yii::app()->db->createCommand($query_sample_pasien)->queryAll();
                $result[] = array_merge($d, array('data_sample' => $data_sample, 'data_child' => $data_pengujian_child));
            }
            /*
              echo "<pre>";
              var_dump($result);
              echo "</pre>";
             */
            return $result;
        }

        public function actionRead()
        {
            $data = array();
            $id_user = Yii::app()->user->getId();
            $id_unit = Yii::app()->request->getParam('unit');
            $id_unit_user = !empty($id_unit) ? $id_unit : Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();

            $this->render('read', array(
                'id_unit' => $id_unit_user,
                'id_unit_user' => Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar(),
                'data_unit' => Unit::model()->findAll(),
            ));
        }

        public function actionReadDataAjax()
        {
            $id_user_login = Yii::app()->user->getId();
            $id_unit = Yii::app()->request->getParam('id_unit');
            $id_unit_user = !empty($id_unit) ? $id_unit : Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user_login}'")->queryScalar();
            $start = Yii::app()->request->getParam('start');
            $length = Yii::app()->request->getParam('length');
            $draw = Yii::app()->request->getParam('draw');
            $search_arr = Yii::app()->request->getParam('search');
            $search = $search_arr['value'];
            $query_view = "
            select 
                p.nama,
                k.nama_kota,
                ag.nama_agama,
                r.id_registrasi_pemeriksaan,
                r.no_registrasi,
                r.status_registrasi,
                r.waktu_registrasi,
                r.keluhan_diagnosa,
                r.status_pembayaran,
                i.nama_instansi,
                pemp.total_biaya,
                pemp.potongan,
                pemp.total_bayar
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            join pasien_pemeriksaan pp on pp.id_registrasi_pemeriksaan=r.id_registrasi_pemeriksaan
            join pengujian peng on peng.id_pengujian=pp.id_pengujian and peng.id_unit='{$id_unit_user}'
            left join instansi i on i.id_instansi=r.id_instansi
            LEFT JOIN (
                    SELECT
                        id_registrasi_pemeriksaan,
                        COALESCE ( sum( total_biaya ), 0 ) total_biaya,
                        COALESCE ( sum( potongan ), 0 ) potongan,
                        COALESCE ( sum( total_dibayar ), 0 ) total_bayar 
                    FROM
                        pembayaran_pemeriksaan 
                    WHERE
                        status_pembayaran = '1' 
                    GROUP BY
                        id_registrasi_pemeriksaan 
                    ORDER BY
                        id_registrasi_pemeriksaan DESC 
                        LIMIT {$start},
                        {$length} 
                        ) 
                AS pemp ON pemp.id_registrasi_pemeriksaan = r.id_registrasi_pemeriksaan
            where lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%') 
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
            order by r.waktu_registrasi desc
            limit {$start},{$length}
            ";

            $query_view_search = "
            select count(*)
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            join pasien_pemeriksaan pp on pp.id_registrasi_pemeriksaan=r.id_registrasi_pemeriksaan
            join pengujian peng on peng.id_pengujian=pp.id_pengujian and peng.id_unit='{$id_unit_user}'
            left join instansi i on i.id_instansi=r.id_instansi
            where lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
            order by r.waktu_registrasi desc
            limit {$start},{$length}
            ";
            $data = Yii::app()->db->createCommand($query_view)->queryAll();

            $jumlah_filtered = Yii::app()->db->createCommand($query_view_search)->queryScalar();
            $jumlah_all = count($data);
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
                $status_registrasi = '';
                $status_pembayaran = '';
                if ($d['status_registrasi'] == 0) {
                    $status_registrasi = '<span class="btn btn-info">Baru</span>';
                } else if ($d['status_registrasi'] == 1) {
                    $status_registrasi = '<span class="btn btn-warning">Proses Pengujian</span>';
                } else if ($d['status_registrasi'] == 2) {
                    $status_registrasi = '<span class="btn btn-success">Sudah Selesai</span>';
                }
                if ($d['status_pembayaran'] == 0) {
                    $status_pembayaran = '<span class="btn btn-danger">Belum Ada Pembayaran</span>';
                } else if ($d['status_pembayaran'] == 1) {
                    $status_pembayaran = '<span class="btn btn-success">Lunas</span>';
                }
                $action = '<a class="btn" title="Lihat Sample" href="' . Yii::app()->createUrl('pemeriksaan/input_hasil/input?reg=' . $d['id_registrasi_pemeriksaan']) . '" ><i class=" icon-list-alt"></i></a>';

                $result[] = [
                    $d['no_registrasi'],
                    $d['waktu_registrasi'],
                    $d['nama'] . '<br/><b>Instansi: </b>' . $d['nama_instansi'],
                    $d['keluhan_diagnosa'],
                    $status_registrasi,
                    $status_pembayaran,
                    $action
                ];
            }
            echo json_encode(array('draw' => $draw, 'recordsTotal' => $jumlah_all, 'recordsFiltered' => $jumlah_filtered, 'data' => $result));
        }


        public function actionInput()
        {
            $id_registrasi = Yii::app()->request->getParam('reg');
            $id_user_login = Yii::app()->user->getId();
            if (!empty($_POST)) {
                $jumlah_data = Yii::app()->request->getPost('jumlah_data');
                $jumlah_isi = 0;
                $sukses_input = 0;
                for ($i = 1; $i <= $jumlah_data; $i++) {
                    $hasil_pengujian = nl2br(Yii::app()->request->getPost('hasil_pemeriksaan' . $i));
                    $pengujian_txt = Yii::app()->request->getPost('pengujian_txt' . $i);
                    $id_pasien_pemeriksaan = Yii::app()->request->getPost('pasien_pemeriksaan_' . $i);
                    $id_pemeriksaan_group = Yii::app()->request->getPost('id_pemeriksaan_parent_' . $i);
                    $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                    $pasien_pemeriksaan->id_petugas_pemeriksa = $id_user_login;
                    $pasien_pemeriksaan->hasil_pengujian = $hasil_pengujian;
                    $pasien_pemeriksaan->tgl_pengujian = Yii::app()->request->getPost('tgl_pengujian' . $i);
                    $pasien_pemeriksaan->tgl_selesai = Yii::app()->request->getPost('tgl_selesai' . $i);
                    $pasien_pemeriksaan->keterangan_pemeriksaan = Yii::app()->request->getPost('keterangan_' . $i);
                    $pasien_pemeriksaan->no_sertifikat_pengujian = Yii::app()->request->getPost('no_sertifikat_' . $i);
                    $pasien_pemeriksaan->no_order_lab = Yii::app()->request->getPost('no_order_' . $i);
                    //file upload
                    $filename = CUploadedFile::getInstanceByName('lampiran_' . $i);
                    if ($filename != '') {
                        $filename = CUploadedFile::getInstanceByName('lampiran_' . $i);
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        $renameFile = 'hasil_pemeriksaan_' . $id_pasien_pemeriksaan . '-' . $id_pemeriksaan_group . '-' . date('Y-m-d-H-i-s') . '.' . $ext;
                        if ($pasien_pemeriksaan->file_lampiran != '') {
                            unlink('files/hasil_pemeriksaan/' . $pasien_pemeriksaan->file_lampiran);
                        }
                        $pasien_pemeriksaan->file_lampiran = CUploadedFile::getInstanceByName('lampiran_' . $i);
                        $pasien_pemeriksaan->file_lampiran->saveAs('files/hasil_pemeriksaan/' . $renameFile);
                        $pasien_pemeriksaan->file_lampiran = $renameFile;
                    }
                    if ($pasien_pemeriksaan->jumlah_save == 0) {
                        // INSERT NOTIFIKASI
                        $data_pasien = Yii::app()->db->createCommand("select r.no_registrasi,p.nama from registrasi_pemeriksaan r join pasien p on p.id_pasien=r.id_pasien where r.id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                        $notifikasi_model = new Notifikasi;
                        $notifikasi_model->judul_notifikasi = "Hasil Pengujian";
                        $notifikasi_model->isi_notifikasi = 'Hasil pengujian ' . $pengujian_txt . ' untuk no.reg : ' . $data_pasien['no_registrasi'] . ', nama : ' . $data_pasien['nama'] . ' telah dimasukkan';
                        $notifikasi_model->link_notifikasi = Yii::app()->createUrl('pemeriksaan/validasi_hasil/input?reg=' . $id_registrasi);
                        $notifikasi_model->batas_tampil = 3; // 3 hari
                        $notifikasi_model->tampil = 1;
                        $notifikasi_model->waktu_notifikasi = date('Y-m-d H:i:s');
                        $notifikasi_model->save();
                    } else {
                        // INSERT NOTIFIKASI
                        $data_pasien = Yii::app()->db->createCommand("select r.no_registrasi,p.nama from registrasi_pemeriksaan r join pasien p on p.id_pasien=r.id_pasien where r.id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                        $notifikasi_model = new Notifikasi;
                        $notifikasi_model->judul_notifikasi = "Hasil Pengujian";
                        $notifikasi_model->isi_notifikasi = 'Hasil pengujian ' . $pengujian_txt . ' untuk no.reg : ' . $data_pasien['no_registrasi'] . ', nama : ' . $data_pasien['nama'] . ' telah diupdate';
                        $notifikasi_model->link_notifikasi = Yii::app()->createUrl('pemeriksaan/validasi_hasil/input?reg=' . $id_registrasi);
                        $notifikasi_model->batas_tampil = 3; // 3 hari
                        $notifikasi_model->tampil = 1;
                        $notifikasi_model->waktu_notifikasi = date('Y-m-d H:i:s');
                        $notifikasi_model->save();
                    }
                    $pasien_pemeriksaan->jumlah_save = $pasien_pemeriksaan->jumlah_save + 1;
                    $pasien_pemeriksaan->save();

                    //PERBAIKAN
                    if (!empty($id_pemeriksaan_group)) {
                        $jumlah_child = Yii::app()->request->getPost('jumlah_child_' . $i);
                        for ($j = 1; $j < $jumlah_child; $j++) {
                            $id_pengujian_child = Yii::app()->request->getPost('id_pengujian_child_' . $i . '_' . $j);
                            $hasil_pengujian_child = nl2br(Yii::app()->request->getPost('hasil_pemeriksaan_child_' . $i . '_' . $j));
                            $keterangan_child = nl2br(Yii::app()->request->getPost('keterangan_child_' . $i . '_' . $j));
                            $pasien_pemeriksaan_hasil = PasienPemeriksaanHasil::model()->findByAttributes(array('id_pasien_pemeriksaan' => $id_pemeriksaan_group, 'id_pengujian' => $id_pengujian_child));
                            if (empty($pasien_pemeriksaan_hasil)) {
                                $pasien_pemeriksaan_hasil = new PasienPemeriksaanHasil;
                            }
                            $pasien_pemeriksaan_hasil->id_registrasi_pemeriksaan = $id_registrasi;
                            $pasien_pemeriksaan_hasil->id_pengujian = $id_pengujian_child;
                            $pasien_pemeriksaan_hasil->id_pasien_pemeriksaan = $id_pemeriksaan_group;
                            $pasien_pemeriksaan_hasil->hasil_pengujian = $hasil_pengujian_child;
                            $pasien_pemeriksaan_hasil->keterangan = $keterangan_child;
                            $pasien_pemeriksaan_hasil->save();
                        }
                    }

                    if (!empty($hasil_pengujian)) {
                        $jumlah_isi++;
                    }
                    $sukses_input++;
                }
                if (($jumlah_data) == $sukses_input) {
                    Yii::app()->user->setFlash('success', 'Data Pasien Pemeriksaan berhasil diupdate');
                }
                if ($jumlah_isi > 0 && $jumlah_isi <= $sukses_input) {
                    $registrasi_update_team = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                    $registrasi_update_team->status_registrasi = 1;
                    $registrasi_update_team->save();
                } else if ($jumlah_isi == 0 && $jumlah_isi < $sukses_input) {
                    $registrasi_update_team = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                    $registrasi_update_team->status_registrasi = 0;
                    $registrasi_update_team->save();
                }
            }

            $data_pasien_tipe = PasienTipe::model()->findAll();
            $data_dokter = Dokter::model()->findAll();
            $data_instansi = Instansi::model()->findAll();
            $data_pasien = Yii::app()->db->createCommand("select pasien.*,kota.nama_kota from pasien left join kota on pasien.id_kota_lahir=kota.id_kota where id_pasien in (select id_pasien from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}')")->queryRow();
            $data_registrasi = Yii::app()->db->createCommand("select * from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();

            $query_sample_pasien = "
            select rps.*,s.nama_sample
            from registrasi_pasien_sample rps
            join sample s on s.id_sample =rps.id_sample
            where rps.id_registrasi_pemeriksaan='{$id_registrasi}'";
            $data_sample_pasien = Yii::app()->db->createCommand($query_sample_pasien)->queryAll();
            $data_pasien_pemeriksaan = $this->getPasienPemeriksan($id_registrasi);
            $this->render('input', array(
                'id_registrasi' => $id_registrasi,
                'umur_pasien' => $this->getAgePatient($data_pasien['tgl_lahir']),
                'data_pasien_tipe' => $data_pasien_tipe,
                'data_dokter' => $data_dokter,
                'data_instansi' => $data_instansi,
                'data_pasien' => $data_pasien,
                'data_registrasi' => $data_registrasi,
                'data_sample_pasien' => $data_sample_pasien,
                'data_pasien_pemeriksaan' => $data_pasien_pemeriksaan
            ));
        }

        public function actionTemplate_excel()
        {
            Yii::import('ext.phpexcel.JPhpExcel');
            $id_user_login = Yii::app()->user->getId();
            $id_unit = Yii::app()->request->getParam('id_unit');
            $id_unit_user = !empty($id_unit) ? $id_unit : Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user_login}'")->queryScalar();

            $excel_data = [
                1 => ['KODE PEMERIKSAAN', 'NO REGISTRASI', 'NAMA', 'ASAL', 'PENGUJIAN', 'HASIL', 'KETERANGAN']
            ];
            $query = "
                SELECT pp.id_pasien_pemeriksaan,rp.no_registrasi,pas.nama,i.nama_instansi,p.nama_pengujian 
                FROM pasien_pemeriksaan pp 
                JOIN pengujian p on p.id_pengujian=pp.id_pengujian
                JOIN registrasi_pemeriksaan rp on rp.id_registrasi_pemeriksaan=pp.id_registrasi_pemeriksaan
                JOIN pasien pas on pas.id_pasien=rp.id_pasien
                LEFT JOIN instansi i on i.id_instansi=rp.id_instansi
                WHERE p.id_unit='{$id_unit}' AND pp.hasil_pengujian is null
                order by rp.waktu_registrasi desc
            ";
            $data_pemeriksaan = Yii::app()->db->createCommand($query)->queryAll();
            foreach ($data_pemeriksaan as $d) {
                array_push($excel_data, [
                    $d['id_pasien_pemeriksaan'],
                    $d['no_registrasi'],
                    $d['nama'],
                    $d['nama_instansi'],
                    $d['nama_pengujian']
                ]);
            }
            $xls = new JPhpExcel('UTF-8', false, 'input-hasil');
            $xls->addArray($excel_data);
            ob_end_clean();
            $xls->generateXML('template-input-hasil-' . $id_user_login . '-' . date('YmdHis'));
        }

        public function actionExcel()
        {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            Yii::import('ext.phpexcelreader.JPhpExcelReader');
            $id_user_login = Yii::app()->user->getId();
            $id_unit = Yii::app()->request->getParam('id_unit');
            $id_unit_user = !empty($id_unit) ? $id_unit : Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user_login}'")->queryScalar();
            if (!empty($_POST)) {
                try {
                    $updated_data=0;
                    $path = 'files/excel/input_hasil/upload/';
                    $file = CUploadedFile::getInstanceByName('exel_input');
                    $file_path = $path . $file;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    $file->saveAs($file_path);
                    chmod($file_path, 0777);
                    $data = new JPhpExcelReader($file_path);
                    for ($i = 2; $i <= $data->rowcount(); $i++) {
                        $id_pasien_pemeriksaan = $data->value($i, 1);
                        $pengujian = $data->value($i, 5);
                        $hasil = $data->value($i, 6);
                        $keterangan = $data->value($i, 7);
                        if (!empty($hasil)) {
                            $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                            if(!empty($pasien_pemeriksaan)&&empty($pasien_pemeriksaan->hasil_pengujian)){
                                $id_registrasi=$pasien_pemeriksaan->id_registrasi_pemeriksaan;
                                $pasien_pemeriksaan->id_petugas_pemeriksa = $id_user_login;
                                $pasien_pemeriksaan->hasil_pengujian = $hasil;
                                $pasien_pemeriksaan->tgl_pengujian = date('Y-m-d');
                                $pasien_pemeriksaan->keterangan_pemeriksaan = $keterangan;
                                //file upload
                                if ($pasien_pemeriksaan->jumlah_save == 0) {
                                    // INSERT NOTIFIKASI
                                    $data_pasien = Yii::app()->db->createCommand("select r.no_registrasi,p.nama from registrasi_pemeriksaan r join pasien p on p.id_pasien=r.id_pasien where r.id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                                    $notifikasi_model = new Notifikasi;
                                    $notifikasi_model->judul_notifikasi = "Hasil Pengujian";
                                    $notifikasi_model->isi_notifikasi = 'Hasil pengujian ' . $pengujian . ' untuk no.reg : ' . $data_pasien['no_registrasi'] . ', nama : ' . $data_pasien['nama'] . ' telah dimasukkan';
                                    $notifikasi_model->link_notifikasi = Yii::app()->createUrl('pemeriksaan/validasi_hasil/input?reg=' . $id_registrasi);
                                    $notifikasi_model->batas_tampil = 3; // 3 hari
                                    $notifikasi_model->tampil = 1;
                                    $notifikasi_model->waktu_notifikasi = date('Y-m-d H:i:s');
                                    $notifikasi_model->save();
                                } else {
                                    // INSERT NOTIFIKASI
                                    $data_pasien = Yii::app()->db->createCommand("select r.no_registrasi,p.nama from registrasi_pemeriksaan r join pasien p on p.id_pasien=r.id_pasien where r.id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                                    $notifikasi_model = new Notifikasi;
                                    $notifikasi_model->judul_notifikasi = "Hasil Pengujian";
                                    $notifikasi_model->isi_notifikasi = 'Hasil pengujian ' . $pengujian . ' untuk no.reg : ' . $data_pasien['no_registrasi'] . ', nama : ' . $data_pasien['nama'] . ' telah diupdate';
                                    $notifikasi_model->link_notifikasi = Yii::app()->createUrl('pemeriksaan/validasi_hasil/input?reg=' . $id_registrasi);
                                    $notifikasi_model->batas_tampil = 3; // 3 hari
                                    $notifikasi_model->tampil = 1;
                                    $notifikasi_model->waktu_notifikasi = date('Y-m-d H:i:s');
                                    $notifikasi_model->save();
                                }
                                $pasien_pemeriksaan->jumlah_save = $pasien_pemeriksaan->jumlah_save + 1;
                                $pasien_pemeriksaan->save();
                                $registrasi=RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                                $registrasi->status_registrasi=1;
                                $registrasi->save();
                                $updated_data++;
                            }

                        }
                    }
                    Yii::app()->user->setFlash('success', 'Data berhasil simpan. Jumlah data yang di update '.$updated_data.' pasien');
                } catch (Exception $e) {
                    Yii::app()->user->setFlash('error', 'Terjadi kesalahan file tidak dapat terbaca/upload gagal');
                }


            }
            $this->render('excel', array(
                'id_unit' => $id_unit,
                'id_unit_user' => $id_unit_user,
                'unit' => Unit::model()->findByPk($id_unit)
            ));
        }
    }
