<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Perpanjangan Registrasi Pemakaian Lab</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Registrasi Pemakaian Lab</h2>
                <table style="margin :10px 0px" id="registrasi-pemakaian-lab-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID PFL</th>
                            <th>Surat Permohonan</th>
                            <th>Registrasi</th>
                            <th>Nama Pemohon</th>
                            <th>Status Tim</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                         <tr>
                            <th>ID PFL</th>
                            <th>Surat Permohonan</th>
                            <th>Registrasi</th>
                            <th>Nama Pemohon</th>
                            <th>Status Tim</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_pasien as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['no_registrasi_penyewaan'] ?></td>
                                <td>
                                    <b>Tgl Surat :</b><br/><?php echo $d['tgl_surat_permohonan'] ?><br/>
                                    <b>No Surat :</b><br/><?php echo $d['no_surat_permohonan'] ?>
                                </td>
                                <td>
                                    <b>Tgl Surat Masuk  :</b><br/><?php echo $d['tgl_surat_daftar'] ?><br/>
                                    <b>Tgl Masuk Sistem :</b><br/><?php echo $d['tgl_order_masuk'] ?><br/>
                                    <b>No Registrasi : </b><br/><?php echo $d['no_kwitansi_daftar'] ?>
                                </td>
                                <td><?php echo $d['nama_penanggung_jawab'] ?></td>
                                <td style="text-align: center">
                                   <?php
                                    if($d['status_team_penelitian']==1){
                                        ?>
                                        <span class="btn btn-info">Single</span>
                                        <?php
                                    }else if($d['status_team_penelitian']==2){
                                        ?>
                                        <span class="btn btn-warning">Group</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="width: 50px;text-align: center">
                                    <div>
                                        <a class="btn" title="Perpanjangan Registrasi" href="<?php echo Yii::app()->createUrl('registrasi/pemakaian_lab_perpanjangan/update?reg=' . $d['id_registrasi_penyewaan'].'&no_reg=' . $d['no_registrasi_penyewaan']); ?>" ><i class=" icon-list-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('#registrasi-pemakaian-lab-datatable').dataTable({
            "lengthChange": true,
            "bSort" : false
        });
        $('#dokter-datatable tbody').on('click', '.dokter-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('registrasi/pemakaian-lab_lama/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>