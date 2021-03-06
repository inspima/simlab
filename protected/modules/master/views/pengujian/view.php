<?php
include 'breadcumbs.php';

foreach ($data_uji as $d):
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>View Data Unit</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Unit</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pengujian/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                            <a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pengujian/update?id=' . $d['id_pengujian']); ?>">Edit&nbsp;&nbsp;<i class="icon-chevron-right"></i></a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; 
                
                ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Kode</b></label>
                            <div class="controls">
                                <?php echo $d['kode_pengujian'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat"><b>Nama Pengujian</b></label>
                            <div class="controls">
                                <?php echo $d['nama_pengujian'] ?>
                            </div> <!-- /controls -->	
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="alamat"><b>Nilai Normal</b></label>
                            <div class="controls">
                                <?php echo nl2br($d['nilai_normal']); ?>
                            </div> <!-- /controls -->	
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Kelompok Pengujian</b></label>
                            <div class="controls">
                                <?php echo $d['nama_pengujian_kelompok'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Group Pengujian</b></label>
                            <div class="controls">
                                <?php echo $d['grup'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Unit</b></label>
                            <div class="controls">
                                <?php echo $d['nama_unit'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Divisi</b></label>
                            <div class="controls">
                                <?php echo $d['nama_divisi'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Tarif Pengujian</b></label>
                            <div class="controls">
                                <?php echo $this->idr($d['tarif_pengujian']) ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Tarif Konsul</b></label>
                            <div class="controls">
                                <?php echo $this->idr($d['tarif_konsul']) ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        
                        


                        <br />
                        <!--
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php // echo Yii::app()->createUrl('master/pegawai/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
                    
                    </fieldset>
                </form>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
endforeach;
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('table.datatable').dataTable({
            "lengthChange": true
        });
    });
</script>