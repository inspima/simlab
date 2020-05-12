<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget" >
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Validasi Hasil Pemeriksaan </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content" style="padding-bottom: 250px">    
                <h2>Data Registrasi Pemeriksaan Pasien</h2>
                <table style="margin :10px 0px" id="registrasi-pemeriksaan-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Registrasi/Order</th>
                            <th>Waktu Order</th>
                            <th>Nama pasien</th>
                            <th>Keluhan Diagnosa</th>
                            <th>Status Pemeriksaan</th>
                            <th>Status Validasi</th>
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
                            <th>Status Validasi</th>
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
        $('#registrasi-pemeriksaan-datatable').dataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo Yii::app()->createUrl('pemeriksaan/validasi_hasil/readAllDataAjax'); ?>", 
            "language": {
                "processing": "Sedang memuat data, mohon tunggu"
            },
        });

    });
</script>