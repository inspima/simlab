<?php

function biayaPelunasan($noreg, $jenis, $tgl) {

    if ($jenis == 'Pemakaian Fasilitas') {
        $query = "SELECT SUM(a.besar_biaya)
                FROM pembayaran_penyewaan_detail a 
                LEFT JOIN pembayaran_penyewaan b ON a.id_pembayaran_penyewaan = b.id_pembayaran_penyewaan
                LEFT JOIN registrasi_penyewaan c ON b.no_registrasi_penyewaan = c.no_registrasi_penyewaan
                WHERE c.id_registrasi_penyewaan = '$noreg'
                AND a.nama_biaya in ('Penyusutan Alat','Pemakaian Fasilitas')
                AND DATE_FORMAT(b.waktu_pembayaran,'%Y-%m') = '$tgl'
            ";
        $data = Yii::app()->db->createCommand($query)->queryScalar();
    } else {
        $query = "SELECT SUM(a.besar_biaya)
                FROM pembayaran_penyewaan_detail a 
                LEFT JOIN pembayaran_penyewaan b ON a.id_pembayaran_penyewaan = b.id_pembayaran_penyewaan
                LEFT JOIN registrasi_penyewaan c ON b.no_registrasi_penyewaan = c.no_registrasi_penyewaan
                WHERE c.id_registrasi_penyewaan = '$noreg'
                AND a.nama_biaya = '$jenis'
                AND DATE_FORMAT(b.waktu_pembayaran,'%Y-%m') = '$tgl'
            ";
        $data = Yii::app()->db->createCommand($query)->queryScalar();
    }



    return $data;
}

function getData($tgl) {
    $query = "SELECT b.waktu_pembayaran, a.nama_penanggung_jawab, a.instansi_asal as nama_instansi,
                        a.id_pasien_tipe, c.jenis_pasien_tipe, 
                        a.id_registrasi_penyewaan, 
                        a.no_registrasi_penyewaan, a.status_team_penelitian, 
                        a.status_perpanjangan, a.tgl_order_masuk, a.tgl_order_warning AS tgl_order_selesai, 
                        a.perpanjangan_ke, c.jenjang_pasien_tipe,a.no_kwitansi_daftar,
                        b.no_kwitansi_pembayaran,
                        COUNT(DISTINCT e.id_registrasi_anggota_penyewaan) AS Janggota
                FROM registrasi_penyewaan a
                LEFT JOIN pembayaran_penyewaan b ON a.no_registrasi_penyewaan = b.no_registrasi_penyewaan and b.status_pembayaran='2'
                LEFT JOIN pasien_tipe c ON a.id_pasien_tipe = c.id_pasien_tipe
                LEFT JOIN instansi d ON a.id_instansi = d.id_instansi
                LEFT JOIN registrasi_anggota_penyewaan e ON a.no_registrasi_penyewaan = e.no_registrasi_penyewaan
                WHERE DATE_FORMAT(b.waktu_pembayaran,'%Y-%m') = '$tgl' GROUP BY a.no_registrasi_penyewaan";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function PenelitiantTipe($noreg, $jenis) {
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
    <h3>Laporan PFL Bulanan <?php if ($pil_bulan != '') echo'- Bulan ' . $pil_bulan; ?></h3>
    <form class="form-horizontal  form-validation"  method="post" style="width: 100%">
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
                        <option value="1" <?php if ($jenis_tampilan == '1') echo 'selected'; ?>>Registrasi</option>
                        <option value="2" <?php if ($jenis_tampilan == '2') echo 'selected'; ?>>Pelunasan</option>
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
                        <td rowspan="2" valign="top">No </td>
                        <td rowspan="2" valign="top">Tgl Bayar </td>
                        <td rowspan="2" valign="top">Nama Pemohon </td>
                        <td rowspan="2" valign="top">Baru/Perpanjangan</td>
                        <td rowspan="2" valign="top">S/G</td>
                        <td rowspan="2" valign="top">Jenis Riset </td>
                        <td rowspan="2" valign="top">Asal Instansi </td>
                        <td rowspan="2" valign="top">No Registrasi / pelunasan</td>
                        <td colspan="5" valign="top">Pelunasan </td>
                        <td rowspan="2" valign="top">Total </td>
                    </tr>

                    <tr>
                        <td>Penyusutan Alat</td>
                        <td>Sewa Kandang Hewan Coba</td>
                        <td>Pemakaian bahan</td>
                        <td>Jasa Konsultan</td>
                        <td>Jasa Teknisi</td>
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
                                    } elseif ($d['status_perpanjangan'] == '2') {
                                        $status_perpanjangan = 'P - ' . $d['perpanjangan_ke'] . '<br>' . strftime('%d-%m-%Y', strtotime($d['tgl_order_masuk'])) . " - " . strftime('%d-%m-%Y', strtotime($d['tgl_order_selesai']));
                                    }

                                    echo $status_perpanjangan;
                                    ?></b></td>
                            <td><b><?php
                                    if ($d['status_team_penelitian'] == '1') {
                                        $status_team_penelitian = 'S';
                                    } elseif ($d['status_team_penelitian'] == '2') {
                                        $status_team_penelitian = 'G (' . $d['Janggota'] . ' Orang)';
                                    }
                                    echo $status_team_penelitian;
                                    ?></b></td>
                            <td><b><?php echo $d['jenjang_pasien_tipe']; ?></b></td>
                            <td><b><?php echo $d['nama_instansi']; ?></b></td>
                            <td><b><?php echo $d['no_kwitansi_pembayaran']; ?></b></td>
                            <td style="text-align: right"><b><?php
                                    $pelunasan1 = biayaPelunasan($d['id_registrasi_penyewaan'], 'Pemakaian Fasilitas', $pil_bulan);
                                    echo $this->idr($pelunasan1);
                                    ?></b>
                            </td>
                            <td style="text-align: right"><b><?php
                                    $pelunasan2 = biayaPelunasan($d['id_registrasi_penyewaan'], 'Sewa Kandang', $pil_bulan);
                                    echo $this->idr($pelunasan2);
                                    ?></b></td>
                            <td style="text-align: right"><b><?php
                                    $pelunasan3 = biayaPelunasan($d['id_registrasi_penyewaan'], 'Bahan Habis Pakai', $pil_bulan);
                                    echo $this->idr($pelunasan3);
                                    ?></b>
                            </td>
                            <td style="text-align: right"><b><?php
                                    $pelunasan4 = biayaPelunasan($d['id_registrasi_penyewaan'], 'Jasa Konsultan', $pil_bulan);
                                    echo $this->idr($pelunasan4);
                                    ?></b>
                            </td>
                            <td style="text-align: right"><b><?php
                                    $pelunasan5 = biayaPelunasan($d['no_registrasi_penyewaan'], 'Jasa Teknisi', $pil_bulan);
                                    echo $this->idr($pelunasan5);
                                    ?></b>
                            </td>
                            <td style="text-align: right"><b><?php
                                    $pelunasanTotal = $pelunasan1 + $pelunasan2 + $pelunasan3 + $pelunasan4 + $pelunasan5;
                                    echo $this->idr($pelunasanTotal);
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
                        <td colspan="8" bgcolor="#F5ECCE"><b><center><?php echo 'SUB TOTAL' ?></center></b></td>
                        <td style="text-align: right"><b><?php echo $this->idr($Jpelunasan1); ?></b></td>
                        <td style="text-align: right"><b><?php echo $this->idr($Jpelunasan2); ?></b></td>
                        <td style="text-align: right"><b><?php echo $this->idr($Jpelunasan3); ?></b></td>
                        <td style="text-align: right"><b><?php echo $this->idr($Jpelunasan4); ?></b></td>
                        <td style="text-align: right"><b><?php echo $this->idr($Jpelunasan5); ?></b></td>
                        <td style="text-align: right"><b><?php echo $this->idr($JpelunasanTotal); ?></b></td>
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