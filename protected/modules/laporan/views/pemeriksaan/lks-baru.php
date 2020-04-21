<style>
    .table td, .table th {
        padding: 5px;
        line-height: 18px;
        text-align: left;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
</style>
<?php
include 'breadcumbs.php';

function instansi($jenis) {

    $query = "SELECT id_instansi, kode_instansi, nama_instansi
            FROM instansi
            WHERE id_jenis_instansi='$jenis'";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function instansiByKota($jenis, $kota) {

    $query = "SELECT id_instansi, kode_instansi, nama_instansi
            FROM instansi
            WHERE id_jenis_instansi='$jenis'
            AND id_kota_instansi='$kota'";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function getjml($id_tipe_pasien, $tgl) {
    $query = "SELECT COUNT(*)  as jml
                FROM `registrasi_penyewaan`
                WHERE id_pasien_tipe='$id_tipe_pasien'
                AND DATE_FORMAT(tgl_order_masuk, '%Y-%m')='$tgl'";
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}

function getjml2($jenis_pasien_tipe, $tgl) {
    $query = "SELECT COUNT(*)  as jml
                FROM `registrasi_penyewaan` a
                LEFT JOIN pasien_tipe b ON a.id_pasien_tipe = b.id_pasien_tipe
                WHERE b.jenis_pasien_tipe='$jenis_pasien_tipe'
                AND DATE_FORMAT(a.tgl_order_masuk, '%Y-%m')='$tgl'";
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}

function getPendapatan($tgl) {
    $query = "SELECT sum(b.total_dibayar)  as jml
             FROM `registrasi_penyewaan` a
			 LEFT JOIN pembayaran_penyewaan b ON a.no_registrasi_penyewaan = b.no_registrasi_penyewaan
             WHERE DATE_FORMAT(a.tgl_order_masuk, '%Y-%m')='$tgl'";
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan Kinerja Setahun <?php if ($pil_tahun != '') echo'Tahun ' . $pil_tahun; ?></h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    

                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="tahun">Tahun </label>
                            <div class="controls">
                                <select name="tahun" class="" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                                    <?php
                                    foreach ($tahun as $data):
                                        ?>
                                        <option value="<?php echo $data['tahun'] ?>" <?php
                                        if ($data['tahun'] == $pil_tahun) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $data['tahun'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                                <button type="submit" class="btn btn-primary">Lihat</button>
                                <?php
                                if ($pil_tahun != '') {
                                    echo '<a class="btn btn-info" href="' . Yii::app()->createUrl("laporan/pemeriksaan/excelLks?id=$pil_tahun") . '"><i class="icon-arrow-down"></i>&nbsp;&nbsp;Download Excel</a>';
                                }
                                ?> 
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <table style="margin :1px 1px;width: 98%" id="dokter-datatable" class="table table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <td rowspan="2" valign="top">No </td>
                                    <td rowspan="2" valign="top">Deskripsi</td>
                                    <td colspan="12" valign="top"  width="80%"><center>Subtotal </center></td>
                            <td rowspan="2" valign="top">Jumlah </td>
                            </tr>
                            <tr>
                                <th>Januari</th>
                                <th>Februari</th>
                                <th>Maret</th>
                                <th>April</th>
                                <th>Mei</th>
                                <th>Juni</th>
                                <th>Juli</th>
                                <th>Agustus</th>
                                <th>September</th>
                                <th>Oktober</th>
                                <th>November</th>
                                <th>Desember</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j_jan = 0;
                                $j_jun = 0;
                                $j_nov = 0;
                                $j_feb = 0;
                                $j_jul = 0;
                                $j_des = 0;
                                $j_mar = 0;
                                $j_agu = 0;
                                $j_apr = 0;
                                $j_sep = 0;
                                $j_mei = 0;
                                $j_okt = 0;
                                /*
                                  foreach($data_jenis_instansi as $d ):
                                 * 
                                 */
                                ?>
                                <tr>
                                    <td><b><?php echo '1' ?></b></td>
                                    <td><b><?php echo 'PFL untuk Riset (jumlah judul)' ?></b></td>
                                    <td colspan="13" bgcolor="#999999"></td>
                                </tr>


                                <?php
                                foreach ($pasien_riset as $d):
                                    if ($d['id_pasien_tipe'] != 9) {
                                        $uji = $d['id_pasien_tipe'];
                                        echo '
                                      <tr>
                                      <td>' . "" . '</td>
                                      <td> - ' . $d['nama_pasien_tipe'] . '</td>
                                      <td>' . $jan = getjml($uji, $pil_tahun . '-01') . '</td>
                                      <td>' . $feb = getjml($uji, $pil_tahun . '-02') . '</td>
                                      <td>' . $mar = getjml($uji, $pil_tahun . '-03') . '</td>
                                      <td>' . $apr = getjml($uji, $pil_tahun . '-04') . '</td>
                                      <td>' . $mei = getjml($uji, $pil_tahun . '-05') . '</td>
                                      <td>' . $jun = getjml($uji, $pil_tahun . '-06') . '</td>
                                      <td>' . $jul = getjml($uji, $pil_tahun . '-07') . '</td>
                                      <td>' . $agu = getjml($uji, $pil_tahun . '-08') . '</td>
                                      <td>' . $sep = getjml($uji, $pil_tahun . '-09') . '</td>
                                      <td>' . $okt = getjml($uji, $pil_tahun . '-10') . '</td>
                                      <td>' . $nov = getjml($uji, $pil_tahun . '-11') . '</td>
                                      <td>' . $des = getjml($uji, $pil_tahun . '-12') . '</td>
                                      <td>';
                                        $total = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des;
                                        echo $total . '</td>
                                      </tr>';


                                        $j_jan = $j_jan + $jan;
                                        $j_jun = $j_jun + $jun;
                                        $j_nov = $j_nov + $nov;
                                        $j_feb = $j_feb + $feb;
                                        $j_jul = $j_jul + $jul;
                                        $j_des = $j_des + $des;
                                        $j_mar = $j_mar + $mar;
                                        $j_agu = $j_agu + $agu;
                                        $j_apr = $j_apr + $apr;
                                        $j_sep = $j_sep + $sep;
                                        $j_mei = $j_mei + $mei;
                                        $j_okt = $j_okt + $okt;
                                        $all_total = $j_jan + $j_feb + $j_mar + $j_apr + $j_mei + $j_jun + $j_jul + $j_agu + $j_sep + $j_okt + $j_nov + $j_des;
                                    }
                                endforeach;
                                ?>
                                <tr>
                                    <td><b><?php echo '' ?></b></td>
                                    <td><b><?php echo 'SUB TOTAL / BLN' ?></b></td>
                                    <td><?php echo $j_jan; ?></td>
                                    <td><?php echo $j_feb; ?></td>
                                    <td><?php echo $j_mar; ?></td>
                                    <td><?php echo $j_apr; ?></td>
                                    <td><?php echo $j_mei; ?></td>
                                    <td><?php echo $j_jun; ?></td>
                                    <td><?php echo $j_jul; ?></td>
                                    <td><?php echo $j_agu; ?></td>
                                    <td><?php echo $j_sep; ?></td>
                                    <td><?php echo $j_okt; ?></td>
                                    <td><?php echo $j_nov; ?></td>
                                    <td><?php echo $j_des; ?></td>
                                    <td><?php echo $all_total; ?></td>
                                </tr> 
                                <tr>
                                    <td><b><?php echo '2' ?></b></td>
                                    <td><b><?php echo 'PFL untuk Non Riset (jumlah kunjungan)' ?></b></td>
                                    <td colspan="13" bgcolor="#999999"></td>
                                </tr>
                                <?php
                                foreach ($pasien_riset as $d):
                                    if ($d['id_pasien_tipe'] == 9) {
                                        $uji = $d['id_pasien_tipe'];
                                        echo '
                                      <tr>
                                      <td>' . "" . '</td>
                                      <td> - ' . $d['nama_pasien_tipe'] . '</td>
                                      <td>' . $jan = getjml($uji, $pil_tahun . '-01') . '</td>
                                      <td>' . $feb = getjml($uji, $pil_tahun . '-02') . '</td>
                                      <td>' . $mar = getjml($uji, $pil_tahun . '-03') . '</td>
                                      <td>' . $apr = getjml($uji, $pil_tahun . '-04') . '</td>
                                      <td>' . $mei = getjml($uji, $pil_tahun . '-05') . '</td>
                                      <td>' . $jun = getjml($uji, $pil_tahun . '-06') . '</td>
                                      <td>' . $jul = getjml($uji, $pil_tahun . '-07') . '</td>
                                      <td>' . $agu = getjml($uji, $pil_tahun . '-08') . '</td>
                                      <td>' . $sep = getjml($uji, $pil_tahun . '-09') . '</td>
                                      <td>' . $okt = getjml($uji, $pil_tahun . '-10') . '</td>
                                      <td>' . $nov = getjml($uji, $pil_tahun . '-11') . '</td>
                                      <td>' . $des = getjml($uji, $pil_tahun . '-12') . '</td>
                                      <td>';
                                        $total = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des;
                                        echo $total . '</td>
                                      </tr>';


                                        $j_jan = $j_jan + $jan;
                                        $j_jun = $j_jun + $jun;
                                        $j_nov = $j_nov + $nov;
                                        $j_feb = $j_feb + $feb;
                                        $j_jul = $j_jul + $jul;
                                        $j_des = $j_des + $des;
                                        $j_mar = $j_mar + $mar;
                                        $j_agu = $j_agu + $agu;
                                        $j_apr = $j_apr + $apr;
                                        $j_sep = $j_sep + $sep;
                                        $j_mei = $j_mei + $mei;
                                        $j_okt = $j_okt + $okt;
                                    }
                                endforeach;
                                ?>
                                <tr>
                                    <td><?php $PFL_instansi = 2; ?></td>
                                    <td><?php echo '-Instansi / Lab. Klinik' ?></td>
                                    <td><?php
                                        $jan = getjml2($PFL_instansi, $pil_tahun . '-01');
                                        echo $jan;
                                        ?></td>
                                    <td><?php
                                        $feb = getjml2($PFL_instansi, $pil_tahun . '-02');
                                        echo $feb;
                                        ?></td>
                                    <td><?php
                                        $mar = getjml2($PFL_instansi, $pil_tahun . '-03');
                                        echo $mar;
                                        ?></td>
                                    <td><?php
                                        $apr = getjml2($PFL_instansi, $pil_tahun . '-04');
                                        echo $apr;
                                        ?></td>
                                    <td><?php
                                        $mei = getjml2($PFL_instansi, $pil_tahun . '-05');
                                        echo $mei;
                                        ?></td>
                                    <td><?php
                                        $jun = getjml2($PFL_instansi, $pil_tahun . '-06');
                                        echo $jun;
                                        ?></td>
                                    <td><?php
                                        $jul = getjml2($PFL_instansi, $pil_tahun . '-07');
                                        echo $jul;
                                        ?></td>
                                    <td><?php
                                        $agu = getjml2($PFL_instansi, $pil_tahun . '-08');
                                        echo $agu;
                                        ?></td>
                                    <td><?php
                                        $sep = getjml2($PFL_instansi, $pil_tahun . '-09');
                                        echo $sep;
                                        ?></td>
                                    <td><?php
                                        $okt = getjml2($PFL_instansi, $pil_tahun . '-10');
                                        echo $okt;
                                        ?></td>
                                    <td>
                                        <?php
                                        $nov = getjml2($PFL_instansi, $pil_tahun . '-11');
                                        echo $nov;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $des = getjml2($PFL_instansi, $pil_tahun . '-12');
                                        echo $des;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $total = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des;
                                        echo $total;
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $j_jan = $j_jan + $jan;
                                $j_jun = $j_jun + $jun;
                                $j_nov = $j_nov + $nov;
                                $j_feb = $j_feb + $feb;
                                $j_jul = $j_jul + $jul;
                                $j_des = $j_des + $des;
                                $j_mar = $j_mar + $mar;
                                $j_agu = $j_agu + $agu;
                                $j_apr = $j_apr + $apr;
                                $j_sep = $j_sep + $sep;
                                $j_mei = $j_mei + $mei;
                                $j_okt = $j_okt + $okt;
                                $all_total = $j_jan + $j_feb + $j_mar + $j_apr + $j_mei + $j_jun + $j_jul + $j_agu + $j_sep + $j_okt + $j_nov + $j_des;
                                ?>
                                <tr>
                                    <td><b><?php echo '' ?></b></td>
                                    <td><b><?php echo 'SUB TOTAL / BLN' ?></b></td>
                                    <td><?php echo $j_jan; ?></td>
                                    <td><?php echo $j_feb; ?></td>
                                    <td><?php echo $j_mar; ?></td>
                                    <td><?php echo $j_apr; ?></td>
                                    <td><?php echo $j_mei; ?></td>
                                    <td><?php echo $j_jun; ?></td>
                                    <td><?php echo $j_jul; ?></td>
                                    <td><?php echo $j_agu; ?></td>
                                    <td><?php echo $j_sep; ?></td>
                                    <td><?php echo $j_okt; ?></td>
                                    <td><?php echo $j_nov; ?></td>
                                    <td><?php echo $j_des; ?></td>
                                    <td><?php echo $all_total; ?></td>
                                </tr> 
                                <?php
                                $total_pendapatan = 0;
                                $P_apr = 0;
                                $P_agu = 0;
                                $P_des = 0;
                                $P_jan = 0;
                                $P_mei = 0;
                                $P_sep = 0;
                                $P_feb = 0;
                                $P_jun = 0;
                                $P_okt = 0;
                                $P_mar = 0;
                                $P_jul = 0;
                                $P_nov = 0;
                                ?>
                                <tr>
                                    <td><b><?php echo '3' ?></b></td>
                                    <td><b><?php echo 'Pendapatan Bulanan (dalam ribuan Rp)'; ?></b></td>
                                    <td><?php
                                        $P_jan = getPendapatan($pil_tahun . '-01');
                                        echo $this->idr($P_jan);
                                        ?></td>
                                    <td><?php
                                        $P_feb = getPendapatan($pil_tahun . '-02');
                                        echo $this->idr($P_feb);
                                        ?></td>
                                    <td><?php
                                        $P_mar = getPendapatan($pil_tahun . '-03');
                                        echo $this->idr($P_mar);
                                        ?></td>
                                    <td><?php
                                        $P_apr = getPendapatan($pil_tahun . '-04');
                                        echo $this->idr($P_apr);
                                        ?></td>
                                    <td><?php
                                        $P_mei = getPendapatan($pil_tahun . '-05');
                                        echo $this->idr($P_mei);
                                        ?></td>
                                    <td><?php
                                        $P_jun = getPendapatan($pil_tahun . '-06');
                                        echo $this->idr($P_jun);
                                        ?></td>
                                    <td><?php
                                        $P_jul = getPendapatan($pil_tahun . '-07');
                                        echo $this->idr($P_jul);
                                        ?></td>
                                    <td><?php
                                        $P_agu = getPendapatan($pil_tahun . '-08');
                                        echo $this->idr($P_agu);
                                        ?></td>
                                    <td><?php
                                        $P_sep = getPendapatan($pil_tahun . '-09');
                                        echo $this->idr($P_sep);
                                        ?></td>
                                    <td><?php
                                        $P_okt = getPendapatan($pil_tahun . '-10');
                                        echo $this->idr($P_okt);
                                        ?></td>
                                    <td><?php
                                        $P_nov = getPendapatan($pil_tahun . '-11');
                                        echo $this->idr($P_nov);
                                        ?></td>
                                    <td><?php
                                        $P_des = getPendapatan($pil_tahun . '-12');
                                        echo $this->idr($P_des);
                                        ?></td>
                                    <td><?php
                                        $total_pendapatan = $P_jan + $P_feb + $P_mar + $P_apr + $P_mei + $P_jun + $P_jul + $P_agu + $P_sep + $P_okt + $P_nov + $P_des;
                                        echo $this->idr($total_pendapatan);
                                        ?></td>
                                </tr>  
                            </tbody>
                        </table>
                        <br />
                    </fieldset>
                </form>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
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
