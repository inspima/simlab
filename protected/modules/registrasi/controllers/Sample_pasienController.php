<?php

class Sample_pasienController extends Controller {

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
                'actions' => array('read', 'create'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getPasienPemeriksan($id_registrasi) {
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
            array_push($result, array_merge($d, array('data_sample' => $data_sample)));
        }
        return $result;
    }

    public function actionRead() {
        $query_view = "
            select p.*,k.nama_kota,ag.nama_agama,r.*,i.nama_instansi
            from pasien p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            join registrasi_pemeriksaan r on p.id_pasien=r.id_pasien
            left join instansi i on i.id_instansi=r.id_instansi
            order by r.waktu_registrasi desc
            ";
        $data = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_pasien' => $data
        ));
    }

    public function actionCreate() {
        $id_registrasi = Yii::app()->request->getParam('reg');

        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah-sample') {
                $sample_pasien = new RegistrasiPasienSample;
                $sample_pasien->id_registrasi_pemeriksaan = $id_registrasi;
                $sample_pasien->id_sample = Yii::app()->request->getPost('sample');
                $sample_pasien->kode_sample = Yii::app()->request->getPost('kode');
                $sample_pasien->waktu_masuk = Yii::app()->request->getPost('waktu_masuk');
                $sample_pasien->keterangan_sample = Yii::app()->request->getPost('keterangan');
                if ($sample_pasien->save()) {
                    Yii::app()->user->setFlash('success', 'Data Sample berhasil ditambah');
                } else {
                    print_r($sample_pasien->getErrors());
                }
            } else if ($mode == 'sample-pemeriksaan') {
                $jumlah_data = Yii::app()->request->getPost('jumlah_data');
                $id_registrasi = Yii::app()->request->getPost('id_registrasi');
                $id_user_login = Yii::app()->user->getId();
                $sukses_input = 0;
                for ($i = 1; $i < $jumlah_data; $i++) {
                    $sample = Yii::app()->request->getPost('sample' . $i);
                    $id_pasien_pemeriksaan = Yii::app()->request->getPost('pasien_pemeriksaan_' . $i);
                    Yii::app()->db->createCommand("delete from pemeriksaan_sample where id_pasien_pemeriksaan='{$id_pasien_pemeriksaan}'")->query();
                    if (count($sample) > 0) {
                        foreach ($sample as $sp) {
                            $pemeriksaan_sample = new PemeriksaanSample;
                            $pemeriksaan_sample->id_pasien_pemeriksaan = $id_pasien_pemeriksaan;
                            $pemeriksaan_sample->id_registrasi_pasien_sample = $sp;
                            $pemeriksaan_sample->save();
                        }
                    }
                    $sukses_input++;
                }
                if (($jumlah_data - 1) == $sukses_input) {
                    Yii::app()->user->setFlash('success', 'Data Pasien Pemeriksaan berhasil diupdate');
                }
            }
        }
        $query_sample_pasien = "
            select rps.*,s.nama_sample
            from registrasi_pasien_sample rps
            join sample s on rps.id_sample=s.id_sample
            where rps.id_registrasi_pemeriksaan='{$id_registrasi}'
            order by rps.waktu_masuk desc,s.nama_sample
            ";
        $data_sample_pasien = Yii::app()->db->createCommand($query_sample_pasien)->queryAll();
        $data_pasien_pemeriksaan = $this->getPasienPemeriksan($id_registrasi);
        $data_jenis_sample = Sample::model()->findAll();
        $this->render('create', array(
            'id_registrasi' => $id_registrasi,
            'data_sample_pasien' => $data_sample_pasien,
            'data_pasien_pemeriksaan' => $data_pasien_pemeriksaan,
            'data_jenis_sample' => $data_jenis_sample
        ));
    }

    public function actionDelete() {
        
    }

}
