<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
</head>
    

<?php
 header("Content-Type: application/vnd.ms-excel");
 header("Expires: 0");
 header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
 header("Content-disposition: attachment; filename=lap-pemeriksaan-".$pil_tahun.".xls"); 


function pengujian($kelompok){
    
    $query = "SELECT a.id_pengujian, nama_pengujian
                    FROM pengujian a 
                    WHERE id_pengujian_kelompok='$kelompok' AND jenis_pengujian='2' "
            . "     AND a.id_pengujian IN (SELECT id_pengujian FROM pasien_pemeriksaan)";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function getjml($id_penguian, $tgl){
    $query = "SELECT  SUM(e.jumlah_sample) AS JML_SAMPL
            FROM  pemeriksaan_sample ps
            LEFT JOIN pasien_pemeriksaan b on ps.id_pasien_pemeriksaan = b.id_pasien_pemeriksaan
            LEFT JOIN registrasi_pemeriksaan c ON b.id_registrasi_pemeriksaan = c.id_registrasi_pemeriksaan
            LEFT JOIN registrasi_pasien_sample e ON ps.id_registrasi_pasien_sample = e.id_registrasi_pasien_sample
            LEFT JOIN pengujian d ON b.id_pengujian = d.id_pengujian
            LEFT JOIN sample f ON e.id_sample = f.id_sample
            WHERE b.id_pengujian = '$id_penguian'
            AND DATE_FORMAT(c.waktu_registrasi, '%Y-%m') = '$tgl'";
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}
?>

                        
    <table width="100%" border="1" rules="all">
                            <thead>
                                <tr>
                                    <td rowspan="2" valign="top">KODE J.P</td>
                                    <td rowspan="2" valign="top">Jenis Pemriksaan</td>
                                    <td colspan="13"><div align="center">Jumlah Sampel</div></td>
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
                                foreach($data_kelompok_uji as $d ): ?>
                                <tr>
                                    <td><?php echo $d['id_pengujian_kelompok'] ?></td>
                                    <td bgcolor="#FFFF00"><?php echo $d['nama_pengujian_kelompok'] ?></td>
                                    <td colspan="13" bgcolor="#999999"></td>
                                    <!--
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    <td bgcolor="#999999"></td>
                                    -->
                                </tr>
                                
                                <?php 
                                $data_pengujian = pengujian($d['id_pengujian_kelompok']);
                                foreach ($data_pengujian as $d1): 
                                $uji = $d1['id_pengujian'];
                                
                                
                                ?>
                                
                                 <tr>
                                    <td><?php echo $uji ?></td>
                                    <td><?php echo $d1['nama_pengujian'] ?></td>
                                    <td><?php $jan = getjml($uji, $pil_tahun.'-01'); echo $jan; ?></td>
                                    <td><?php $feb = getjml($uji, $pil_tahun.'-02'); echo $feb;  ?></td>
                                    <td><?php $mar = getjml($uji, $pil_tahun.'-03'); echo $mar; ?></td>
                                    <td><?php $apr = getjml($uji, $pil_tahun.'-04'); echo $apr; ?></td>
                                    <td><?php $mei = getjml($uji, $pil_tahun.'-05'); echo $mei; ?></td>
                                    <td><?php $jun = getjml($uji, $pil_tahun.'-06'); echo $jun; ?></td>
                                    <td><?php $jul = getjml($uji, $pil_tahun.'-07'); echo $jul; ?></td>
                                    <td><?php $agu = getjml($uji, $pil_tahun.'-08'); echo $agu; ?></td>
                                    <td><?php $sep = getjml($uji, $pil_tahun.'-09'); echo $sep; ?></td>
                                    <td><?php $okt = getjml($uji, $pil_tahun.'-10'); echo $okt; ?></td>
                                    <td><?php $nov = getjml($uji, $pil_tahun.'-11'); echo $nov; ?></td>
                                    <td><?php $des = getjml($uji, $pil_tahun.'-12'); echo $des; ?></td>
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
                       

<?php
include 'plugins.php';
?>
