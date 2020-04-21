<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Kelompok Pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Kelompok Pengujian</h2>
                <p style="margin: 20px 0px">
                    <a href="<?php echo Yii::app()->createUrl('master/kelompok_pengujian/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Kelompok Pengujian</a>
                    <a href="<?php echo Yii::app()->createUrl('master/kelompok_pengujian/excel'); ?>" class="btn btn"><i class="icon-download-alt"></i>&nbsp;&nbsp;Download Data</a>
                </p>
                <table style="margin :10px 0px" id="pegawai-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Kelompok Pengujian</th>
                            <th>Kelompok Pengujian</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                           <th>Kode Kelompok Pengujian</th>
                           <th>Kelompok Pengujian</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($kel_pengujian as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_kelompok'] ?></td>
                                <td><?php echo $d['nama_pengujian_kelompok'] ?></td>

                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/kelompok_pengujian/view?id=' . $d['id_pengujian_kelompok']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/kelompok_pengujian/update?id=' . $d['id_pengujian_kelompok']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn kelompok-delete-button" title="Delete" id="<?php echo $d['id_pengujian_kelompok'] ?>" ><i class="icon-remove"></i></a>
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
        $('#pegawai-datatable').dataTable({
            "lengthChange": true,
        });
        $('#pegawai-datatable tbody').on('click', '.kelompok-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/kelompok_pengujian/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>