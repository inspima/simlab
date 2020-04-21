<?php
include 'breadcumbs.php';



function getData($awal_pel, $akhir_pel){
  
      
    $query = "SELECT a.id_registrasi_pemeriksaan, a.no_registrasi, a.waktu_registrasi, c.nama, b.waktu_pembayaran,
              b.total_dibayar, (b.total_biaya - b.potongan) AS total_biaya,
              d.nama_instansi, e.nama_dokter, a.id_pasien
            FROM registrasi_pemeriksaan a
            LEFT JOIN pembayaran_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
            LEFT JOIN pasien c ON a.id_pasien = c.id_pasien
            LEFT JOIN instansi d ON a.id_instansi = d.id_instansi
            LEFT JOIN dokter e ON a.id_dokter_pengirim = e.id_dokter
            WHERE DATE_FORMAT(b.waktu_pembayaran, '%Y-%m-%d') >= '$awal_pel' 
            AND DATE_FORMAT(b.waktu_pembayaran, '%Y-%m-%d') <= '$akhir_pel'
						AND b.total_dibayar > 0
            ORDER BY b.waktu_pembayaran";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

function getPengujian($id_reg){
    $query = "SELECT c.nama_pengujian
            FROM pasien_pemeriksaan a
            LEFT JOIN registrasi_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
            LEFT JOIN pengujian c ON a.id_pengujian = c.id_pengujian
            WHERE a.id_registrasi_pemeriksaan = '$id_reg'";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}


?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan Pelunasan <?php  if($pil == 2) {echo '  (Per : '.$this->TanggalToIndo($awal_pel)." - ".$this->TanggalToIndo($akhir_pel).")";} ?></h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
               
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>
                    <!--
                       <div class="control-group">											
                            <label class="control-label" for="unit">LABORATORIUM </label>
                            <div class="controls">
                                <select name="unit" class="" id="unit" tabindex="2">
                                    <option value="0">ALL Laboratorium</option>
                                    <?php
                                    /*
                                    foreach ($unit as $data): 
                                        ?>
                                        <option value="<?php echo $data['id_unit'] ?>" <?php
                                        if ($data['id_unit'] == $pil_unit) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $data['nama_unit'] ?></option>
                                        <?php
                                    endforeach;
                                     * 
                                     */
                                    ?>
                                </select>
                        -->        
                           
                                <!--Tanggal Mulai (Order) : <input type="text" class="span2 datepicker validate[required]" name="awal" value="<?php if($awal == null) {echo date('Y-m-d');} else {echo $awal;}?>">
                                Sampai (Order): <input type="text" class="span2 datepicker validate[required]" name="akhir" value="<?php if($akhir == null) {echo date('Y-m-d');} else {echo $akhir;}?>">
                                <br>-->
                                Tanggal Pelunasan : <input type="text" class="span2 datepicker validate[required]" name="awal_pel" value="<?php if($awal_pel == null) {echo date('Y-m-d');} else {echo $awal_pel;}?>">
                                Sampai (Pelunasan): <input type="text" class="span2 datepicker validate[required]" name="akhir_pel" value="<?php if($akhir_pel == null) {echo date('Y-m-d');} else {echo $akhir_pel;}?>">
                                <button type="submit" class="btn btn-primary">Lihat</button>
                                <?php  {echo '<a class="btn btn-info" target="_blank" href="'.Yii::app()->createUrl("laporan/pemeriksaan/ctkPel_piutang?p=$awal_pel--$akhir_pel").'"><i class="icon-print"></i>&nbsp;&nbsp;Cetak</a>';} ?> 
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                            <table style="margin :10px 0px" id="dokter-datatable" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td  valign="top">No</td>
                                    <td  valign="top">Nota Order</td>
                                    <td  valign="top">Tgl Daftar</td>
                                    <td  valign="top">Tgl Pelunasan</td>
                                    <td  valign="top">Nama Pasien</td>
                                    <td  valign="top">Dibayar</td>
                                    <td  valign="top"><div align="center">Total Biaya</div></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data_pendapatan = getData($awal_pel, $akhir_pel);
                                      $no = 1;
                                      $Jtotal = 0;
                                      $Jbayar = 0;
                                      //$Jutang = 0;
                                      $Jpelunasan = 0;
                                    foreach ($data_pendapatan as $d):
                                    $id_reg = $d['id_registrasi_pemeriksaan'];
                                ?>
                                <tr>
                                    <td><?php echo $no; ?> </td>
                                    <td><?php echo $d['no_registrasi']."<br>";
                                              $pengujian = getPengujian($id_reg);
                                              foreach ($pengujian as $dp) :
                                                  echo "- ".$dp['nama_pengujian']."<br>";
                                              endforeach;
                                            ?>
                                    </td>
                                    <td valign="top" ><?php echo $d['waktu_registrasi']."<br>";
                                              echo '<b><u>instansi pengirim : '.$d['nama_instansi']."<br> dokter pengirim :".$d['nama_dokter'];
                                        ?>
                                    </td>
                                    <td><?=$this->TanggalToIndo($d['waktu_pembayaran'])?></td>
                                    <td><?=$d['nama']?></td>
                                    <td><?=number_format($d['total_dibayar'],0,',','.')?></td>
                                    <td><?=number_format($d['total_biaya'],0,',','.')?></td>
                                </tr>
                                <?php $no++;
                                $Jtotal = $Jtotal + $d['total_biaya'];
                                 $Jbayar = $Jbayar + $d['total_dibayar'];
                                endforeach; 
                                ?>
                                <tr>
                                    <td colspan="5"><center>total</center></td>
                                    <td><?=$this->idr($Jbayar)?></td>
                                    <td><?=$this->idr($Jtotal)?></td>
                                     
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



