<?php

class AjaxDataController extends Controller
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
                'actions' => array(
                    'getKota', 'getDivisi','selectPasienAll', 'DeletePasienPemeriksan', 'DeletePembayaranPasienPemeriksaan',
                    'DeletePembayaranPasienPenyewaan', 'DeleteSamplePasienPemeriksaan', 'DeleteBahanPasien',
                    'getBarangSewaTarif', 'getBahanPengujian', 'getNoRegistrasiPemeriksaan', 'getNotification'
                ),
                'users' => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getPasienPemeriksanUnit($id_registrasi)
    {
        $id_user = $id_user_login = Yii::app()->user->getId();
        $id_unit_user = Yii::app()->db->createCommand("select id_unit from pegawai where id_user='{$id_user}'")->queryScalar();
        $result = array();
        $data_pasien_pemeriksaan = Yii::app()->db->createCommand("
            select pp.*,p.nama_pengujian,p.nilai_normal,p.kode_pengujian 
            from pasien_pemeriksaan pp
            join pengujian p on pp.id_pengujian=p.id_pengujian
            where pp.id_registrasi_pemeriksaan='{$id_registrasi}' and p.id_unit='{$id_unit_user}'
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

            array_push($result, array_merge($d, array('data_sample' => $data_sample, 'data_bahan' => $data_bahan_pasien)));
        }
        return $result;
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

            array_push($result, array_merge($d, array('data_sample' => $data_sample, 'data_bahan' => $data_bahan_pasien)));
        }
        return $result;
    }

    private function getPembayaranPemeriksaan($id_registrasi)
    {
        return Yii::app()->db->createCommand("select * from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryAll();
    }

    private function getPembayaranPenyewaan($no_registrasi)
    {
        $result = array();

        $data_pembayaran = Yii::app()->db->createCommand("select * from pembayaran_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();
        foreach ($data_pembayaran as $d) {
            array_push($result, array_merge($d, array(
                'detail' => Yii::app()->db->createCommand("select * from pembayaran_penyewaan_detail where id_pembayaran_penyewaan='{$d['id_pembayaran_penyewaan']}'")->queryAll()
            )));
        }
        return $result;
    }

    public function actionGetKota()
    {
        $this->layout = false;
        $id_propinsi = Yii::app()->request->getPost('id');
        $data = Kota::model()->findAllByAttributes(array('id_propinsi' => $id_propinsi), array('order' => 'nama_kota'));
        // TAMPIL DATA HTML
        foreach ($data as $d) {
            echo "<option value='{$d['id_kota']}'>{$d['nama_kota']}</option>";
        }
    }

    public function actionGetDivisi()
    {
        $this->layout = false;
        $id_unit = Yii::app()->request->getPost('id');
        $data = Divisi::model()->findAllByAttributes(array('id_unit' => $id_unit), array('order' => 'nama_divisi'));
        // TAMPIL DATA HTML
        foreach ($data as $d) {
            echo "<option value='{$d['id_divisi']}'>{$d['nama_divisi']}</option>";
        }
    }

    public function actionSelectPasienAll()
    {
        $this->layout = false;
        $id_pasien = Yii::app()->request->getPost('id_pasien');
        $query_view_pasien = "
            select p.*,k.nama_kota,ag.nama_agama
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            order by id_pasien desc,p.nama
            limit 0,3000
            ";
        $data_pasien_all = Yii::app()->db->createCommand($query_view_pasien)->queryAll();
        // TAMPIL DATA HTML
        echo '<select name="pasien" id="pasien" data-placeholder="Pilih Pasien..." tabindex="2">';
        foreach ($data_pasien_all as $d) {
            if ($d['id_pasien'] == $id_pasien) {
                $option = "<option selected='true' value='{$d['id_pasien']}'> Nama : {$d['nama']}";
            } else {
                $option = "<option value='{$d['id_pasien']}'> Nama : {$d['nama']}";
            }
            $option .= $d['tgl_lahir'] != '' ?  ", Tgl.Lahir : {$d['tgl_lahir']} " : "";
            $option .= $d['alamat'] != '' ? ", Alamat : {$d['alamat']} " : "";
            $option .= $d['nama_kota'] != '' ? ", Kota.Lhr : {$d['nama_kota']} " : "";
            $option .= "</option>";
            echo $option;
        }
        echo '</select>';
    }

    public function actionDeletePasienPemeriksan()
    {
        $this->layout = false;
        $id_registrasi = Yii::app()->request->getParam('id_registrasi');
        $id_pasien_pemeriksaan = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand("delete from bahan_pengujian_pasien where id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->query();
        Yii::app()->db->createCommand("delete from pemeriksaan_sample where id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->query();
        Yii::app()->db->createCommand("delete from pasien_pemeriksaan where id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->query();

        $this->render('pasien_pemeriksaan', array(
            'id_registrasi' => $id_registrasi,
            'data_pasien_pemeriksaan' => $this->getPasienPemeriksan($id_registrasi)
        ));
    }

    public function actionDeletePembayaranPasienPemeriksaan()
    {
        $this->layout = false;
        $id_registrasi = Yii::app()->request->getParam('id_registrasi');
        $id_pembayaran_pemeriksaan = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand("delete from pembayaran_pemeriksaan where id_pembayaran_pemeriksaan='{$id_pembayaran_pemeriksaan}'")->query();

        $this->render('pembayaran_pemeriksaan', array(
            'id_registrasi' => $id_registrasi,
            'data_pembayaran' => $this->getPembayaranPemeriksaan($id_registrasi)
        ));
    }

    public function actionDeletePembayaranPasienPenyewaan()
    {
        $this->layout = false;
        $id_registrasi = Yii::app()->request->getParam('id_registrasi');
        $no_registrasi = Yii::app()->request->getParam('no_registrasi');
        $id_pembayaran_penyewaan = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand("delete from pembayaran_penyewaan where id_pembayaran_penyewaan='{$id_pembayaran_penyewaan}'")->query();

        $this->render('pembayaran_penyewaan', array(
            'id_registrasi' => $id_registrasi,
            'no_registrasi' => $no_registrasi,
            'data_pembayaran' => $this->getPembayaranPenyewaan($no_registrasi)
        ));
    }

    public function actionDeleteSamplePasienPemeriksaan()
    {
        $this->layout = false;
        $id_registrasi = Yii::app()->request->getParam('id_registrasi');
        $id_registrasi_pasien_sample = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand("delete from registrasi_pasien_sample where id_registrasi_pasien_sample='{$id_registrasi_pasien_sample}'")->query();
        Yii::app()->db->createCommand("delete from pemeriksaan_sample where id_registrasi_pasien_sample='{$id_registrasi_pasien_sample}'")->query();
        $query_sample_pasien = "
            select rps.*,s.nama_sample
            from registrasi_pasien_sample rps
            join sample s on rps.id_sample=s.id_sample
            where rps.id_registrasi_pemeriksaan='{$id_registrasi}'
            order by rps.waktu_masuk desc,s.nama_sample
            ";
        $data_sample_pasien = Yii::app()->db->createCommand($query_sample_pasien)->queryAll();
        $this->render('sample_pasien', array(
            'id_registrasi' => $id_registrasi,
            'data_sample_pasien' => $data_sample_pasien
        ));
    }

    public function actionDeleteBahanPasien()
    {
        $this->layout = false;
        $id_registrasi = Yii::app()->request->getParam('id_registrasi');
        $id_bahan_pasien = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand("delete from bahan_pengujian_pasien where id_bahan_pasien='{$id_bahan_pasien}'")->query();
        Yii::app()->db->createCommand("delete from bahan_pasien where id_bahan_pasien='{$id_bahan_pasien}'")->query();
        $query_bahan_pasien = "
            select bps.*,bp.*
            from bahan_pasien bps
            join bahan_pengujian bp on bp.id_bahan_pengujian=bps.id_bahan_pengujian
            where bps.id_registrasi_pemeriksaan='{$id_registrasi}'
            order by bp.nama_bahan
            ";
        $data_bahan_pasien = Yii::app()->db->createCommand($query_bahan_pasien)->queryAll();
        $this->render('bahan_pasien', array(
            'id_registrasi' => $id_registrasi,
            'data_bahan_pasien' => $data_bahan_pasien
        ));
    }

    public function actionGetBarangSewaTarif()
    {
        $this->layout = false;
        $id_barang_sewa_tarif = Yii::app()->request->getPost('id_barang_sewa_tarif');
        $barang_tarif_sewa = Yii::app()->db->createCommand("select * from barang_sewa_tarif where id_barang_sewa_tarif='{$id_barang_sewa_tarif}'")->queryRow();
        echo json_encode($barang_tarif_sewa);
        Yii::app()->end();
    }

    public function actionGetBahanPengujian()
    {
        $this->layout = false;
        $id_bahan_pengujian = Yii::app()->request->getPost('id_bahan_pengujian');
        $bahan_pengujian = Yii::app()->db->createCommand("select * from bahan_pengujian where id_bahan_pengujian='{$id_bahan_pengujian}'")->queryRow();
        echo json_encode($bahan_pengujian);
        Yii::app()->end();
    }

    public function actionGetNoRegistrasiPemeriksaan()
    {
        $this->layout = false;
        $id_instansi = Yii::app()->request->getPost('id_instansi');
        $instansi = Yii::app()->db->createCommand("select * from instansi where id_instansi='{$id_instansi}'")->queryRow();
        $jumlah_pemeriksaan_instansi = Yii::app()->db->createCommand("select count(*) from registrasi_pemeriksaan where id_instansi='{$id_instansi}'")->queryScalar();
        $year_month = date('Ym');
        echo json_encode(
            array(
                'no_registrasi' => str_pad($instansi['kode_instansi'], 4, "0", STR_PAD_LEFT) . '-' . $year_month . '-' . str_pad($jumlah_pemeriksaan_instansi + 1, 10, "0", STR_PAD_LEFT)
            )
        );
        Yii::app()->end();
    }

    public function actionGetNotification()
    {
        $this->layout = false;
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
         
         */
        $query_notifikasi = "
            select 
            (select count(*) from notifikasi where tampil='1' and (baca='0' or baca is null)) total,
            0 baru,
            0 proses,
            0 sudah,
            (select count(*) from registrasi_penyewaan where tgl_order_warning < STR_TO_DATE('$tanggal_sekarang','%Y-%m-%d') 
                and no_registrasi_penyewaan not in (select no_registrasi_penyewaan from pembayaran_penyewaan where status_pembayaran=2)
            ) order_warning
            from dual
        ";
        $notifikasi = Yii::app()->db->createCommand($query_notifikasi)->queryRow();
        if (in_array($id_template, array(2, 3))) {
            $result = array(
                'total' => $notifikasi['total'],
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
                'total' => $notifikasi['total'],
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
        echo json_encode($result);
        Yii::app()->end();
    }
}
