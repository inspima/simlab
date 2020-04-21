<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Registrasi Pemeriksaan Lama </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Pasien</h2>
                <table style="margin :10px 0px" id="dokter-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>TTL, Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Telephone, HP</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>TTL, Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Telephone, HP</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_pasien as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['jenis_kelamin'] == 1 ? "Laki-laki" : "Perempuan" ?></td>
                                <td><?php echo $d['nama_agama'] ?></td>
                                <td><?php echo $d['alamat'] ?></td>
                                <td><?php echo $d['telephone'] ?>, <?php echo $d['hp'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="Registrasi" href="<?php echo Yii::app()->createUrl('registrasi/pemeriksaan_lama/create?pasien=' . $d['id_pasien']); ?>" ><i class=" icon-list-alt"></i></a>
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