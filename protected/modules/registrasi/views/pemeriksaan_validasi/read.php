<?php 
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Validasi Registrasi Pemeriksaan </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <h2>Data Registrasi Pemeriksaan Pasien</h2>
                <hr/>
                <form method="get" class="form-horizontal" action="">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="firstname">Status Registrasi </label>
                            <div class="controls">
                                <select name="status">
                                    <option value=""  >Semua</option>
                                    <option value="0" <?php if($status=='0') echo 'selected'; ?>>Baru</option>
                                    <option value="1" <?php if($status=='1') echo 'selected'; ?>>Proses</option>
                                    <option value="2" <?php if($status=='2') echo 'selected'; ?>>Sudah Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </fieldset>
                </form>
                <table id="registrasi-pemeriksaan-datatable-ajax" class="display table table-striped table-bordered display responsive no-wrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Registrasi/Order</th>
                            <th>Waktu Order</th>
                            <th>Nama pasien</th>
                            <th>Waktu Selesai</th>
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
                            <th>Waktu Selesai</th>
                            <th>Status Pemeriksaan</th>
                            <th>Status Pembayaran</th>
                            <th>-</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <!-- /widget-content -->
        </div>
        <!-- /widget -->
    </div>
    <!-- /spa12 -->
</div>
<!-- /row -->
<?php 
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('#registrasi-pemeriksaan-datatable-ajax').dataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo Yii::app()->createUrl('registrasi/pemeriksaan_validasi/readDataAjax?'.Yii::app()->request->queryString); ?>",
            "columnDefs": [{
                className: "dt-center",
                "targets": [4]
            }, {
                className: "dt-center",
                "targets": [5]
            }, {
                className: "dt-center",
                "targets": [6]
            }]
        });
    });
</script>