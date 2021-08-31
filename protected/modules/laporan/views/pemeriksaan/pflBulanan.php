<?php

    function biayaPendaftaran($noreg, $jenis)
    {


        $query = "SELECT SUM(a.besar_biaya)
                FROM pembayaran_penyewaan_detail a 
                LEFT JOIN pembayaran_penyewaan b ON a.id_pembayaran_penyewaan = b.id_pembayaran_penyewaan
                LEFT JOIN registrasi_penyewaan c ON b.no_registrasi_penyewaan = c.no_registrasi_penyewaan
                WHERE c.id_registrasi_penyewaan = '$noreg'
                AND a.nama_biaya = '$jenis'";
        $data = Yii::app()->db->createCommand($query)->queryScalar();


        return $data;
    }

    function biayaPelunasan($noreg, $id)
    {

        $query = "SELECT SUM(a.besar_tarif) AS tarif
                FROM pasien_penyewaan_barang a 
                LEFT JOIN barang_sewa_tarif b ON a.id_barang_sewa_tarif = b.id_barang_sewa_tarif
                LEFT JOIN barang_sewa c ON b.id_barang_sewa = c.id_barang_sewa
                WHERE a.no_registrasi_penyewaan = '$noreg'
                AND c.jenis_barang = '$id'";
        $data = Yii::app()->db->createCommand($query)->queryScalar();

        return $data;
    }

    function getData($tgl)
    {
        $query = "
            SELECT b.waktu_pembayaran, a.nama_penanggung_jawab, a.instansi_asal as nama_instansi,
                a.id_pasien_tipe, c.jenis_pasien_tipe, 
                a.id_registrasi_penyewaan, 
                a.no_registrasi_penyewaan, a.status_team_penelitian, 
                a.status_perpanjangan, a.tgl_order_masuk, a.tgl_order_warning AS tgl_order_selesai, 
                a.perpanjangan_ke, c.jenjang_pasien_tipe,a.no_kwitansi_daftar,
                COUNT(DISTINCT e.id_registrasi_anggota_penyewaan) AS Janggota
            FROM registrasi_penyewaan a
            LEFT JOIN pembayaran_penyewaan b ON a.no_registrasi_penyewaan = b.no_registrasi_penyewaan
            LEFT JOIN pasien_tipe c ON a.id_pasien_tipe = c.id_pasien_tipe
            LEFT JOIN instansi d ON a.id_instansi = d.id_instansi
            LEFT JOIN registrasi_anggota_penyewaan e ON a.no_registrasi_penyewaan = e.no_registrasi_penyewaan
            WHERE DATE_FORMAT(a.tgl_order_masuk,'%Y-%m') = '$tgl' 
            GROUP BY b.waktu_pembayaran, a.nama_penanggung_jawab, a.instansi_asal,
                    a.id_pasien_tipe, c.jenis_pasien_tipe, 
                    a.id_registrasi_penyewaan, 
                    a.no_registrasi_penyewaan, a.status_team_penelitian, 
                    a.status_perpanjangan, a.tgl_order_masuk, a.tgl_order_warning, 
                    a.perpanjangan_ke, c.jenjang_pasien_tipe,a.no_kwitansi_daftar";
        $data = Yii::app()->db->createCommand($query)->queryAll();
        return $data;
    }

    function PenelitiantTipe($noreg, $jenis)
    {
        $query = "SELECT COUNT(DISTINCT a.id_registrasi_anggota_penyewaan) + COUNT(DISTINCT b.no_registrasi_penyewaan) AS JML
        FROM registrasi_anggota_penyewaan a
        LEFT JOIN registrasi_penyewaan b ON a.no_registrasi_penyewaan = b.no_registrasi_penyewaan
        LEFT JOIN pasien_tipe c ON b.id_pasien_tipe = c.id_pasien_tipe
        WHERE c.jenjang_pasien_tipe = '$jenis'
        AND a.no_registrasi_penyewaan = '$noreg'";

        $data = Yii::app()->db->createCommand($query)->queryScalar();
        return $data;
    }

?>

<div class="row-fluid" style="padding: 20px;margin: 10px">
    <h3>Laporan PFL Bulanan <?php if ($pil_bulan != '') {
            echo '- Bulan ' . $pil_bulan;
        } ?></h3>
    <form class="form-horizontal  form-validation" method="post" style="width: 100%">
        <fieldset>

            <div class="control-group">
                <label class="control-label col-md-1" for="tahun">Bulan </label>
                <div class="controls col-md-2">
                    <select name="bulan" class="form-control" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                        <?php
                            foreach ($bulan as $data):
                                ?>
                                <option value="<?php echo $data['BLN'] ?>" <?php
                                    if ($data['BLN'] == $pil_bulan) {
                                        echo "selected";
                                    }
                                ?>><?php echo $data['BLN'] ?></option>
                            <?php
                            endforeach;
                        ?>
                    </select>

                </div> <!-- /controls -->
            </div> <!-- /control-group -->
            <div class="control-group">
                <label class="control-label col-md-1" for="jenis_tampilan">Tampilan </label>
                <div class="controls col-md-2">
                    <select name="jenis_tampilan" class="form-control" tabindex="2">
                        <option value="1" <?php if ($jenis_tampilan == '1') {
                            echo 'selected';
                        } ?>>Registrasi
                        </option>
                        <option value="2" <?php if ($jenis_tampilan == '2') {
                            echo 'selected';
                        } ?>>Pelunasan
                        </option>
                    </select>

                </div> <!-- /controls -->
            </div> <!-- /control-group -->
            <div class="form-actions" style="display: block">
                <button type="submit" class="btn btn-primary">Lihat</button>
                <?php
                    if ($pil_bulan != '') {
                        echo '<a class="btn btn-info" href="' . Yii::app()->createUrl("laporan/pemeriksaan/excelPfl?id=$pil_bulan&jenis_tampilan=$jenis_tampilan") . '"><i class="icon-arrow-down"></i>&nbsp;&nbsp;Download Excel</a>';
                    }
                ?>
            </div>
            <table style="margin :10px 0px" id="dokter-datatable" class="table table-bordered" cellspacing="0" width="90%">
                <thead>
                <tr>
                    <td rowspan="2" valign="top">No</td>
                    <td rowspan="2" valign="top">Tgl Bayar</td>
                    <td rowspan="2" valign="top">Nama Pemohon</td>
                    <td rowspan="2" valign="top">Baru/Perpanjangan</td>
                    <td rowspan="2" valign="top">S/G</td>
                    <td rowspan="2" valign="top">Jenis Riset</td>
                    <td rowspan="2" valign="top">Asal Instansi</td>
                    <td rowspan="2" valign="top">No Registrasi / pelunasan</td>
                    <td colspan="3" valign="top">Pendaftaran</td>
                    <td colspan="5" valign="top">Pelunasan</td>
                    <td rowspan="2" valign="top">Total</td>
                    <td colspan="8" valign="top">JML. JUDUL BERDASAR JENIS RISET / JML. INSTANSI PFL</td>
                </tr>

                <tr>
                    <th>Bench Fee</th>
                    <th>Deposit</th>
                    <th>Adm.</th>
                    <th>Penyusutan Alat</th>
                    <th>Sewa Kandang Hewan Coba</th>
                    <th>Pemakaian bahan</th>
                    <th>Jasa Konsultan</th>
                    <th>Jasa Teknisi</th>
                    <th>PKMP / Skripsi</th>
                    <th>Tesis/PPDS/PPDGS</th>
                    <th>Disertasi</th>
                    <th>Dosen / Dana Hibah, BOPTN</th>
                    <th>Instansi/ Lab. Klinik</th>
                    <th>PKL / MAGANG</th>
                    <th>DOSEN NON UNAIR</th>
                </tr>


                </thead>
                <tbody>
                <?php
                    $pasien1 = 0;
                    $pendaftaran1 = 0;
                    $pasien2 = 0;
                    $pendaftaran2 = 0;
                    $pasien3 = 0;
                    $pendaftaran3 = 0;
                    $pasien4 = 0;
                    $pelunasan1 = 0;
                    $pasien5 = 0;
                    $pasien6 = 0;
                    $pasien7 = 0;
                    $pelunasan2 = 0;
                    $Jpasien1 = 0;
                    $pelunasan3 = 0;
                    $Jpasien2 = 0;
                    $pelunasan4 = 0;
                    $Jpasien3 = 0;
                    $pelunasan5 = 0;
                    $Jpasien4 = 0;
                    $pelunasanTotal = 0;
                    $Jpasien5 = 0;
                    $Jpasien6 = 0;
                    $Jpasien7 = 0;
                    $JpelunasanTotal = 0;
                    $Jpelunasan1 = 0;
                    $Jpelunasan2 = 0;
                    $Jpelunasan3 = 0;
                    $Jpelunasan4 = 0;
                    $Jpelunasan5 = 0;
                    $Jpendaftaran1 = 0;
                    $Jpendaftaran2 = 0;
                    $Jpendaftaran3 = 0;
                    $no = 1;
                    $data_pfl = getData($pil_bulan);

                    foreach ($data_pfl as $d):
                        $status_perpanjangan = '';
                        $status_team_penelitian = '';
                        ?>
                        <tr>
                            <td><b><?php echo $no; ?></b></td>
                            <td><b><?php echo strftime('%d-%m-%Y', strtotime($d['waktu_pembayaran'])); ?></b></td>
                            <td><b><?php echo $d['nama_penanggung_jawab']; ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '1') {
                                            $status_perpanjangan = 'B<br>' . strftime('%d-%m-%Y', strtotime($d['tgl_order_masuk'])) . " - " . strftime('%d-%m-%Y', strtotime($d['tgl_order_selesai']));
                                        } else if ($d['status_perpanjangan'] == '2') {
                                            $status_perpanjangan = 'P - ' . $d['perpanjangan_ke'] . '<br>' . strftime('%d-%m-%Y', strtotime($d['tgl_order_masuk'])) . " - " . strftime('%d-%m-%Y', strtotime($d['tgl_order_selesai']));
                                        }

                                        echo $status_perpanjangan;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_team_penelitian'] == '1') {
                                            $status_team_penelitian = 'S';
                                        } else if ($d['status_team_penelitian'] == '2') {
                                            $status_team_penelitian = 'G (' . $d['Janggota'] . ' Orang)';
                                        }
                                        echo $status_team_penelitian;
                                    ?></b></td>
                            <td><b><?php echo $d['jenjang_pasien_tipe']; ?></b></td>
                            <td><b><?php echo $d['nama_instansi']; ?></b></td>
                            <td><b><?php echo $d['no_kwitansi_daftar']; ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pendaftaran1 = 0;
                                        } else {
                                            $pendaftaran1 = biayaPendaftaran($d['id_registrasi_penyewaan'], 'Bench Fee');
                                            $pendaftaran1 = $pendaftaran1 + $d['Janggota'] * $pendaftaran1;
                                        }
                                        echo $this->idr($pendaftaran1);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pendaftaran2 = 0;
                                        } else {
                                            $pendaftaran2 = biayaPendaftaran($d['id_registrasi_penyewaan'], 'Deposit');
                                        }
                                        echo $this->idr($pendaftaran2);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pendaftaran3 = 0;
                                        } else {
                                            $pendaftaran3 = biayaPendaftaran($d['id_registrasi_penyewaan'], 'Administrasi');
                                            $pendaftaran3 = $pendaftaran3;
                                        }
                                        echo $this->idr($pendaftaran3);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        $pelunasan1 = biayaPelunasan($d['no_registrasi_penyewaan'], '1');
                                        echo $this->idr($pelunasan1);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        $pelunasan2 = biayaPelunasan($d['no_registrasi_penyewaan'], '2');
                                        echo $this->idr($pelunasan2);
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pelunasan3 = 0;
                                        } else {
                                            $pelunasan3 = biayaPelunasan($d['no_registrasi_penyewaan'], '4');
                                        }
                                        echo $this->idr($pelunasan3);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pelunasan4 = 0;
                                        } else {
                                            $pelunasan4 = biayaPelunasan($d['no_registrasi_penyewaan'], '3');
                                        }
                                        echo $this->idr($pelunasan4);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pelunasan5 = 0;
                                        } else {
                                            $pelunasan5 = biayaPelunasan($d['no_registrasi_penyewaan'], '5');
                                        }
                                        echo $this->idr($pelunasan5);
                                    ?></b>
                            </td>
                            <td><b><?php
                                        $pelunasanTotal = $pendaftaran1 + $pendaftaran3 + $pelunasan1 + $pelunasan2 + $pelunasan3 + $pelunasan4 + $pelunasan5 - $pendaftaran2;
                                        echo $this->idr($pelunasanTotal);
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien1 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'S1') {
                                                $pasien1 = 1;
                                            } else {
                                                $pasien1 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'S1');
                                            }
                                        }
                                        echo $pasien1;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien2 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'S2') {
                                                $pasien2 = 1;
                                            } else {
                                                $pasien2 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'S2');
                                            }
                                        }
                                        echo $pasien2;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien3 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'S3') {
                                                $pasien3 = 1;
                                            } else {
                                                $pasien3 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'S3');
                                            }
                                        }
                                        echo $pasien3;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien4 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'DOSEN') {
                                                $pasien4 = 1;
                                            } else {
                                                $pasien4 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'DOSEN');
                                            }
                                        }
                                        echo $pasien4;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien5 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'PASIF') {
                                                $pasien5 = 1;
                                            } else {
                                                $pasien5 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'PASIF');
                                            }
                                        }
                                        echo $pasien5;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien6 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'PKL') {
                                                $pasien6 = 1;
                                            } else {
                                                $pasien6 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'PKL');
                                            }
                                        }
                                        echo $pasien6;
                                    ?></b></td>
                            <td><b><?php
                                        if ($d['status_perpanjangan'] == '2') {
                                            $pasien7 = 0;
                                        } else {
                                            if (($d['status_team_penelitian'] == '1') && ($d['jenjang_pasien_tipe']) == 'DOSEN2') {
                                                $pasien7 = 1;
                                            } else {
                                                $pasien7 = PenelitiantTipe($d['no_registrasi_penyewaan'], 'DOSEN2');
                                            }
                                        }
                                        echo $pasien7;
                                    ?></b></td>

                        </tr>
                        <?php
                        $Jpasien1 = $Jpasien1 + $pasien1;
                        $Jpasien2 = $Jpasien2 + $pasien2;
                        $Jpasien3 = $Jpasien3 + $pasien3;
                        $Jpasien4 = $Jpasien4 + $pasien4;
                        $Jpasien5 = $Jpasien5 + $pasien5;
                        $Jpasien6 = $Jpasien6 + $pasien6;
                        $Jpasien7 = $Jpasien7 + $pasien7;
                        $Jpelunasan1 = $Jpelunasan1 + $pelunasan1;
                        $Jpelunasan2 = $Jpelunasan2 + $pelunasan2;
                        $Jpelunasan3 = $Jpelunasan3 + $pelunasan3;
                        $Jpelunasan4 = $Jpelunasan4 + $pelunasan4;
                        $Jpelunasan5 = $Jpelunasan5 + $pelunasan5;
                        $Jpendaftaran1 = $Jpendaftaran1 + $pendaftaran1;
                        $Jpendaftaran2 = $Jpendaftaran2 + $pendaftaran2;
                        $Jpendaftaran3 = $Jpendaftaran3 + $pendaftaran3;
                        $JpelunasanTotal = $JpelunasanTotal + $pelunasanTotal;
                        $no++;
                    endforeach;
                ?>
                <tr>
                    <td colspan="8" bgcolor="#F5ECCE"><b>
                            <center><?php echo 'SUB TOTAL' ?></center>
                        </b></td>
                    <td><b><?php echo $this->idr($Jpendaftaran1); ?></b></td>
                    <td><b><?php echo $this->idr($Jpendaftaran2); ?></b></td>
                    <td><b><?php echo $this->idr($Jpendaftaran3); ?></b></td>
                    <td><b><?php echo $this->idr($Jpelunasan1); ?></b></td>
                    <td><b><?php echo $this->idr($Jpelunasan2); ?></b></td>
                    <td><b><?php echo $this->idr($Jpelunasan3); ?></b></td>
                    <td><b><?php echo $this->idr($Jpelunasan4); ?></b></td>
                    <td><b><?php echo $this->idr($Jpelunasan5); ?></b></td>
                    <td><b><?php echo $this->idr($JpelunasanTotal); ?></b></td>
                    <td><b><?php echo $Jpasien1 ?></b></td>
                    <td><b><?php echo $Jpasien2 ?></b></td>
                    <td><b><?php echo $Jpasien3 ?></b></td>
                    <td><b><?php echo $Jpasien4 ?></b></td>
                    <td><b><?php echo $Jpasien5 ?></b></td>
                    <td><b><?php echo $Jpasien6 ?></b></td>
                    <td><b><?php echo $Jpasien7 ?></b></td>
                </tr>
                </tbody>
            </table>
        </fieldset>
    </form>
</div> <!-- /widget -->
</div> <!-- /row -->

<?php
    include 'plugins.php';
?>
<script>
    $(document).ready(function () {
        $('#rekanan-datatable').dataTable({
            "lengthChange": true,
        });
        $('#rekanan-datatable tbody').on('click', '.rekanan-delete-button', function () {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/unit/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function (data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>