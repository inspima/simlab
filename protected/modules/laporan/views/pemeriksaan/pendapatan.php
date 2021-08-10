<?php
include 'breadcumbs.php';



function getData($id_unit, $begin, $end){
    if($id_unit != '') 
          {$q_unit = " AND d.id_unit = '$id_unit' ";}
    else {$q_unit = " ";}
    $query = "SELECT
	d.nama_pengujian, pp.status_pembayaran, c.no_registrasi, pp.total_dibayar,
	f.nama_sample,
	g.nama_instansi,
	h.nama_unit,
	SUM(b.potongan/pps.jumlah_sample_pp) AS potongan,
	b.besar_tarif,
	SUM(e.jumlah_sample) AS JML_SAMPLE,
	(
		SUM(e.jumlah_sample) * b.besar_tarif
	) AS JMLH,
	SUM(

		IF (
			c.id_pasien_tipe = '7',
			e.jumlah_sample,
			NULL
		)
	) AS DIAGNOSTIC,
	SUM(

		IF (
			c.id_pasien_tipe = '8',
			e.jumlah_sample,
			NULL
		)
	) AS PENELITIAN
FROM
	pemeriksaan_sample ps
LEFT JOIN pasien_pemeriksaan b ON ps.id_pasien_pemeriksaan = b.id_pasien_pemeriksaan
LEFT JOIN (
	select pp.id_pasien_pemeriksaan,count(ps.id_pemeriksaan_sample) jumlah_sample_pp
	from pasien_pemeriksaan pp
	join pemeriksaan_sample ps on pp.id_pasien_pemeriksaan=ps.id_pasien_pemeriksaan
	group by id_pasien_pemeriksaan
) pps on pps.id_pasien_pemeriksaan=b.id_pasien_pemeriksaan
LEFT JOIN pembayaran_pemeriksaan pp ON pp.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
LEFT JOIN registrasi_pemeriksaan c ON b.id_registrasi_pemeriksaan = c.id_registrasi_pemeriksaan
LEFT JOIN registrasi_pasien_sample e ON ps.id_registrasi_pasien_sample = e.id_registrasi_pasien_sample
LEFT JOIN pengujian d ON b.id_pengujian = d.id_pengujian
LEFT JOIN sample f ON e.id_sample = f.id_sample
LEFT JOIN instansi g ON c.id_instansi = g.id_instansi
LEFT JOIN unit h ON d.id_unit = h.id_unit
WHERE
	DATE_FORMAT(
		pp.waktu_pembayaran,
		'%Y-%m-%d'
	) >= '$begin'
AND DATE_FORMAT(
	pp.waktu_pembayaran,
	'%Y-%m-%d'
) <= '$end'
". $q_unit ."
GROUP BY
	d.nama_pengujian, 
	pp.status_pembayaran,
	c.no_registrasi,
	pp.total_dibayar,
	pp.waktu_pembayaran,
	f.nama_sample,
	g.nama_instansi,
	h.nama_unit,
	b.besar_tarif
ORDER BY
	pp.waktu_pembayaran";
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
LEFT JOIN pembayaran_pemeriksaan f ON a.id_registrasi_pemeriksaan = f.id_registrasi_pemeriksaan
WHERE DATE_FORMAT(f.waktu_pembayaran, '%Y-%m-%d') >= '$begin'
AND DATE_FORMAT(f.waktu_pembayaran, '%Y-%m-%d') <= '$end'".$q_unit;
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    //echo $query;
    return $data;
}

function getBiayaTambahan($id_unit, $begin, $end){
    if($id_unit != '') 
          {$q_unit = " AND e.id_unit = '$id_unit' ";}
    else {$q_unit = " ";}
    $query = "SELECT SUM(a.besar_biaya)
                FROM pemeriksaan_biaya_tambahan a 
                LEFT JOIN pembayaran_pemeriksaan c ON a.id_registrasi_pemeriksaan = c.id_registrasi_pemeriksaan
                LEFT JOIN pasien_pemeriksaan d ON a.id_registrasi_pemeriksaan = d.id_registrasi_pemeriksaan
                LEFT JOIN pengujian e ON d.id_pengujian = e.id_pengujian
                WHERE DATE_FORMAT(c.waktu_pembayaran, '%Y-%m-%d') >= '$begin' 
                AND DATE_FORMAT(c.waktu_pembayaran, '%Y-%m-%d') <= '$end'".$q_unit;
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}

function getPiutang($id_unit, $begin, $end) {
    if($id_unit != '') 
          {$q_unit = " AND c.id_unit = '$id_unit' ";}
    else {$q_unit = " ";}
    $query = "SELECT  SUM(a.total_biaya) -  Sum(a.total_dibayar) AS piutang
                FROM pembayaran_pemeriksaan a
		LEFT JOIN 
			(SELECT pp.id_registrasi_pemeriksaan, GROUP_CONCAT(pp.id_pengujian) as id_pengujian
			FROM pasien_pemeriksaan pp 
			LEFT JOIN pembayaran_pemeriksaan ppe ON pp.id_registrasi_pemeriksaan = ppe.id_registrasi_pemeriksaan 
			GROUP BY pp.id_registrasi_pemeriksaan) b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
		LEFT JOIN pengujian c ON b.id_pengujian = c.id_pengujian
                WHERE DATE_FORMAT(a.waktu_pembayaran, '%Y-%m-%d') >= '$begin'
                AND DATE_FORMAT(a.waktu_pembayaran, '%Y-%m-%d') <= '$end'
                ".$q_unit;
    $data = Yii::app()->db->createCommand($query)->queryScalar();
    return $data;
}
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan pendapatan <?php if($pil_unit !='') {echo 'Laboratorium '.$nama_unit['nama_unit']." (Per : ".$this->TanggalToIndo($awal)." - ".$this->TanggalToIndo($akhir).")";} ?></h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
               
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                       <div class="control-group">											
                            <label class="control-label" for="unit">LABORATORIUM </label>
                            <div class="controls">
                                <select name="unit" class="" id="unit" tabindex="2">
                                    <option value="" <?php
                                        if ($pil_unit == "") {
                                            echo "selected";
                                        }?>>ALL UNIT</option>
                                    <?php
                                    foreach ($unit as $data): 
                                        ?>
                                        <option value="<?php echo $data['id_unit'] ?>" <?php
                                        if ($data['id_unit'] == $pil_unit) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $data['nama_unit'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                           
                                Tanggal : <input type="text" class="span2 datepicker validate[required]" name="awal" value="<?php if($awal == null) {echo date('Y-m-d');} else {echo $awal;}?>">
                                Sampai: <input type="text" class="span2 datepicker validate[required]" name="akhir" value="<?php if($akhir == null) {echo date('Y-m-d');} else {echo $akhir;}?>">
                                <button type="submit" class="btn btn-primary">Lihat</button>
                                <?php if(isset($pil_unit)) {echo '<a class="btn btn-info"  href="'.Yii::app()->createUrl("laporan/pemeriksaan/excelPendapatan?id=$pil_unit&b=$awal&e=$akhir").'"><i class="icon-arrow-down"></i>&nbsp;&nbsp;Excel</a>';} ?> 
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                            <table style="margin :10px 0px" id="dokter-datatable" class="table table-bordered" cellspacing="0" width="100%">
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
                                      $biaya_tambahan = getBiayaTambahan($pil_unit, $awal, $akhir);
                                      $piutang = getPiutang($pil_unit, $awal, $akhir);
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
                                    <td><?=$d['nama_pengujian']."<br /><i>[".$d['no_registrasi']."]</i>"?><?php if($pil_unit == "") {echo "<br> [".$d['nama_unit']."]";} ?></td>
                                    <td><?=$d['nama_sample']?></td>
                                    <td><?=$d['nama_instansi']?></td>
                                    <td><?=$d['besar_tarif']?></td>
                                    <td><?=$d['JML_SAMPLE']?></td>
                                    <td><?php //if($d['id_pasien_tipe'] == '7'){$p_diagnostik = $d['JMLH']; echo $this->idr($p_diagnostik); } else{$p_diagnostik = 0; echo ' - ';} 
                                           $np=$d['DIAGNOSTIC']; echo $np." (".$p_diagnostik=$np*$d['besar_tarif'].") ";?></td>
                                    <td><?php //if($d['id_pasien_tipe'] == '8'){$p_penelitian = $d['JMLH']; echo $this->idr($p_penelitian);} else{$p_penelitian = 0; echo ' - ';}
                                             $nd=$d['PENELITIAN']; echo $nd." (".$p_penelitian=$nd*$d['besar_tarif'].") ";?></td>
                                    <td><b><?=$this->idr($d['potongan'])?></td>
                                    <td><?=$this->idr($d['JMLH'] - $d['potongan']);//"<br /> lunas: ".$d['status_pembayaran']?></td>
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
                                    <td colspan="9" align="center">Piutang</td>
                                    <td><?=$this->idr($piutang)?></td>
                                </tr>
                                <tr>
                                    <td colspan="9" align="center" bgcolor="#F5ECCE"><center><b>Jumlah Kotor Pendapatan (per Lab.)</b></center></td>
                                    <td><?php echo "<b>".$this->idr($jumlah + $bahan_uji + $biaya_tambahan - $piutang)."</b>"?></td>
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

