<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master - Data Pasien</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Pasien</h2>
                <p style="margin: 20px 0px"><a href="<?php echo Yii::app()->createUrl('master/pasien/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Pasien</a></p>
                <table style="margin :10px 0px" id="pasien-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
        $('#pasien-datatable').dataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo Yii::app()->createUrl('master/pasien/readAjax'); ?>",
        });
        $('#pasien-datatable tbody').on('click', '.pasien-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/pasien/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>