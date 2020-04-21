<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>View Data Dokter</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Dokter</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/dokter/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Nama</b></label>
                            <div class="controls">
                                <?php echo $dokter['nama_dokter'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="g_depan"><b>Gelar Depan</b></label>
                            <div class="controls">
                                <?php echo $dokter['gelar_depan'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="g_belakang"><b>Gelar Belakang</b></label>
                            <div class="controls">
                                <?php echo $dokter['gelar_belakang'] ?>
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label"><b>Jenis Kelamin</b></label>
                            <div class="controls">
                                <?php
                                if ($dokter['jenis_kelamin'] == 1) {
                                    echo "Laki-Laki";
                                }
                                ?> 

                                <?php
                                if ($dokter['jenis_kelamin'] == 2) {
                                    echo "Perempuan";
                                }
                                ?> 
                            </div>	<!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir"><b>Tanggal Lahir</b></label>
                            <div class="controls">
                                <?php echo $this->TanggalToIndo($dokter['tgl_lahir']) ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama"><b>Agama</b></label>
                            <div class="controls">
                                <?php
                                foreach ($data_agama as $d):

                                    if ($dokter['id_agama'] == $d['id_agama']) {
                                        echo $d['nama_agama'];
                                    }
                                    ?>
                                    <?php
                                endforeach;
                                ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div id="kota_loading"></div>

                        <div class="control-group">											
                            <label class="control-label" for="kota"><b>Kota</b></label>
                            <div class="controls">
                                <?php
                                foreach ($data_kota as $d):
                                    if ($dokter['id_kota_lahir'] == $d['id_kota']) {
                                        echo $d['nama_kota'];
                                    }
                                endforeach;
                                ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->



                        <div class="control-group">											
                            <label class="control-label" for="alamat"><b>Alamat</b></label>
                            <div class="controls">
                                <?php echo $dokter['alamat'] ?>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="instansi"><b>Instansi Dokter</b></label>
                            <div class="controls">
                                <?php
                                foreach ($data_instansi as $d):

                                    if ($dokter['id_instansi'] == $d['id_instansi']) {
                                        echo $d['nama_instansi'];
                                    }
                                endforeach;
                                ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/dokter/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </form>
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