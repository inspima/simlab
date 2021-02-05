<?php
function getData($begin, $end){
    /*
    if($id_unit != '0'){$query_unit = "AND g.id_unit = '$id_unit'";}
      else{$query_unit = " ";}
     * 
     */
      
    $query = "SELECT
	a.id_registrasi_pemeriksaan,	
	b.waktu_registrasi,	
	e.jumlah_sample,
	e.sample,
	c.nama,
        c.alamat,
	c.jenis_kelamin AS kelamin,
        c.umur,
	d.nama_instansi,
        e.nama_kota,
	a.hasil_pengujian
FROM
	pasien_pemeriksaan a
LEFT JOIN registrasi_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
LEFT JOIN pasien c ON b.id_pasien = c.id_pasien
LEFT JOIN instansi d ON d.id_instansi = b.id_instansi
LEFT JOIN kota e ON e.id_kota = d.id_kota_instansi
LEFT JOIN (
	SELECT
		a.id_registrasi_pemeriksaan,
		GROUP_CONCAT(b.nama_sample) AS sample,
		a.jumlah_sample
	FROM
		registrasi_pasien_sample a
	LEFT JOIN sample b ON a.id_sample = b.id_sample
	GROUP BY
		a.id_registrasi_pemeriksaan
) e ON e.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
WHERE
	a.id_pengujian = '583'
AND DATE_FORMAT(b.waktu_registrasi,  '%Y-%m-%d') <=  '$end'
            AND DATE_FORMAT(b.waktu_registrasi,  '%Y-%m-%d') >= '$begin'";
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
                <h4 style="margin: 1px 0px">LAPORAN PASIEN COVID-19</h4>
                Dari : <?php echo $this->TanggalToIndo($awal)." Sampai Tanggal ".$this->TanggalToIndo($akhir); ?> <br />
                 (cetak Lunas dan Belum Lunas)
           </div>
        </div>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <div class="row-fluid" style="margin: 5px 0px;"></div>
     
      
               
                    <table rules="all" cellspacing="0" border="1" width="100%">
                            <thead>
                                <tr>
                                    <td  valign="top"><div align="center"><strong>No</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>ID Registrasi</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Waktu Registrasi</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Sampel</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Nama Pasien</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Alamat</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Gender</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Umur</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Nama Instansi</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Kota</strong></div></td>
                                    <td  valign="top"><div align="center"><strong>Hasil</strong></div></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data_pendapatan = getData($awal, $akhir);
                                      $no = 1;
                                    foreach ($data_pendapatan as $d):
                                    $id_reg = $d['id_registrasi_pemeriksaan'];
                                ?>
                                <tr>
                                    <td><span class="style3"><?php echo $no; ?></span> </td>
                                    <td><span class="style3"><?php echo $d['id_registrasi_pemeriksaan']?> </span> </td>
                                    <td><span class="style3">
                                    <?=$d['waktu_registrasi']?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['sample'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['nama'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['alamat'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['jenis_kelamin'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['umur'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['nama_instansi'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['nama_kota'])?>
                                    </span></td>
                                    <td><span class="style3">
                                    <?=$this->idr($d['hasil_pengujian'])?>
                                    </span></td>
                                </tr>
                                
                                <?php $no++;
                                endforeach; 
                                ?>
                             
                            </tbody>
</table>
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
<style type="css">
    #thead {
  display: table-header-group;
}

#tfoot {
  display0: table-footer-group;
}

</style>
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




