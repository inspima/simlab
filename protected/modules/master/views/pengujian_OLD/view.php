<?php
include 'breadcumbs.php';


foreach ($data_pengujian as $peg):
?>


<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>View Data pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data pengujian</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pengujian/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                            <a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pengujian/update?id=' . $peg['id_pengujian']); ?>">Edit&nbsp;&nbsp;<i class="icon-chevron-right"></i></a></p>
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
                                <?php echo $peg['kode_pengujian'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                            <label class="control-label" for="nama"><b>Nama Pengujian</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_pengujian'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                            <label class="control-label" for="nama"><b>Kelompok Pengujian</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_kelompok_pengujian'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Sub Kelompok</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_subkelompok'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>UNIT</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_unit'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="nama"><b>N Normal</b></label>
                            <div class="controls">
                                <?php echo $peg['nilai_normal'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Tarif Pengujian</b></label>
                            <div class="controls">
                                <?php echo $peg['tarif_pengujian'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Tarif Konsul</b></label>
                            <div class="controls">
                                <?php echo $peg['tarif_konsul'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <br />
                        <!--
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php // echo Yii::app()->createUrl('master/pengujian/read'); ?>">Cancel</a>
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