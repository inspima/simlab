<?php
    include 'breadcumbs.php';
?>
<style>
    .form-horizontal .control-label {
        font-weight: bold;
        padding-top: 0px;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Form Input Excel - Hasil Pasien Pemeriksaan</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::app()->user->hasFlash('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php endif; ?>
                <p style="margin: 5px">
                    <a class="btn btn" href="<?php echo Yii::app()->createUrl('pemeriksaan/input_hasil/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a>
                </p>
                <hr style="border-top: 1px dotted grey;"/>
                <div class="controls">

                    <div class="accordion" id="accordion">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" style="font-size: 1.3em" data-parent="#accordion" href="#collapseOne">
                                    Mohon dipahami aturan dalam proses upload file agar
                                </a>
                            </div>
                            <div id="collapseOne" class="accordion-body in" style="height: auto;">
                                <div class="accordion-inner">
                                    <ol>
                                        <li>Download template pada link yang disediakan</li>
                                        <li>Silahkan isi kolom hasil dan keterangan (<b style="color: red">Mohon tidak mengubah/menghapus struktur dan urutan kolom</b>)</li>
                                        <li><b style="color: blue">Kosongi kolom hasil dan keterangan jika pasien tersebut memang belum dilakukan pemeriksaan</b></li>
                                        <li><b>Save As</b> file</li>
                                        <li><b>Ubah file ke dalam format Excel 2003 (xls) seperti pada gambar dibawah ini</b><br/>
                                            <img width="400" src="<?php echo Yii::app()->baseUrl; ?>/img/tutorial/file-format-error-2.png">
                                        </li>
                                        <li>Upload ulang file yang di save</li>
                                        <li>Selesai</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 1px dotted grey;"/>
                <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="template">Template</label>
                            <div class="controls">
                                <a target="_blank" href="<?php echo Yii::app()->createUrl('pemeriksaan/input_hasil/template_excel?id_unit=' . $id_unit); ?>" class="btn btn-success">Download File</a>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label" for="file">Upload File</label>
                            <div class="controls">
                                <input type="file" class="form-control" required name="exel_input">
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->

                        <div class="form-actions">
                            <input type="hidden" name="mode" value="pasien_pemeriksaan"/>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </form>

            </div> <!-- /widget-content -->
        </div> <!-- /widget -->
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
    include 'plugins.php';
?>
<script>
    $(document).ready(function () {
        $('table.datatable').dataTable({
            "lengthChange": true,
        });
        $('.tgl_selesai, .tgl_pengujian').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>