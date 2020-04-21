<?php
include 'breadcumbs.php';


foreach ($pegawai as $peg):
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>View Data Pegawai</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Pegawai</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pegawai/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                            <a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pegawai/update?id=' . $peg['id_pegawai']); ?>">Edit&nbsp;&nbsp;<i class="icon-chevron-right"></i></a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; 
                
                ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Nama</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_pegawai'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="g_depan"><b>Gelar Depan</b></label>
                            <div class="controls">
                                <?php echo $peg['gelar_depan'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="g_belakang"><b>Gelar Belakang</b></label>
                            <div class="controls">
                                <?php echo $peg['gelar_belakang'] ?>
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir"><b>Tempat, Tanggal Lahir</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_kota'].', '.$this->TanggalToIndo($peg['tgl_lahir']) ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama"><b>Agama</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_agama'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat"><b>Alamat</b></label>
                            <div class="controls">
                                <?php echo $peg['alamat'] ?>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="alamat"><b>Telp</b></label>
                            <div class="controls">
                                <?php echo $peg['telephone'] ?>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                          <div class="control-group">											
                            <label class="control-label" for="alamat"><b>HP</b></label>
                            <div class="controls">
                                <?php echo $peg['hp'] ?>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->


                        <br />
                        <!--
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php // echo Yii::app()->createUrl('master/pegawai/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
                        
                             <?php
                        endforeach;
                        ?>
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