<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Fasilitas</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Fasilitas</h2>
                <p style="margin: 20px 0px">
                    <a href="<?php echo Yii::app()->createUrl('master/bahan_uji/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Data</a>
                    <a href="<?php echo Yii::app()->createUrl('master/bahan_uji/excel'); ?>" class="btn btn"><i class="icon-download-alt"></i>&nbsp;&nbsp;Download Data</a>
                </p>
                <table style="margin :10px 0px" id="pegawai-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Bahan</th>
                            <th>Jenis Bahan</th>
                            <th>Nama Bahan</th>
                            <th>Harga Bahan</th>
                            <th>Keterangan</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Bahan</th>
                            <th>Jenis Bahan</th>
                            <th>Nama Bahan</th>
                            <th>Harga Bahan</th>
                            <th>Keterangan</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($bp as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_bahan'] ?></td>
                                <td><?php echo $d['nama_bahan_jenis'] ?></td>
                                <td><?php echo $d['nama_bahan'] ?></td>
                                <td><?php echo $this->idr($d['harga_bahan']) ?></td>
                                <td><?php echo $d['keterangan_bahan'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/bahan_uji/view?id=' . $d['id_bahan_pengujian']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/bahan_uji/update?id=' . $d['id_bahan_pengujian']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn pegawai-delete-button" title="Delete" id="<?php echo $d['id_bahan_pengujian'] ?>" ><i class="icon-remove"></i></a>
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
                    url: '<?php echo Yii::app()->createUrl('master/bahan_uji/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>