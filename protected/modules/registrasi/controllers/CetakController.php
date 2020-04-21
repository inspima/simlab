<?php

class CetakController extends Controller
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
                    'nota', 'bayar_pemeriksaan', 'hasil_pemeriksaan', 'hasil_pemeriksaan_new', 'deposit', 'bayar_penyewaan', 'penyewaan_lembar_lab',
                    'penyewaan_lembar_registrasi', 'penyewaan_lembar_pemohon', 'pemakaian_fasilitas', 'sertifikat_pengujian',
                    'barcode'
                ),
                'users' => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getTerbilang($x)
    {
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12) {
            return " " . $abil[$x];
        } elseif ($x < 20) {
            return $this->getTerbilang($x - 10) . "belas";
        } elseif ($x < 100) {
            return $this->getTerbilang($x / 10) . " puluh" . $this->getTerbilang($x % 10);
        } elseif ($x < 200) {
            return " seratus" . $this->getTerbilang($x - 100);
        } elseif ($x < 1000) {
            return $this->getTerbilang($x / 100) . " ratus" . $this->getTerbilang($x % 100);
        } elseif ($x < 2000) {
            return " seribu" . $this->getTerbilang($x - 1000);
        } elseif ($x < 1000000) {
            return $this->getTerbilang($x / 1000) . " ribu" . $this->getTerbilang($x % 1000);
        } elseif ($x < 1000000000) {
            return $this->getTerbilang($x / 1000000) . " juta" . $this->getTerbilang($x % 1000000);
        }
    }

    function getDateIndo($date)
    { // fungsi atau method untuk mengubah tanggal ke format indonesia
        // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $BulanIndo = array(
            "Januari", "Februari", "Maret",
            "April", "Mei", "Juni",
            "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        );

        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
        return ($result);
    }

    function integerToRoman($integer)
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        foreach ($lookup as $roman => $value) {
            // Determine the number of matches
            $matches = intval($integer / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }

    private function getPasienPemeriksanValidasi($id_registrasi)
    {
        $result = array();
        $query = "
            select pp.*,p.nilai_normal,p.flag_parent_group,p.nama_pengujian,p.kode_pengujian,s.nama_sample,peg.nama_pegawai nama_validator,rps.keterangan_sample
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
                $query_child = "
                
				
				select p.*,p.id_pengujian as id_pengujian_child,pph.*,pph.keterangan as keterangan_hasil from pengujian p
                left join pasien_pemeriksaan_hasil pph on pph.id_pengujian = p.id_pengujian and pph.id_registrasi_pemeriksaan='{$id_registrasi}'
                where p.id_pengujian_group ='{$d['id_pengujian']}'";
                $data_pengujian_child = Yii::app()->db->createCommand($query_child)->queryAll();

                //$data_pengujian_child = array();
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

    private function getPasienPemeriksan($id_registrasi)
    {
        $result = array();
        $data_pasien_pemeriksaan = Yii::app()->db->createCommand("
                    select pp.*,p.tarif_pengujian,p.nama_pengujian,p.nilai_normal,p.kode_pengujian
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

    private function getDataRegistrasiPemeriksaan($id_registrasi)
    {
        $query = "
            select rp.*,p.*,i.nama_instansi,d.nama_dokter,pt.nama_pasien_tipe,p.nama nama_pasien,p.alamat alamat_pasien,d.gelar_depan,d.gelar_belakang
            from registrasi_pemeriksaan rp
            join pasien p on rp.id_pasien=p.id_pasien
            join instansi i on i.id_instansi=rp.id_instansi
            left join dokter d on d.id_dokter=rp.id_dokter_pengirim
            join pasien_tipe pt on pt.id_pasien_tipe =rp.id_pasien_tipe
            where rp.id_registrasi_pemeriksaan='{$id_registrasi}'
            ";
        return Yii::app()->db->createCommand($query)->queryRow();
    }

    private function getDataRegistrasiPenyewaan($id_registrasi)
    {
        $query_view = "
            select rp.*,i.nama_instansi,pt.nama_pasien_tipe,pb.*
            from registrasi_penyewaan rp
            left join instansi i on rp.id_instansi = i.id_instansi
            join pasien_tipe pt on pt.id_pasien_tipe=rp.id_pasien_tipe
            left join registrasi_penyewaan_bayar rpb on rpb.id_registrasi_penyewaan=rp.id_registrasi_penyewaan
            left join penyewaan_biaya pb on pb.id_registrasi_penyewaan_biaya=rpb.id_registrasi_penyewaan_biaya
            where rp.id_registrasi_penyewaan='{$id_registrasi}'
            ";
        return Yii::app()->db->createCommand($query_view)->queryRow();
    }

    private function getPasienPenyewaan($no_registrasi)
    {
        $query_registrasi_fasilitas = "
                    select ppb.*,bs.*,bst.*,ss.nama_satuan
                    from pasien_penyewaan_barang ppb
                    join barang_sewa_tarif bst on bst.id_barang_sewa_tarif=ppb.id_barang_sewa_tarif
                    join barang_sewa bs on bs.id_barang_sewa=bst.id_barang_sewa
                    join satuan_sewa ss on ss.id_satuan_sewa =bst.id_satuan_sewa
                    where ppb.no_registrasi_penyewaan = '{$no_registrasi}'
                    order by bs.id_barang_sewa
                    ";
        return Yii::app()->db->createCommand($query_registrasi_fasilitas)->queryAll();
    }

    public function actionNota()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_user_login = Yii::app()->user->getId();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_biaya_tambahan = Yii::app()->db->createCommand("select * from pemeriksaan_biaya_tambahan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryAll();
        $data_pembayaran = Yii::app()->db->createCommand("select * from pembayaran_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}' and status_pembayaran='0'")->queryRow();
        $data_pasien_pemeriksaan = $this->getPasienPemeriksan($id_registrasi);
        $potongan_pasien_pemeriksaan = Yii::app()->db->createCommand("select sum(potongan) from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryScalar();
        $data_registrasi = $this->getDataRegistrasiPemeriksaan($id_registrasi);
        $this->render('cetak_nota', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'user_login' => $user_login,
            'data_biaya_tambahan' => $data_biaya_tambahan,
            'data_pembayaran' => $data_pembayaran,
            'data_pemeriksaan' => $data_pasien_pemeriksaan,
            'potongan_pemeriksaan' => $potongan_pasien_pemeriksaan
        ));
    }

    public function actionBayar_pemeriksaan()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_pembayaran = Yii::app()->request->getParam('id_pembayaran');
        $id_user_login = Yii::app()->user->getId();
        Yii::app()->db->createCommand("update no_kwitansi set no_kwitansi_pemeriksaan=no_kwitansi_pemeriksaan+1")->query();
        $no_kwitansi_cetak = Yii::app()->db->createCommand("select no_kwitansi_pemeriksaan from no_kwitansi")->queryScalar();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_biaya_tambahan = Yii::app()->db->createCommand("select * from pemeriksaan_biaya_tambahan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryAll();
        $data_pembayaran = Yii::app()->db->createCommand("select * from pembayaran_pemeriksaan where id_pembayaran_pemeriksaan='{$id_pembayaran}'")->queryRow();
        $data_pasien_pemeriksaan = $this->getPasienPemeriksan($id_registrasi);
        $potongan_pasien_pemeriksaan = Yii::app()->db->createCommand("select sum(potongan) from pasien_pemeriksaan where id_registrasi_pemeriksaan='{$id_registrasi}'")->queryScalar();
        $data_registrasi = $this->getDataRegistrasiPemeriksaan($id_registrasi);
        $this->render('bayar_pemeriksaan_baru', array(
            'id_registrasi' => $id_registrasi,
            'no_kwitansi_cetak' => $no_kwitansi_cetak,
            'data_registrasi' => $data_registrasi,
            'user_login' => $user_login,
            'data_biaya_tambahan' => $data_biaya_tambahan,
            'terbilang_pembayaran' => $this->getTerbilang($data_pembayaran['total_dibayar']),
            'data_pembayaran' => $data_pembayaran,
            'data_pemeriksaan' => $data_pasien_pemeriksaan,
            'potongan_pemeriksaan' => $potongan_pasien_pemeriksaan
        ));
    }

    public function actionHasil_pemeriksaan()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_user_login = Yii::app()->user->getId();
        $id_jabatan_ttd = 6; //MANAJER LABORATORIUM
        $id_unit = 15; // TDDC
        $q_unit = $id_unit != '' ? "and id_unit='{$id_unit}'" : "";
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $user_pj = Yii::app()->db->createCommand("select * from pegawai where id_jabatan='{$id_jabatan_ttd}' {$q_unit}")->queryRow();

        $data_pasien_pemeriksaan = $this->getPasienPemeriksanValidasi($id_registrasi);
        $data_registrasi = $this->getDataRegistrasiPemeriksaan($id_registrasi);
        $this->render('hasil_pemeriksaan', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'user_login' => $user_login,
            'user_pj' => $user_pj,
            'data_pemeriksaan' => $data_pasien_pemeriksaan
        ));
    }

    public function actionHasil_pemeriksaan_new()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_user_login = Yii::app()->user->getId();
        $id_jabatan_ttd = 6; //MANAJER LABORATORIUM
        $id_unit = 6; // TDDC
        $q_unit = $id_unit != '' ? "and id_unit='{$id_unit}'" : "";
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $user_pj = Yii::app()->db->createCommand("select * from pegawai where id_pegawai='71'")->queryRow();

        $data_pasien_pemeriksaan = $this->getPasienPemeriksanValidasi($id_registrasi);
        $data_registrasi = $this->getDataRegistrasiPemeriksaan($id_registrasi);
        $this->render('hasil_pemeriksaan_new', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'user_login' => $user_login,
            'user_pj' => $user_pj,
            'data_pemeriksaan' => $data_pasien_pemeriksaan
        ));
    }

    public function actionDeposit()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_user_login = Yii::app()->user->getId();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();

        $data_registrasi = $this->getDataRegistrasiPenyewaan($id_registrasi);
        $this->render('deposit', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'total_terbilang' => $this->getTerbilang($data_registrasi['besar_deposit'] + $data_registrasi['besar_biaya_administrasi']),
            'user_login' => $user_login
        ));
    }

    public function actionBayar_penyewaan()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $id_pembayaran = Yii::app()->request->getParam('id_pembayaran');
        $id_user_login = Yii::app()->user->getId();
        Yii::app()->db->createCommand("update no_kwitansi set no_kwitansi_penyewaan=no_kwitansi_penyewaan+1")->query();
        $no_kwitansi_cetak = Yii::app()->db->createCommand("select no_kwitansi_penyewaan from no_kwitansi")->queryScalar();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_pembayaran = Yii::app()->db->createCommand("select * from pembayaran_penyewaan where id_pembayaran_penyewaan='{$id_pembayaran}'")->queryRow();
        $data_pembayaran_detail = Yii::app()->db->createCommand("select * from pembayaran_penyewaan_detail where id_pembayaran_penyewaan='{$id_pembayaran}'")->queryAll();

        $data_registrasi = $this->getDataRegistrasiPenyewaan($id_registrasi);
        $this->render('bayar_penyewaan_baru', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'no_kwitansi_cetak' => $no_kwitansi_cetak,
            'data_pasien_penyewaan' => $this->getPasienPenyewaan($no_registrasi),
            'data_pembayaran' => $data_pembayaran,
            'data_pembayaran_detail' => $data_pembayaran_detail,
            'total_terbilang' => $this->getTerbilang($data_pembayaran['total_dibayar']),
            'user_login' => $user_login
        ));
    }

    public function actionPenyewaan_lembar_lab()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $id_user_login = Yii::app()->user->getId();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_anggota = Yii::app()->db->createCommand("select * from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();

        $data_registrasi = $this->getDataRegistrasiPenyewaan($id_registrasi);
        $this->render('lembar_lab_penyewaan', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'data_pasien_penyewaan' => $this->getPasienPenyewaan($no_registrasi),
            'data_anggota' => $data_anggota,
            'user_login' => $user_login
        ));
    }

    public function actionPenyewaan_lembar_registrasi()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $id_user_login = Yii::app()->user->getId();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_anggota = Yii::app()->db->createCommand("select * from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();

        $data_registrasi = $this->getDataRegistrasiPenyewaan($id_registrasi);
        $this->render('lembar_registrasi_penyewaan', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'data_pasien_penyewaan' => $this->getPasienPenyewaan($no_registrasi),
            'data_anggota' => $data_anggota,
            'user_login' => $user_login
        ));
    }

    public function actionPenyewaan_lembar_pemohon()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $id_user_login = Yii::app()->user->getId();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_anggota = Yii::app()->db->createCommand("select * from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();

        $data_registrasi = $this->getDataRegistrasiPenyewaan($id_registrasi);
        $this->render('lembar_pemohon_penyewaan', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'data_pasien_penyewaan' => $this->getPasienPenyewaan($no_registrasi),
            'data_anggota' => $data_anggota,
            'user_login' => $user_login
        ));
    }

    public function actionPemakaian_fasilitas()
    {
        $this->layout = 'wide_main';
        $id_registrasi = Yii::app()->request->getParam('reg');
        $no_registrasi = Yii::app()->request->getParam('no_reg');
        $id_user_login = Yii::app()->user->getId();
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $data_anggota = Yii::app()->db->createCommand("select * from registrasi_anggota_penyewaan where no_registrasi_penyewaan='{$no_registrasi}'")->queryAll();

        $data_registrasi = $this->getDataRegistrasiPenyewaan($id_registrasi);
        $this->render('pemakaian_fasilitas', array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'data_pasien_penyewaan' => $this->getPasienPenyewaan($no_registrasi),
            'data_anggota' => $data_anggota,
            'user_login' => $user_login
        ));
    }

    public function actionSertifikat_pengujian()
    {
        $id_registrasi = Yii::app()->request->getParam('reg');
        $id_user_login = Yii::app()->user->getId();
        $id_jabatan_ttd = 6; //MANAJER LABORATORIUM
        $id_unit = 15; // TDDC
        $q_unit = $id_unit != '' ? "and id_unit='{$id_unit}'" : "";
        $user_login = Yii::app()->db->createCommand("select * from pegawai where id_user='{$id_user_login}'")->queryRow();
        $user_pj = Yii::app()->db->createCommand("select * from pegawai where id_jabatan='{$id_jabatan_ttd}' {$q_unit}")->queryRow();

        $data_pasien_pemeriksaan = $this->getPasienPemeriksanValidasi($id_registrasi);
        $data_registrasi = $this->getDataRegistrasiPemeriksaan($id_registrasi);
        //die(var_dump($data_pasien_pemeriksaan));
        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();

        # render (full page)
        $mpdf->SetHTMLHeader($this->renderPartial('sertifikat_pengujian/header', array(), true));
        $mpdf->SetHTMLFooter($this->renderPartial('sertifikat_pengujian/footer', array(), true));
        $param_assign = array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'user_login' => $user_login,
            'user_pj' => $user_pj,
            'data_pemeriksaan' => $data_pasien_pemeriksaan
        );
        $mpdf->WriteHTML($this->renderPartial('sertifikat_pengujian/p1', $param_assign, true));
        $mpdf->AddPage();
        $mpdf->WriteHTML($this->renderPartial('sertifikat_pengujian/p2', $param_assign, true));
        $mpdf->Output();
    }

    public function actionBarcode()
    {
        $this->layout = false;        
        Yii::import("application.extensions.barcode.*");
        $id_registrasi = Yii::app()->request->getParam('reg');
        $data_registrasi = $this->getDataRegistrasiPemeriksaan($id_registrasi);
        $no_registrasi = str_replace("-", "", $data_registrasi['no_registrasi']);
        $width  = 460;
        //Height of the barcode image.
        $height = 54;
        //Quality of the barcode image. Only for JPEG.
        $quality = 100;
        //1 if text should appear below the barcode. Otherwise 0.
        $text = 0;
        // Location of barcode image storage.
        $location = Yii::getPathOfAlias("webroot") . '/barcode/' . $no_registrasi . '.jpg';
        barcode::Barcode39($no_registrasi, $width, $height, $quality, $text, $location);
        $mpdf = Yii::app()->ePdf->mpdf('', [176, 222]);
        $title='Barcode-'.$data_registrasi['nama_pasien'].'-'.$data_registrasi['no_registrasi'];
        $mpdf->SetTitle($title);
        $param_assign = array(
            'id_registrasi' => $id_registrasi,
            'data_registrasi' => $data_registrasi,
            'no_registrasi' => $no_registrasi,
        );
        $mpdf->WriteHTML($this->renderPartial('barcode', $param_assign, true));
        $mpdf->Output($title.'.pdf', 'I');
    }
}
