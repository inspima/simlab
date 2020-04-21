<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Tambah Data User Sistem</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data User</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('setting/user_template/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label">Nama Pegawai</label>
                            <div class="controls">
                                <b><?php echo $personil['nama_pegawai'] ?></b>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Jabatan</label>
                            <div class="controls">
                                <b><?php echo  $personil['nama_jabatan'] ?></b>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Unit</label>
                            <div class="controls">
                                <b></b>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Username Sistem</label>
                            <div class="controls">
                                <b><?php echo  $personil['username'] ?></b>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Nama User Sistem</label>
                            <div class="controls">
                                <b><?php echo  $personil['nama_user'] ?></b>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                    </fieldset>
                </form>
                <h2>Form Template</h2>
                <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                    <fieldset>
                        <div class="control-group">											
                            <label class="control-label" for="template">Nama Template</label>
                            <div class="controls">
                                <select name="template" class="chosen span5" data-placeholder="Pilih Template..." tabindex="2">
                                    <?php
                                    foreach ($data_template as $d):
                                        ?>
                                        <option value="<?php echo $d['id_template'] ?>" ><?php echo $d['nama_template'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="form-actions">
                            <input type="hidden" name="mode" value="tambah_template"/>
                            <input type="hidden" name="id_user" value="<?php echo $personil['id_user'] ?>"/>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </form>
                <h2>Data Pembayaran</h2>
                <table id="pembayaran-pemeriksaan-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Template</th>
                            <th style="text-align: center">Status AKtif</th>
                            <th style="text-align: center">-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_template_user as $d) {
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $d['nama_template'] ?></td>
                                <td style="text-align: center">
                                    <?php
                                    if ($d['status_aktif'] == '1') {
                                        ?>
                                        <span class="btn btn-success">Ya</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="btn btn-danger">Tidak</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <form method="post" style="display: inline">
                                        <button class="btn" title="Hapus Template"><i class="icon-remove"></i></button>
                                        <input type="hidden" name="mode" value="delete_template"/>
                                        <input type="hidden" name="id_template_user" value="<?php echo $d['id_template_user'] ?>"/>
                                    </form>
                                    <form method="post" style="display: inline">
                                        <button class="btn"><i class="icon-ok"></i></button>
                                        <input type="hidden" name="mode" value="aktif_template"/>
                                        <input type="hidden" name="id_template_user" value="<?php echo $d['id_template_user'] ?>"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('table.datatable').dataTable({
            "lengthChange": true
        });
    });
</script>