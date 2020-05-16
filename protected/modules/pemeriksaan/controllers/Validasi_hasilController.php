<?php

class Validasi_hasilController extends Controller
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
                'actions' => array('read', 'readNew', 'read_all', 'readDataAjax', 'readAllDataAjax', 'input', 'input_all'),
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
                /* DITUTUP TABEL HILANG
                $query_child = "
                selecT p.*,p.id_pengujian as id_pengujian_child,pph.*,pph.keterangan as keterangan_hasil from pengujian p
                left join pasien_pemeriksaan_hasil pph on pph.id_pengujian = p.id_pengujian and pph.id_registrasi_pemeriksaan='{$id_registrasi}'
                where p.id_pengujian_group ='{$d['id_pengujian']}'";
                $data_pengujian_child = Yii::app()->db->createCommand($query_child)->queryAll();
                */
                $data_pengujian_child = array();
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
            array_push($result, array_merge($d, array('data_sample' => $data_sample, 'data_child' => $data_pengujian_child)));
        }
        return $result;
    }

    private function getPasienPemeriksanAll($id_registrasi)
    {
        $id_user = Yii::app()->user->getId();
        $result = array();
        $query = "
            select pp.*,p.nilai_normal,p.flag_parent_group,p.nama_pengujian,p.kode_pengujian,s.nama_sample,peg.nama_pegawai nama_validator
            from pasien_pemeriksaan pp
            join pengujian p on pp.id_pengujian=p.id_pengujian
            left join registrasi_pasien_sample rps on rps.id_registrasi_pasien_sample=pp.id_registrasi_pasien_sample
            left join pegawai peg on peg.id_pegawai = pp.id_petugas_validasi
            left join sample s on s.id_sample = rps.id_sample
            where pp.id_registrasi_pemeriksaan='{$id_registrasi}'
            order by pp.id_pasien_pemeriksaan
            ";
        $data_pasien_pemeriksaan = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($data_pasien_pemeriksaan as $d) {
            if ($d['flag_parent_group'] == '1') {
                /* DITUTUP TABEL HILANG
                $query_child = "
                selecT p.*,p.id_pengujian as id_pengujian_child,pph.*,pph.keterangan as keterangan_hasil from pengujian p
                left join pasien_pemeriksaan_hasil pph on pph.id_pengujian = p.id_pengujian and pph.id_registrasi_pemeriksaan='{$id_registrasi}'
                where p.id_pengujian_group ='{$d['id_pengujian']}'";
                $data_pengujian_child = Yii::app()->db->createCommand($query_child)->queryAll();
                */
                $data_pengujian_child = array();
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
            array_push($result, array_merge($d, array('data_sample' => $data_sample, 'data_child' => $data_pengujian_child)));
        }
        return $result;
    }

    public function actionReadAllDataAjax()
    {
        $id_user_login = Yii::app()->user->getId();
        $start = Yii::app()->request->getParam('start');
        $length = Yii::app()->request->getParam('length');
        $draw = Yii::app()->request->getParam('draw');
        $search_arr = Yii::app()->request->getParam('search');
        $search = $search_arr['value'];
        $query_view = "
        select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi, pxp.status_validasi
        from pasien p
        left join kota k on k.id_kota=p.id_kota_lahir
        left join agama ag on ag.id_agama=p.id_agama
        join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
        left join pasien_pemeriksaan pxp on pxp.id_registrasi_pemeriksaan = r.id_registrasi_pemeriksaan
        left join instansi i on i.id_instansi=r.id_instansi
        where
        (
        lower(r.no_registrasi) like lower('%{$search}%') 
        or lower(r.waktu_registrasi) like lower('%{$search}%')
        or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
        or lower(p.nama)  like lower('%{$search}%')
        or lower(i.nama_instansi)  like lower('%{$search}%')
        or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
        )
        group by no_registrasi,waktu_registrasi,nama,nama_instansi,keluhan_diagnosa,status_registrasi,status_pembayaran,r.id_registrasi_pemeriksaan
        order by r.waktu_registrasi desc
        limit {$start},{$length}
            ";
        //var_dump($query_view);        die();
        $query_view_search = "
            select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi,pxp.status_validasi 
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join pasien_pemeriksaan pxp on pxp.id_registrasi_pemeriksaan = r.id_registrasi_pemeriksaan
            left join instansi i on i.id_instansi=r.id_instansi
            where
            (
            lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
            )
            group by no_registrasi,waktu_registrasi,nama,nama_instansi,keluhan_diagnosa,status_registrasi,status_pembayaran,id_registrasi_pemeriksaan
            order by r.waktu_registrasi desc
            ";

        $data = Yii::app()->db->createCommand($query_view)->queryAll();

        $data_search = Yii::app()->db->createCommand($query_view_search)->queryAll();
        $jumlah_all = count($data);
        $jumlah_filtered = count($data_search);
        $no = 1;
        $result = array();
        foreach ($data as $d) {
            $status_registrasi = '';
            $status_pembayaran = '';
            if ($d['status_registrasi'] == 0) {
                $status_registrasi = '<span class="btn btn-info">Baru</span>';
            } else if ($d['status_registrasi'] == 1) {
                $status_registrasi = '<span class="btn btn-warning">Proses Pengujian</span>';
            } else if ($d['status_registrasi'] == 2) {
                $status_registrasi = '<span class="btn btn-success">Sudah Selesai</span>';
            }
            if ($d['status_validasi'] == 0) {
                $status_pembayaran = '<span class="btn btn-danger">Belum</span>';
            } else if ($d['status_validasi'] == 1) {
                $status_pembayaran = '<span class="btn btn-success">Valid</span>';
            }
            $action = '<a class="btn" title="Lihat Sample" href="' . Yii::app()->createUrl('pemeriksaan/validasi_hasil/input_all?reg=' . $d['id_registrasi_pemeriksaan']) . '" ><i class=" icon-list-alt"></i></a>';

            array_push($result, array(
                $d['no_registrasi'],
                $d['waktu_registrasi'],
                $d['nama'] . '<br/><b>Instansi: </b>' . $d['nama_instansi'],
                $d['keluhan_diagnosa'],
                $status_registrasi,
                $status_pembayaran,
                $action
            ));
        }
        echo json_encode(array('draw' => $draw, 'recordsTotal' => $jumlah_all, 'recordsFiltered' => $jumlah_filtered, 'data' => $result));
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
        select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi, pxp.status_validasi
        from pasien p
        left join kota k on k.id_kota=p.id_kota_lahir
        left join agama ag on ag.id_agama=p.id_agama
        join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
        left join pasien_pemeriksaan pxp on pxp.id_registrasi_pemeriksaan = r.id_registrasi_pemeriksaan
        left join instansi i on i.id_instansi=r.id_instansi
        where r.id_registrasi_pemeriksaan in (
            select pp.id_registrasi_pemeriksaan
            from pasien_pemeriksaan pp
            join pengujian peng on peng.id_pengujian=pp.id_pengujian
            where peng.id_unit='{$id_unit_user}'
        ) 
        and 
        (
        lower(r.no_registrasi) like lower('%{$search}%') 
        or lower(r.waktu_registrasi) like lower('%{$search}%')
        or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
        or lower(p.nama)  like lower('%{$search}%')
        or lower(i.nama_instansi)  like lower('%{$search}%')
        or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
        )
        group by no_registrasi,waktu_registrasi,nama,nama_instansi,keluhan_diagnosa,status_registrasi,status_pembayaran,r.id_registrasi_pemeriksaan
        order by r.waktu_registrasi desc
        limit {$start},{$length}
            ";
        //var_dump($query_view);        die();
        $query_view_search = "
            select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi,pxp.status_validasi 
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join pasien_pemeriksaan pxp on pxp.id_registrasi_pemeriksaan = r.id_registrasi_pemeriksaan
            left join instansi i on i.id_instansi=r.id_instansi
            where r.id_registrasi_pemeriksaan in (
                select pp.id_registrasi_pemeriksaan
                from pasien_pemeriksaan pp
                join pengujian peng on peng.id_pengujian=pp.id_pengujian
                where peng.id_unit='{$id_unit_user}'
            ) 
            and 
            (
            lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(r.id_registrasi_pemeriksaan) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%')
            )
            group by no_registrasi,waktu_registrasi,nama,nama_instansi,keluhan_diagnosa,status_registrasi,status_pembayaran,id_registrasi_pemeriksaan
            order by r.waktu_registrasi desc
            ";

        $data = Yii::app()->db->createCommand($query_view)->queryAll();

        $data_search = Yii::app()->db->createCommand($query_view_search)->queryAll();
        $jumlah_all = count($data);
        $jumlah_filtered = count($data_search);
        $no = 1;
        $result = array();
        foreach ($data as $d) {
            $status_registrasi = '';
            $status_pembayaran = '';
            if ($d['status_registrasi'] == 0) {
                $status_registrasi = '<span class="btn btn-info">Baru</span>';
            } else if ($d['status_registrasi'] == 1) {
                $status_registrasi = '<span class="btn btn-warning">Proses Pengujian</span>';
            } else if ($d['status_registrasi'] == 2) {
                $status_registrasi = '<span class="btn btn-success">Sudah Selesai</span>';
            }
            if ($d['status_validasi'] == 0) {
                $status_pembayaran = '<span class="btn btn-danger">Belum</span>';
            } else if ($d['status_validasi'] == 1) {
                $status_pembayaran = '<span class="btn btn-success">Valid</span>';
            }
            $action = '<a class="btn" title="Lihat Sample" href="' . Yii::app()->createUrl('pemeriksaan/validasi_hasil/input?reg=' . $d['id_registrasi_pemeriksaan']) . '" ><i class=" icon-list-alt"></i></a>';

            array_push($result, array(
                $d['no_registrasi'],
                $d['waktu_registrasi'],
                $d['nama'] . '<br/><b>Instansi: </b>' . $d['nama_instansi'],
                $d['keluhan_diagnosa'],
                $status_registrasi,
                $status_pembayaran,
                $action
            ));
        }
        echo json_encode(array('draw' => $draw, 'recordsTotal' => $jumlah_all, 'recordsFiltered' => $jumlah_filtered, 'data' => $result));
    }


    public function actionRead_all()
    {
        $id_user  = Yii::app()->user->getId();
        $this->render(
            'read_all',
            [
                'id_user' => $id_user
            ]
        );
    }

    public function actionReadNew()
    {
        $id_user  = Yii::app()->user->getId();
        $id_unit = Yii::app()->request->getParam('unit');
        $role_user =  Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user}' and status_aktif='1'")->queryScalar();
        $id_unit_user = !empty($id_unit) ? $id_unit : Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
        // SUPER ADMIN DAN PIMPINAN TERBUKA SEMUA
        if (in_array($role_user, [1, 3])) {
            $id_unit_user = '';
        } else {
            $id_unit_user = Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
        }

        $this->render('read_new', array(
            'id_unit' => $id_unit_user,
            'id_unit_user' => $id_unit_user,
            'data_unit' => Unit::model()->findAll()
        ));
    }

    public function actionRead()
    {
        $data = array();
        $id_user  = Yii::app()->user->getId();

        $id_unit = Yii::app()->request->getParam('unit');
        $role_user =  Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user}' and status_aktif='1'")->queryScalar();
        $id_unit_user = !empty($id_unit) ? $id_unit : Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
        // SUPER ADMIN DAN PIMPINAN TERBUKA SEMUA
        if (in_array($role_user, [1, 3])) {
            $id_unit_user = '';
        } else {
            $id_unit_user = Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
        }

        $this->render('read_new', array(
            'id_unit' => $id_unit,
            'id_unit_user' => $id_unit_user,
            'data_unit' => Unit::model()->findAll(),
        ));
    }

    public function actionInput()
    {
        $id_registrasi = Yii::app()->request->getParam('reg');

        if (!empty($_POST)) {
            $jumlah_data = Yii::app()->request->getPost('jumlah_data');
            $id_registrasi = Yii::app()->request->getPost('id_registrasi');
            $id_user_login = Yii::app()->user->getId();
            $id_pegawai_login = Yii::app()->db->createCommand("select id_pegawai from pegawai where id_user='{$id_user_login}'")->queryScalar();
            $sukses_input = 0;
            $validasi_input = 0;
            for ($i = 1; $i <= $jumlah_data; $i++) {
                $validasi = Yii::app()->request->getPost('validasi_' . $i);
                $id_pasien_pemeriksaan = Yii::app()->request->getPost('pasien_pemeriksaan_' . $i);
                // INSERT NOTIFIKASI
                $data_pasien = Yii::app()->db->createCommand("select r.no_registrasi,p.nama from registrasi_pemeriksaan r join pasien p on p.id_pasien=r.id_pasien where r.id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                $notifikasi_model = new Notifikasi;
                $notifikasi_model->judul_notifikasi = "Validasi Hasil";
                $notifikasi_model->isi_notifikasi = 'Hasil pengujian untuk no.reg : ' . $data_pasien['no_registrasi'] . ', nama : ' . $data_pasien['nama'] . ' telah divalidasi';
                $notifikasi_model->link_notifikasi = Yii::app()->createUrl('registrasi/cetak/hasil_pemeriksaan?reg=' . $id_registrasi);
                $notifikasi_model->batas_tampil = 3; // 3 hari
                $notifikasi_model->tampil = 1;
                $notifikasi_model->waktu_notifikasi = date('Y-m-d H:i:s');
                $notifikasi_model->save();
                if (!empty($validasi)) {
                    $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                    $pasien_pemeriksaan->id_petugas_validasi = $id_pegawai_login;
                    $pasien_pemeriksaan->status_validasi = 1;
                    $pasien_pemeriksaan->save();
                    $sukses_input++;
                    $validasi_input++;
                } else {
                    $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                    $pasien_pemeriksaan->id_petugas_validasi = '';
                    $pasien_pemeriksaan->status_validasi = 0;
                    $pasien_pemeriksaan->save();
                    $sukses_input++;
                }
            }
            if ($sukses_input > 0) {
                Yii::app()->user->setFlash('success', 'Data Pasien Pemeriksaan berhasil divalidasi');
            }
            if ($sukses_input > 0 && ($jumlah_data - 1) == $validasi_input) {
                $registrasi_update_team = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                $registrasi_update_team->status_registrasi = 2;
                $registrasi_update_team->save();
            } else if (($jumlah_data - 1) > $validasi_input) {
                $registrasi_update_team = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                $registrasi_update_team->status_registrasi = 1;
                $registrasi_update_team->save();
            }
        }
        $data_pasien_tipe = PasienTipe::model()->findAll();
        $data_dokter = Dokter::model()->findAll();
        $data_instansi = Instansi::model()->findAll();
        $data_pasien = Yii::app()->db->createCommand("select pasien.*,kota.nama_kota from pasien left join kota on pasien.id_kota_lahir=kota.id_kota where id_pasien in (select id_pasien from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}')")->queryRow();
        $data_registrasi = Yii::app()->db->createCommand("select * from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();

        $data_pasien_pemeriksaan = $this->getPasienPemeriksan($id_registrasi);
        $this->render('input', array(
            'id_registrasi' => $id_registrasi,
            'umur_pasien' => $this->getAgePatient($data_pasien['tgl_lahir']),
            'data_pasien_tipe' => $data_pasien_tipe,
            'data_dokter' => $data_dokter,
            'data_instansi' => $data_instansi,
            'data_pasien' => $data_pasien,
            'data_registrasi' => $data_registrasi,
            'data_pasien_pemeriksaan' => $data_pasien_pemeriksaan
        ));
    }

    public function actionInput_all()
    {
        $id_registrasi = Yii::app()->request->getParam('reg');
        if (!empty($_POST)) {
            $jumlah_data = Yii::app()->request->getPost('jumlah_data');
            $id_registrasi = Yii::app()->request->getPost('id_registrasi');
            $id_user_login = Yii::app()->user->getId();
            $id_pegawai_login = Yii::app()->db->createCommand("select id_pegawai from pegawai where id_user='{$id_user_login}'")->queryScalar();
            $sukses_input = 0;
            $validasi_input = 0;
            for ($i = 1; $i <= $jumlah_data; $i++) {
                $validasi = Yii::app()->request->getPost('validasi_' . $i);
                $id_pasien_pemeriksaan = Yii::app()->request->getPost('pasien_pemeriksaan_' . $i);
                // INSERT NOTIFIKASI
                if (!empty($id_pegawai_login)) {
                    $data_pasien = Yii::app()->db->createCommand("select r.no_registrasi,p.nama from registrasi_pemeriksaan r join pasien p on p.id_pasien=r.id_pasien where r.id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
                    $data_pengujian = Yii::app()->db->createCommand("select pp.*,p.nama_pengujian from pasien_pemeriksaan pp join pengujian p on pp.id_pengujian = p.id_pengujian where pp.id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->queryRow();
                    if (!empty($validasi)) {
                        $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                        $pasien_pemeriksaan->id_petugas_validasi = $id_pegawai_login;
                        $pasien_pemeriksaan->status_validasi = 1;
                        $pasien_pemeriksaan->save();
                        // Kirim Notifikasi
                        $notifikasi_model = new Notifikasi;
                        $notifikasi_model->judul_notifikasi = "Validasi Hasil";
                        $notifikasi_model->isi_notifikasi = 'Hasil pengujian ' . $data_pengujian['nama_pengujian'] . ' untuk no.reg : ' . $data_pasien['no_registrasi'] . ', nama : ' . $data_pasien['nama'] . ' telah divalidasi';
                        $notifikasi_model->link_notifikasi = Yii::app()->createUrl('registrasi/cetak/hasil_pemeriksaan?reg=' . $id_registrasi);
                        $notifikasi_model->batas_tampil = 3; // 3 hari
                        $notifikasi_model->tampil = 1;
                        $notifikasi_model->waktu_notifikasi = date('Y-m-d h:i:s');
                        $notifikasi_model->save();
                        // Update sukses
                        $sukses_input++;
                        $validasi_input++;
                    } else {
                        $pasien_pemeriksaan = PasienPemeriksaan::model()->findByPk($id_pasien_pemeriksaan);
                        $pasien_pemeriksaan->id_petugas_validasi = '';
                        $pasien_pemeriksaan->status_validasi = 0;
                        $pasien_pemeriksaan->save();
                        $sukses_input++;
                    }
                }
            }
            if ($sukses_input > 0) {
                Yii::app()->user->setFlash('success', 'Data Pasien Pemeriksaan berhasil divalidasi');
            } else {
                Yii::app()->user->setFlash('error', 'Terjadi error ketika menyimpan data. Data pegawai tidak valid');
            }
            if ($sukses_input > 0 && ($jumlah_data - 1) == $validasi_input) {
                $registrasi_update_team = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                $registrasi_update_team->status_registrasi = 2;
                $registrasi_update_team->save();
            } else if (($jumlah_data - 1) > $validasi_input) {
                $registrasi_update_team = RegistrasiPemeriksaan::model()->findByPk($id_registrasi);
                $registrasi_update_team->status_registrasi = 1;
                $registrasi_update_team->save();
            }
        }
        $data_pasien_tipe = PasienTipe::model()->findAll();
        $data_dokter = Dokter::model()->findAll();
        $data_instansi = Instansi::model()->findAll();
        $data_pasien = Yii::app()->db->createCommand("select pasien.*,kota.nama_kota from pasien left join kota on pasien.id_kota_lahir=kota.id_kota where id_pasien in (select id_pasien from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}')")->queryRow();
        $data_registrasi = Yii::app()->db->createCommand("select * from registrasi_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();

        $data_pasien_pemeriksaan = $this->getPasienPemeriksanAll($id_registrasi);
        $this->render('input_all', array(
            'id_registrasi' => $id_registrasi,
            'umur_pasien' => $this->getAgePatient($data_pasien['tgl_lahir']),
            'data_pasien_tipe' => $data_pasien_tipe,
            'data_dokter' => $data_dokter,
            'data_instansi' => $data_instansi,
            'data_pasien' => $data_pasien,
            'data_registrasi' => $data_registrasi,
            'data_pasien_pemeriksaan' => $data_pasien_pemeriksaan
        ));
    }
}
