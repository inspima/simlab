<?php
        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
        header("Content-disposition: attachment; filename=lap-pendapatan-".$nama_unit['nama_unit'].".xls");
        




function getData($id_unit, $begin, $end){
    if($id_unit != '') 
          {$q_unit = " AND d.id_unit = '$id_unit' ";}
    else {$q_unit = " ";}
    $query = "SELECT d.nama_pengujian, f.nama_sample, g.nama_instansi, h.nama_unit, SUM(b.potongan) AS potongan,
                     b.besar_tarif, COUNT(ps.id_pemeriksaan_sample)*e.jumlah_sample AS JML_SAMPLE, 
                     (COUNT(ps.id_pemeriksaan_sample) * b.besar_tarif)*e.jumlah_sample AS JMLH,
                     COUNT(IF(c.id_pasien_tipe='7',ps.id_pemeriksaan_sample,NULL))*e.jumlah_sample as DIAGNOSTIC,
                     COUNT(IF(c.id_pasien_tipe='8',ps.id_pemeriksaan_sample,NULL))*e.jumlah_sample as PENELITIAN
            FROM  pemeriksaan_sample ps
            LEFT JOIN pasien_pemeriksaan b on ps.id_pasien_pemeriksaan = b.id_pasien_pemeriksaan
            LEFT JOIN registrasi_pemeriksaan c ON b.id_registrasi_pemeriksaan = c.id_registrasi_pemeriksaan
            LEFT JOIN registrasi_pasien_sample e ON ps.id_registrasi_pasien_sample = e.id_registrasi_pasien_sample
            LEFT JOIN pengujian d ON b.id_pengujian = d.id_pengujian
            LEFT JOIN sample f ON e.id_sample = f.id_sample
            LEFT JOIN instansi g ON c.id_instansi = g.id_instansi
            LEFT JOIN unit h ON d.id_unit = h.id_unit
            WHERE DATE_FORMAT(c.waktu_registrasi, '%Y-%m-%d') >= '$begin'
            AND DATE_FORMAT(c.waktu_registrasi, '%Y-%m-%d') <= '$end'"
            .$q_unit.
            "GROUP BY f.id_sample, d.id_pengujian, g.id_instansi
            ORDER BY d.id_pengujian";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    
    //echo $query;
    return $data;
}

function getBahan($id_unit, $begin, $end){
    if($id_unit != '') 
          {$q_unit = " AND e.id_unit = '$id_unit' ";}
    else {$q_unit = " ";}
    $query_old = "SELECT SUM(a.total_tarif)
    FROM bahan_pasien a LEFT JOIN registrasi_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
    WHERE DATE_FORMAT(b.waktu_registrasi, '%Y-%m-%d') >= '$begin' AND DATE_FORMAT(b.waktu_registrasi, '%Y-%m-%d') <= '$end'";
    $query = "SELECT SUM(total_tarif)
FROM bahan_pasien a LEFT JOIN registrasi_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
LEFT JOIN bahan_pengujian_pasien c ON a.id_bahan_pasien = c.id_bahan_pasien
LEFT JOIN pasien_pemeriksaan d ON c.id_pasien_pemeriksaan = d.id_pasien_pemeriksaan
LEFT JOIN pengujian e ON d.id_pengujian = e.id_pengujian
WHERE DATE_FORMAT(b.waktu_registrasi, '%Y-%m-%d') >= '$begin'
AND DATE_FORMAT(b.waktu_registrasi, '%Y-%m-%d') <= '$end'".$q_unit;
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    //echo $query;
    return $data;
}

function getBiayaTambahan($begin, $end){
    $query = "SELECT SUM(a.besar_biaya)
    FROM pemeriksaan_biaya_tambahan a LEFT JOIN registrasi_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
    WHERE DATE_FORMAT(b.waktu_registrasi, '%Y-%m-%d') >= '$begin' AND DATE_FORMAT(b.waktu_registrasi, '%Y-%m-%d') <= '$end'";
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}
?>


                            <table border="1" rules="all" width="100%">
                            <thead>
                                <tr>
                                    <td rowspan="2" valign="top">No</td>
                                    <td rowspan="2" valign="top">Jenis Pemeriksaan</td>
                                    <td rowspan="2" valign="top">Nama Sampel</td>
                                    <td rowspan="2" valign="top">Asal Pengirim</td>
                                    <td rowspan="2" valign="top">Tarif Satuan</td>
                                    <td rowspan="2" valign="top">Jumlah Sampel</td>
                                    <td colspan="4" valign="top"><div align="center">Pendapatan Lab</div></td>
                                </tr>
                                <tr>
                                    <th>Sampel Diagnostic</th>
                                    <th>Sampel Penelitian</th>
                                    <th>Potongan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data_pendapatan = getData($pil_unit, $awal, $akhir);
                                      $bahan_uji = getBahan($pil_unit, $awal, $akhir);
                                      $biaya_tambahan = getBiayaTambahan($awal, $akhir);
                                      $no = 1;
                                      $jumlah = 0;
                                      $Jp_diagnostik = 0;
                                      $Jp_penelitian = 0;
                                      $p_diagnostik = 0;
                                      $p_penelitian = 0;
                                      $J_np = 0;
                                      $J_nd = 0;
                                      $J_potongan = 0;
                                    foreach ($data_pendapatan as $d):
                                    
                                ?>
                                <tr>
                                    <td><?php echo $no; ?> </td>
                                    <td><?=$d['nama_pengujian']?><?php if($pil_unit == "") {echo "<br> [".$d['nama_unit']."]";} ?></td>
                                    <td><?=$d['nama_sample']?></td>
                                    <td><?=$d['nama_instansi']?></td>
                                    <td><?=$d['besar_tarif']?></td>
                                    <td><?=$d['JML_SAMPLE']?></td>
                                    <td><?php //if($d['id_pasien_tipe'] == '7'){$p_diagnostik = $d['JMLH']; echo $this->idr($p_diagnostik); } else{$p_diagnostik = 0; echo ' - ';} 
                                           $np=$d['DIAGNOSTIC']; echo $np." (".$p_diagnostik=$np*$d['besar_tarif'].") ";?></td>
                                    <td><?php //if($d['id_pasien_tipe'] == '8'){$p_penelitian = $d['JMLH']; echo $this->idr($p_penelitian);} else{$p_penelitian = 0; echo ' - ';}
                                             $nd=$d['PENELITIAN']; echo $nd." (".$p_penelitian=$nd*$d['besar_tarif'].") ";?></td>
                                    <td><b><?=$this->idr($d['potongan'])?></td>
                                    <td><?=$this->idr($d['JMLH'] - $d['potongan'])?></td>
                                </tr>
                                <?php $no++;
                                 $jumlah = $jumlah + ($d['JMLH'] - $d['potongan']);
                                $Jp_diagnostik = $Jp_diagnostik + $p_diagnostik;
                                $Jp_penelitian = $Jp_penelitian + $p_penelitian;
                                $J_np = $J_np + $np;
                                $J_nd = $J_nd + $nd;
                                $J_potongan = $J_potongan + $d['potongan'];
                                endforeach; 
                                ?>
                                <tr>
                                    <td colspan="6" bgcolor="#F5ECCE"><center><b>Jumlah Pendapatan Pengujian (per Lab.)</b></center></td>
                                    <td><b><?=$J_np." (".$this->idr($Jp_diagnostik).")";?></td>
                                    <td><b><?=$J_nd." (".$this->idr($Jp_penelitian).")";?></td>
                                    <td><?php echo "<b>".$this->idr($J_potongan)."</b>"?></td>
                                    <td><?php echo "<b>".$this->idr($jumlah)."</b>"?></td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">Pemakaian Bahan</td>
                                    <td><?=$this->idr($bahan_uji)?></td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center">Biaya Tambahan (Jika Ada)</td>
                                    <td><?=$this->idr($biaya_tambahan)?></td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center" bgcolor="#F5ECCE"><center><b>Jumlah Kotor Pendapatan (per Lab.)</b></center></td>
                                    <td><?php echo "<b>".$this->idr($jumlah + $bahan_uji + $biaya_tambahan)."</b>"?></td>
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
    $(document).ready(function() {
        $('#rekanan-datatable').dataTable({
            "lengthChange": true,
        });
        $('#rekanan-datatable tbody').on('click', '.rekanan-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/unit/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>

