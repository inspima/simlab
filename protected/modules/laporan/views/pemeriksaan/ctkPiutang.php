<?php
$model_user = User::model()->find()->findByAttributes(array('id_user' => Yii::app()->user->id));



function getData($id_instansi, $begin, $end, $pil_dokter){
    
    if($pil_dokter != '0') { $query_dokter = "AND a.id_dokter_pengirim ='$pil_dokter'"; }
        else {$query_dokter = " ";}
    
    if($id_instansi != '0') { $query_instansi= "AND a.id_instansi = '$id_instansi'";}
        else {$query_instansi=" ";}
    
    
    $query = "SELECT a.id_registrasi_pemeriksaan, a.no_registrasi, a.waktu_registrasi, c.nama, c.alamat, c.telephone,
			SUM(b.total_dibayar) AS total_dibayar, (AVG(b.total_biaya) - SUM(b.total_dibayar+b.potongan)) as piutang, (AVG(b.total_biaya)- SUM(b.potongan)) AS total_biaya 
            FROM registrasi_pemeriksaan a
            LEFT JOIN pembayaran_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
            LEFT JOIN pasien c ON a.id_pasien = c.id_pasien
            WHERE DATE_FORMAT(a.waktu_registrasi, '%Y-%m-%d') <= '$end'
            AND DATE_FORMAT(a.waktu_registrasi, '%Y-%m-%d') >= '$begin'
            $query_dokter
            $query_instansi
            GROUP BY a.id_registrasi_pemeriksaan
            HAVING (SUM(b.total_dibayar) < AVG(b.total_biaya)- SUM(b.total_dibayar+b.potongan))";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

?>
<div class="container" >
    <div class="row-fluid">
        <div class="col-xs-2">
            <img height="85" width="85" src="<?php echo Yii::app()->createUrl('img/logo_unair.gif'); ?>"/>
        </div>
        <div class="col-xs-10">
            <div style="text-align: center" class="small">
                <h4>TROPICAL DISEASE DIAGNOSTIC CENTER</h4>

                <address style="margin: 4px 0px" class="align-left">
                    Institute of Tropical Disease (Lembaga Penyakit Tropis)<br/>
                    Universitas Airlangga<br/>
                    Ex.Tropical Disease Center (TDC), Kampus C Unair, Jl.Mulyorejo Surabaya -60115<br/>
                    Telp. (031) 5992445-46, Fax. (031) 5992445 <br/>
                    Email : <span style="text-decoration: underline">sekretariat@itd.unair.ac.id</span> Website: <span style="text-decoration: underline">www.itd.unair.ac.id</span> <br/>
                </address>
            </div>
        </div>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <h4 style="margin: 1px 0px">NOTA ORDER BELUM LUNAS</h4>
    Kelompok pasien : <?php if($pil_instansi == '0'){echo 'Semua Instansi';} else {echo $pil_instansi." - ".$nama_instansi['nama_instansi'];} ?> 
    <br>Dokter Pengirim : <?php if($pil_dokter == '0') {echo 'Semua Dokter';} else {echo Yii::app()->db->createCommand("SELECT nama_dokter FROM dokter WHERE id_dokter='$pil_dokter'")->queryScalar();} ?> 
    <div class="row-fluid" style="margin: 5px 0px;"></div>
    <div class="row-fluid">
                        
                            <table width="100%" border="0" rules="rows">
                            <thead>
                                <tr bgcolor="#848484">
                                    <td  valign="top">No</td>
                                    <td  valign="top">Nota Order</td>
                                    <td  valign="top">Tgl Daftar</td>
                                    <td  valign="top">Data Pasien</td>
                                    <td  valign="top">Total</td>
                                    <td  valign="top">Dibayar</td>
                                    <td  valign="top"><div align="center">Kurang</div></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data_pendapatan = getData($pil_instansi, $awal, $akhir, $pil_dokter);
                                      $no = 1; 
                                      $Jtotal = 0;
                                      $Jbayar = 0;
                                      $Jutang = 0;
                                      
                                    foreach ($data_pendapatan as $d):
                                    $id_reg = $d['id_registrasi_pemeriksaan'];
                                ?>
                                <tr>
                                    <td><?php echo $no; ?> </td>
                                    <td><?php echo $d['no_registrasi']
                                              
                                            ?>
                                    </td>
                                    <td><?php echo $d['waktu_registrasi']
                                              
                                        ?>
                                    </td>
                                    <td><?=$d['nama']?></td>
                                    <td><?=round($d['total_biaya'],2)?></td>
                                    <td><?=round($d['total_dibayar'],2)?></td>
                                    <td><?=round($d['piutang'],2)?></td>
                                    
                                </tr>
                                <?php $no++;
                                 $Jtotal = $Jtotal + $d['total_biaya'];
                                 $Jbayar = $Jbayar + $d['total_dibayar'];
                                 $Jutang = $Jutang + $d['piutang'];   
                                endforeach; 
                                ?>
                                <tr>
                                    <td colspan="4"><center>total</center></td> 
                                    <td><u><?=$Jtotal?></u></td>
                                    <td><u><?=$Jbayar?></u></td>
                                    <td><u><?=$Jutang?></u></td>
                                </tr>
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td colspan="2"><p>&nbsp;</p>
                                                    <br><center>Hormat Kami,</center>
                                                    <p>&nbsp;</p>
                                                    <br><center><?php echo $model_user['nama_user'];?></center>
                                                    
                                    </td>
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



