<?php
include 'breadcumbs.php';


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
            WHERE DATE_FORMAT(b.waktu_pembayaran, '%Y-%m-%d') <= '$end'
            AND DATE_FORMAT(b.waktu_pembayaran, '%Y-%m-%d') >= '$begin'
            $query_dokter
            $query_instansi
            GROUP BY a.id_registrasi_pemeriksaan
            HAVING (SUM(b.total_dibayar) < AVG(b.total_biaya)- SUM(b.total_dibayar+b.potongan))";
    $data = Yii::app()->db->createCommand($query)->queryAll();
    return $data;
}

?>
<?php //echo $pil_dokter."  --- ".$status_bayar;?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan pendapatan Laboratorium <?php if($pil_instansi !='') {echo '  (Per : '.$this->TanggalToIndo($awal)." - ".$this->TanggalToIndo($akhir).")";} ?></h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
               
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                       <div class="control-group">
                                <label class="control-label" for="unit">LABORATORIUM </label>
                                <div class="controls">
                                <select name="instansi" class="chosen span5" id="instansi" tabindex="2">
                                    <option value="0">ALL INSTANSI</option>
                                    <?php
                                    foreach ($instansi as $data): 
                                        ?>
                                        <option value="<?php echo $data['id_instansi'] ?>" <?php
                                        if ($data['id_instansi'] == $pil_instansi) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $data['nama_instansi'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                    </div><!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                                <label class="control-label" for="unit">DOKTER </label>
                                <div class="controls">
                                <select name="dokter" class="chosen span5" id="dokter" tabindex="2">
                                    <option value="0">ALL DOKTER</option>
                                    <?php
                                    foreach ($data_dokter as $dktr): 
                                        ?>
                                        <option value="<?php echo $dktr['id_dokter'] ?>" <?php
                                        if ($dktr['id_dokter'] == $pil_dokter) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $dktr['nama_dokter'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                           </div><!-- /controls -->
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">
                            <label class="control-label" for="unit">Tanggal </label> 
                            <div class="controls"> 
                                <input type="text" class="span2 datepicker validate[required]" name="awal" value="<?php if($awal == null) {echo date('Y-m-d');} else {echo $awal;}?>">
                                &nbsp; &nbsp; &nbsp; &nbsp; Sampai &nbsp; &nbsp;
                                <input type="text" class="span2 datepicker validate[required]" name="akhir" value="<?php if($akhir == null) {echo date('Y-m-d');} else {echo $akhir;}?>">
                                <button type="submit" class="btn btn-primary">Lihat</button>
                                <?php if($pil_instansi != '') {echo '<a class="btn btn-info" target="_blank" href="'.Yii::app()->createUrl("laporan/pemeriksaan/ctkPiutang?id=$pil_instansi&b=$awal&e=$akhir&d=$pil_dokter&sp=$status_bayar").'"><i class="icon-print"></i>&nbsp;&nbsp;Cetak</a>';} ?> 
                            </div><!-- /controls -->
                        </div> <!-- /control-group -->                       
                                
                          	
                            
                        
                        
                            <table style="margin :10px 0px" id="dokter-datatable" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
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
                                    <td><?=$this->idr($d['total_biaya'])?></td>
                                    <td><?=$this->idr($d['total_dibayar'])?></td>
                                    <td><?=$this->idr($d['piutang'])?></td>
                                    
                                </tr>
                                <?php $no++;
                                 $Jtotal = $Jtotal + $d['total_biaya'];
                                 $Jbayar = $Jbayar + $d['total_dibayar'];
                                 $Jutang = $Jutang + $d['piutang'];   
                                endforeach; 
                                ?>
                                <tr>
                                    <td colspan="4"><center>total</center></td> 
                                    <td><?=$this->idr($Jtotal)?></td>
                                    <td><?=$this->idr($Jbayar)?></td>
                                    <td><?=$this->idr($Jutang)?></td>
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



