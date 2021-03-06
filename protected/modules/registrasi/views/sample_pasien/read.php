<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Data Registrasi Pemeriksaan </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Registrasi Pemeriksaan Pasien</h2>
                <table style="margin :10px 0px" id="dokter-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Registrasi/Order</th>
                            <th>Waktu Order</th>
                            <th>Nama pasien</th>
                            <th>Keluhan Diagnosa</th>
                            <th>Status Pemeriksaan</th>
                            <th>Status Pembayaran</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Registrasi/Order</th>
                            <th>Waktu Order</th>
                            <th>Nama pasien</th>
                            <th>Keluhan Diagnosa</th>
                            <th>Status Pemeriksaan</th>
                            <th>Status Pembayaran</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_pasien as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['no_registrasi'] ?></td>
                                <td><?php echo $d['waktu_registrasi'] ?></td>
                                <td>
                                    <?php echo $d['nama'] ?><br/>
                                    <b>Instansi : </b><?php echo $d['nama_instansi'] ?>
                                </td>
                                <td><?php echo $d['keluhan_diagnosa'] ?></td>
                                <td style="text-align: center">
                                    <?php
                                    if ($d['status_registrasi'] == 0) {
                                        ?>
                                        <span class="btn btn-info">Baru</span>
                                        <?php
                                    } else if ($d['status_registrasi'] == 1) {
                                        ?>
                                        <span class="btn btn-warning">Proses Pengujian</span>
                                        <?php
                                    } else if ($d['status_registrasi'] == 2) {
                                        ?>
                                        <span class="btn btn-success">Sudah Selesai</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?php
                                    if ($d['status_pembayaran'] == 0) {
                                        ?>
                                        <span class="btn btn-danger">Belum Ada Pembayaran</span>
                                        <?php
                                    } else if ($d['status_pembayaran'] == 1) {
                                        ?>
                                        <span class="btn btn-success">Lunas</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="width: 50px;text-align: center">
                                    <div>
                                        <a class="btn" title="Lihat Sample" href="<?php echo Yii::app()->createUrl('registrasi/sample_pasien/create?reg=' . $d['id_registrasi_pemeriksaan']); ?>" ><i class=" icon-list-alt"></i></a>
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
        $('#dokter-datatable').dataTable({
            "lengthChange": true,
        });
        $('#dokter-datatable tbody').on('click', '.dokter-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('registrasi/pemeriksaan_lama/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>