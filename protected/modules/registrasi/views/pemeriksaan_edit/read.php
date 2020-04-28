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
                <table style="margin :10px 0px" id="registrasi-pemeriksaan-datatable-ajax" class="display table table-striped table-bordered" cellspacing="0" width="100%">
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
        $('#registrasi-pemeriksaan-datatable-ajax').dataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo Yii::app()->createUrl('registrasi/pemeriksaan_edit/readDataAjax'); ?>",
            "language": {
                "processing": "Sedang memuat data, mohon tunggu"
            },
        });
        $('#registrasi-pemeriksaan-datatable-ajax tbody').on('click', '.registrasi-pemeriksaan-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('registrasi/pemeriksaan_edit/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>