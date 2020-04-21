<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Instansi</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Instansi</h2>
                <p style="margin: 20px 0px">
                    <a href="<?php echo Yii::app()->createUrl('master/instansi/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Instansi</a>
                    <a href="<?php echo Yii::app()->createUrl('master/instansi/excel'); ?>" class="btn btn"><i class="icon-download-alt"></i>&nbsp;&nbsp;Download Data</a>
                </p>
                <table style="margin :10px 0px" id="instansi-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th> 
                            <th>Kode</th> 
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Fax</th>
                            <th>Jenis</th> 
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th> 
                            <th>Kode</th> 
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Fax</th>
                            <th>Jenis</th> 
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_instansi as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_instansi'] ?></td>
                                <td><?php echo $d['kode_instansi'] ?></td>
                                <td><?php echo $d['alamat_instansi']."<br>Kota : ".$d['nama_kota'] ?></td>
                                <td><?php echo $d['telephone'] ?></td>
                                <td><?php echo $d['fax'] ?></td>
                                <td><?php echo $d['nama_instansi_jenis'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/instansi/update?id=' . $d['id_instansi']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn instansi-delete-button" title="Delete" id="<?php echo $d['id_instansi'] ?>" ><i class="icon-remove"></i></a>
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
        $('#instansi-datatable').dataTable({
            "lengthChange": true,
        });
        $('#instansi-datatable tbody').on('click', '.instansi-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/instansi/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>
                            