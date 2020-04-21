<?php 

class Pemeriksaan_validasiController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array('accessControl', // perform access control for CRUD operations
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
        'actions' => array('read', 'readDataAjax'), 'users' => array('@'), ),
        array('deny', // deny all users
        'users' => array('*'), ), );
    }

    private function getPasienPemeriksan($id_registrasi) {
        $result = array();
        $data_pasien_pemeriksaan = Yii::app()->db->createCommand("
                    select pp.*,p.nama_pengujian,p.nilai_normal,p.kode_pengujian ,(
                        case when pp.tgl_selesai>now()
                        then DATEDIFF(pp.tgl_selesai,now())
                        else '-'
                        end
                    ) rentang_waktu
                    from pasien_pemeriksaan pp
                    join pengujian p on pp.id_pengujian=p.id_pengujian
                    where pp.id_registrasi_pemeriksaan='{$id_registrasi}'
                    ")->queryAll();
        foreach($data_pasien_pemeriksaan as $d) {
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

            array_push($result, array_merge($d, array('data_sample' => $data_sample, 'data_bahan' => $data_bahan_pasien)));
        }
        return $result;
    }

    private function getDataPengujian() {
        $arr_result = array();
        $data_kelompok = Yii::app()->db->createCommand("select * from pengujian_kelompok order by id_pengujian_kelompok")->queryAll();
        foreach($data_kelompok as $dk) {
            $arr_data_pengujian = array();
            $data_pengujian = Yii::app()->db->createCommand("select * from pengujian where id_pengujian_kelompok='{$dk['id_pengujian_kelompok']}'")->queryAll();
            foreach($data_pengujian as $dp) {
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

    private function getJumlahPasienPemeriksaan($id_registrasi) {
        return Yii::app()->db->createCommand("select count(*) from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryScalar();
    }

    private function getPembayaranPemeriksaan($id_registrasi) {
        return Yii::app()->db->createCommand("select * from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryAll();
    }

    private function getJumlahPembayaranPemeriksaan($id_registrasi) {
        return Yii::app()->db->createCommand("select sum(total_biaya) total_biaya,sum(potongan) potongan,sum(total_dibayar) total_bayar from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryRow();
    }

    public function actionRead() {
        $id_user_login = Yii::app()->user->getId();
        $id_template_user = Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user_login}' and status_aktif='1'")->queryScalar();
        $status = Yii::app()->request->getParam('status');
        //$data_pasien = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
        //'data_pasien' => $data_pasien,
        'status' => $status, 'id_template_user' => $id_template_user));
    }

    public function actionReadDataAjax() {
        $id_user_login = Yii::app()->user->getId();
        $id_template_user = Yii::app()->db->createCommand("select id_template from template_user where id_user='{$id_user_login}' and status_aktif='1'")->queryScalar();
        $start = Yii::app()->request->getParam('start');
        $length = Yii::app()->request->getParam('length');
        $draw = Yii::app()->request->getParam('draw');
        $search_arr = Yii::app()->request->getParam('search');
        $search = $search_arr['value'];
        $status_reg = Yii::app()->request->getParam('status');
        $q_status_reg = $status_reg != '' ? "and r.status_registrasi='{$status_reg}'" : "";
        $query_view = "
            select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join instansi i on i.id_instansi=r.id_instansi
            where (lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%'))
            {$q_status_reg}
            order by r.waktu_registrasi desc
            limit {$start},{$length}
            ";

        $query_view_search = "
            select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join instansi i on i.id_instansi=r.id_instansi
             where (lower(r.no_registrasi) like lower('%{$search}%') 
            or lower(r.waktu_registrasi) like lower('%{$search}%')
            or lower(p.nama)  like lower('%{$search}%')
            or lower(i.nama_instansi)  like lower('%{$search}%')
            or lower(r.keluhan_diagnosa)  like lower('%{$search}%'))
            {$q_status_reg}
            order by r.waktu_registrasi desc
            ";
        $data = Yii::app()->db->createCommand($query_view)->queryAll();

        $data_search = Yii::app()->db->createCommand($query_view_search)->queryAll();
        if ($status_reg != '') {
            $jumlah_all = RegistrasiPemeriksaan::model()->countByAttributes(array('status_registrasi'=> $status_reg));

        } else {
            $jumlah_all = RegistrasiPemeriksaan::model()->count();
        }
        $jumlah_filtered = count($data_search);
        $no = 1;
        $result = array();
        foreach($data as $d) {
            // AUTO UPDATE PEMBAYARAN
            $biaya_pembayaran = $this->getJumlahPembayaranPemeriksaan($d['id_registrasi_pemeriksaan']);
            $data_pembayaran = $this->getPembayaranPemeriksaan($d['id_registrasi_pemeriksaan']);
            // AUTO UPDATE DATA STATUS PEMBAYARAN
            if (count($data_pembayaran) > 0 && $biaya_pembayaran['total_biaya'] == ($biaya_pembayaran['total_bayar'] + $biaya_pembayaran['potongan'])) {
                Yii::app()->db->createCommand("update registrasi_pemeriksaan set status_pembayaran=1 where id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'")->query();
            } else {
                Yii::app()->db->createCommand("update registrasi_pemeriksaan set status_pembayaran=0 where id_registrasi_pemeriksaan='{$d['id_registrasi_pemeriksaan']}'")->query();
            }

            // PASIEN PEMERIKSAAN
            $pp = $this->getPasienPemeriksan($d['id_registrasi_pemeriksaan']);
            $str_pp = '';
            foreach($pp as $p) {
                if ($p['rentang_waktu'] < 10 && $p['rentang_waktu'] != '-') {
                    $cls_rentang = 'red';
                } else if ($p['rentang_waktu'] < 30 && $p['rentang_waktu'] != '-') {
                    $cls_rentang = 'orange';
                } else {
                    $cls_rentang = 'green';
                }
                $str_pp .= '<b>Pengujian :</b> '.$p['nama_pengujian'].'<br/><b>Tgl.Selesai :</b> '.$p['tgl_selesai'].'<br/> <i style="color:'.$cls_rentang.'"><u>'.$p['rentang_waktu'].' Hari lagi</u></i><br/><br/> ';
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
            $action = '<a class="btn" title="Registrasi" href="'.Yii::app()->createUrl('registrasi/pemeriksaan_edit/update?reg='.$d['id_registrasi_pemeriksaan']).'" ><i class=" icon-list-alt"></i></a>';
            if (in_array($id_template_user, array(1))) {
                $action .= '<a class="btn registrasi-pemeriksaan-delete-button" title="Delete" id="'.$d['id_registrasi_pemeriksaan'].'" ><i class="icon-remove"></i></a>';
            }

            array_push($result, array(
            $d['no_registrasi'],
            $d['waktu_registrasi'],
            $d['nama'].'<br/>'.$d['nama_instansi'],
            $str_pp,
            $status_registrasi,
            $status_pembayaran,
            $action));

        }
        echo json_encode(array('draw' => $draw, 'recordsTotal' => $jumlah_all, 'recordsFiltered' => $jumlah_filtered, 'data' => $result));
    }





}