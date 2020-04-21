<?php
include 'breadcumbs.php';


foreach ($subkelompok_pengujian as $data):
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>View Data Sub-Kelompok Pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Sub-Kelompok Pengujian</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/subkelompok_pengujian/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                            <a class="btn btn" href="<?php echo Yii::app()->createUrl('master/subkelompok_pengujian/update?id=' . $data['id_pengujian_subkelompok']); ?>">Edit&nbsp;&nbsp;<i class="icon-chevron-right"></i></a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; 
                
                ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="g_depan"><b>KODE </b></label>
                            <div class="controls">
                                <?php echo $data['kode_subkelompok'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="g_belakang"><b>KELOMPOK </b></label>
                            <div class="controls">
                                <?php echo $data['nama_kelompok_pengujian'] ?>
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>SUB KELOMPOK</b></label>
                            <div class="controls">
                                <?php echo $data['nama_subkelompok'] ?>
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