<?php
include 'breadcumbs.php';


function instansi($jenis){
    
    $query = "SELECT id_instansi, kode_instansi, nama_instansi
            FROM instansi
            WHERE id_instansi_jenis='$jenis'
            AND id_instansi IN (SELECT id_instansi FROM registrasi_pemeriksaan)";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function instansiByKota($jenis, $kota){
    
    $query = "SELECT id_instansi, kode_instansi, nama_instansi
            FROM instansi
            WHERE id_instansi_jenis='$jenis'
            AND id_kota_instansi='$kota'
            AND id_instansi IN (SELECT id_instansi FROM registrasi_pemeriksaan)";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function getjml($id_instansi, $tgl){
    $query = "SELECT  SUM(e.jumlah_sample) AS JML_SAMPL
            FROM  pemeriksaan_sample ps
            LEFT JOIN pasien_pemeriksaan b on ps.id_pasien_pemeriksaan = b.id_pasien_pemeriksaan
            LEFT JOIN registrasi_pemeriksaan c ON b.id_registrasi_pemeriksaan = c.id_registrasi_pemeriksaan
            LEFT JOIN registrasi_pasien_sample e ON ps.id_registrasi_pasien_sample = e.id_registrasi_pasien_sample
            LEFT JOIN pengujian d ON b.id_pengujian = d.id_pengujian
            LEFT JOIN sample f ON e.id_sample = f.id_sample
            WHERE c.id_instansi = '$id_instansi'
            AND DATE_FORMAT(c.waktu_registrasi, '%Y-%m') = '$tgl'";
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan pemeriksaan <?php if($pil_tahun !='') echo'Tahun '.$pil_tahun; ?></h3>
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
                                <?php if($pil_tahun != '') {echo '<a class="btn btn-info" href="'.Yii::app()->createUrl("laporan/pemeriksaan/excelPengirim?id=$pil_tahun").'"><i class="icon-arrow-down"></i>&nbsp;&nbsp;Download Excel</a>';} ?> 
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                            <table style="margin :10px 0px" id="dokter-datatable" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td rowspan="2" valign="top">KODE </td>
                                    <td rowspan="2" valign="top">Instansi Pengirim</td>
                                    <td colspan="14"><div align="center">Jumlah Sampel</div></td>
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
                                    <th>Jml</th>
                                   
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $j_jan = 0; $j_jun = 0;  $j_nov = 0; 
                                $j_feb = 0; $j_jul = 0;  $j_des = 0;
                                $j_mar = 0; $j_agu = 0;
                                $j_apr = 0; $j_sep = 0;
                                $j_mei = 0; $j_okt = 0; 
                                foreach($data_jenis_instansi as $d ): 
                                 ?>
                                <tr>
                                    <td bgcolor="#FFFF00"><b><?php echo '' ?></b></td>
                                    <td bgcolor="#FFFF00"><b><?php echo $d['nama_instansi_jenis'] ?></b></td>
                                    <td colspan="13" bgcolor="#999999"></td>
                                </tr>
                                
                                <?php 
                                if ($d['nama_instansi_jenis']=='RS / Klinik') {
                                    foreach($data_kota as $dk ):
                                        echo '<tr><td bgcolor="#FFF"><b></b></td>'
                                            .'<td bgcolor="#FFF"><b>'.$dk['nama_kota'].'</b></td>'
                                            .'<td colspan="13" bgcolor="#999999"></td></tr>';
                                    
                                    
                                $data_instansi = instansiByKota($d['id_instansi_jenis'],$dk['id_kota_instansi']);
                                foreach ($data_instansi as $d1): 
                                  $instansi = $d1['id_instansi']; 
                                ?>
                                <tr>
                                    <td><?php echo $d1['kode_instansi']; ?></td>
                                    <td><?php echo $d1['nama_instansi'] ?></td>
                                    <td><?php $jan = getjml($instansi, $pil_tahun.'-01'); echo $jan; ?></td>
                                    <td><?php $feb = getjml($instansi, $pil_tahun.'-02'); echo $feb;  ?></td>
                                    <td><?php $mar = getjml($instansi, $pil_tahun.'-03'); echo $mar; ?></td>
                                    <td><?php $apr = getjml($instansi, $pil_tahun.'-04'); echo $apr; ?></td>
                                    <td><?php $mei = getjml($instansi, $pil_tahun.'-05'); echo $mei; ?></td>
                                    <td><?php $jun = getjml($instansi, $pil_tahun.'-06'); echo $jun; ?></td>
                                    <td><?php $jul = getjml($instansi, $pil_tahun.'-07'); echo $jul; ?></td>
                                    <td><?php $agu = getjml($instansi, $pil_tahun.'-08'); echo $agu; ?></td>
                                    <td><?php $sep = getjml($instansi, $pil_tahun.'-09'); echo $sep; ?></td>
                                    <td><?php $okt = getjml($instansi, $pil_tahun.'-10'); echo $okt; ?></td>
                                    <td><?php $nov = getjml($instansi, $pil_tahun.'-11'); echo $nov; ?></td>
                                    <td><?php $des = getjml($instansi, $pil_tahun.'-12'); echo $des; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php  $total = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des; echo $total; ?></b></td>
                                </tr> 
                                <?php
                                $j_jan = $j_jan + $jan;     $j_jun = $j_jun + $jun;  $j_nov = $j_nov + $nov; 
                                $j_feb = $j_feb + $feb;     $j_jul = $j_jul + $jul;  $j_des = $j_des + $des;
                                $j_mar = $j_mar + $mar;     $j_agu = $j_agu + $agu;
                                $j_apr = $j_apr + $apr;     $j_sep = $j_sep + $sep;
                                $j_mei = $j_mei + $mei;     $j_okt = $j_okt + $okt; 
                                endforeach;
                                endforeach;
                                
                                }
                                
                                else {
                               
                             
                                
                                
                                $data_instansi = instansi($d['id_instansi_jenis']);
                                foreach ($data_instansi as $d1): 
                                $instansi = $d1['id_instansi'];
                                
                                
                                ?>
                                
                                 <tr>
                                    <td><?php echo $d1['kode_instansi']; ?></td>
                                    <td><?php echo $d1['nama_instansi'] ?></td>
                                    <td><?php $jan = getjml($instansi, $pil_tahun.'-01'); echo $jan; ?></td>
                                    <td><?php $feb = getjml($instansi, $pil_tahun.'-02'); echo $feb;  ?></td>
                                    <td><?php $mar = getjml($instansi, $pil_tahun.'-03'); echo $mar; ?></td>
                                    <td><?php $apr = getjml($instansi, $pil_tahun.'-04'); echo $apr; ?></td>
                                    <td><?php $mei = getjml($instansi, $pil_tahun.'-05'); echo $mei; ?></td>
                                    <td><?php $jun = getjml($instansi, $pil_tahun.'-06'); echo $jun; ?></td>
                                    <td><?php $jul = getjml($instansi, $pil_tahun.'-07'); echo $jul; ?></td>
                                    <td><?php $agu = getjml($instansi, $pil_tahun.'-08'); echo $agu; ?></td>
                                    <td><?php $sep = getjml($instansi, $pil_tahun.'-09'); echo $sep; ?></td>
                                    <td><?php $okt = getjml($instansi, $pil_tahun.'-10'); echo $okt; ?></td>
                                    <td><?php $nov = getjml($instansi, $pil_tahun.'-11'); echo $nov; ?></td>
                                    <td><?php $des = getjml($instansi, $pil_tahun.'-12'); echo $des; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php  $total = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des; echo $total; ?></b></td>
                                </tr>  
                                
                                <?php 
                                
                                $j_jan = $j_jan + $jan;     $j_jun = $j_jun + $jun;  $j_nov = $j_nov + $nov; 
                                $j_feb = $j_feb + $feb;     $j_jul = $j_jul + $jul;  $j_des = $j_des + $des;
                                $j_mar = $j_mar + $mar;     $j_agu = $j_agu + $agu;
                                $j_apr = $j_apr + $apr;     $j_sep = $j_sep + $sep;
                                $j_mei = $j_mei + $mei;     $j_okt = $j_okt + $okt; 
                                endforeach; 
                                }
                                endforeach;
                                
                                
                                $all_total = $j_jan + $j_feb +  $j_mar + $j_apr + $j_mei + $j_jun + $j_jul + $j_agu + $j_sep + $j_okt + $j_nov + $j_des;
                                ?>
                                <tr>
                                    <td colspan="2" bgcolor="#CCCCCC"><b><center>Jumlah Sampel Per Bulan</center></b></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_jan; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_feb; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_mar; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_apr; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_mei; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_jun; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_jul; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_agu; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_sep; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_okt; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_nov; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $j_des; ?></td>
                                    <td bgcolor="#CCCCCC"><b><?php echo $all_total; ?></td>
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