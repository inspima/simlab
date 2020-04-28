<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Edit Registrasi Pemakaian Lab</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Registrasi Pemakaian Lab</h2>
                <table style="margin :10px 0px" id="registrasi-pemakaian-lab-datatable-ajax" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID PFL</th>
                            <th>Surat Permohonan</th>
                            <th>Registrasi</th>
                            <th>Nama Pemohon</th>
                            <th>Status Pemakaian</th>
                            <th>Status Tim</th>
                            <th>Jenis Biaya</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                         <tr>
                            <th>ID PFL</th>
                            <th>Surat Permohonan</th>
                            <th>Registrasi</th>
                            <th>Nama Pemohon</th>
                            <th>Status Pemakaian</th>
                            <th>Status Tim</th>
                            <th>Jenis Biaya</th>
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
        $('#registrasi-pemakaian-lab-datatable-ajax').dataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo Yii::app()->createUrl('registrasi/pemakaian_lab_edit/readDataAjax'); ?>",
            "language": {
                "processing": "Sedang memuat data, mohon tunggu"
            },
        });
        $('#registrasi-pemakaian-lab-datatable-ajax tbody').on('click', '.registrasi-penyewaan-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('registrasi/pemakaian_lab_edit/delete'); ?>',
                    data: 'no=' + $(this).attr('no'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>