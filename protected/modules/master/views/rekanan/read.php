<?php
include 'breadcumbs.php';

?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Rekanan</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Rekanan</h2>
                <p style="margin: 20px 0px">
                    <a href="<?php echo Yii::app()->createUrl('master/rekanan/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Rekanan</a>
                    <a href="<?php echo Yii::app()->createUrl('master/rekanan/excel'); ?>" class="btn btn"><i class="icon-download-alt"></i>&nbsp;&nbsp;Download Data</a>
                </p>
                <table style="margin :10px 0px" id="rekanan-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th> 
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>No Surat MoU</th>
                            <th>Masa Mou</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>No Surat MoU</th>
                            <th>Masa Mou</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($rekanan as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_rekanan'] ?></td>
                                <td><?php echo $d['alamat_rekanan'] ?></td>
                                <td><?php echo $d['telp'] ?></td>
                                <td><?php echo $d['no_surat_mou'] ?></td>
                                <td><?php echo $this->TanggalToIndo($d['tgl_mou_mulai'])." s/d ".$this->TanggalToIndo($d['tgl_mou_selesai'])."<br>".$this->expired($d['tgl_mou_mulai'],$d['tgl_mou_selesai']); ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/rekanan/view?id=' . $d['id_rekanan']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/rekanan/update?id=' . $d['id_rekanan']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn rekanan-delete-button" title="Delete" id="<?php echo $d['id_rekanan'] ?>" ><i class="icon-remove"></i></a>
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
        $('#rekanan-datatable').dataTable({
            "lengthChange": true,
        });
        $('#rekanan-datatable tbody').on('click', '.rekanan-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/rekanan/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>