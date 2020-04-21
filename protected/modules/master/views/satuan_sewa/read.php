<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Sub Kelompok Pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Sub Kelompok Pengujian</h2>
                <p style="margin: 20px 0px"><a href="<?php echo Yii::app()->createUrl('master/satuan_sewa/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Satuan Sewa</a></p>
                <table style="margin :10px 0px" id="pegawai-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID SATUAN SEWA</th>
                            <th>SATUAN SEWA</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID SATUAN SEWA</th>
                            <th>SATUAN SEWA</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($satuan_sewa as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['id_satuan_sewa'] ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <!--<a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/satuan_sewa/view?id=' . $d['id_satuan_sewa']); ?>" ><i class="icon-search"></i></a>-->
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/satuan_sewa/update?id=' . $d['id_satuan_sewa']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn pegawai-delete-button" title="Delete" id="<?php echo $d['id_satuan_sewa'] ?>" ><i class="icon-remove"></i></a>
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
        $('#pegawai-datatable tbody').on('click', '.pegawai-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/satuan_sewa/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>