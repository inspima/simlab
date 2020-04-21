<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Divisi</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Divisi</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/divisi/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="id">KODE DIVISI</label>
                            <div class="controls">
                                <input type="text" class="span3 validate[required]" name="id" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                       
                        <div class="control-group">											
                            <label class="control-label" for="unit">UNIT</label>
                            <div class="controls">
                                <select name="unit" class="chosen span3" id="unit" data-placeholder="Pilih Kelompok..." tabindex="2">
                                    <?php
                                    foreach ($data_unit as $d):
                                        ?>
                                        <option value="<?php echo $d['id_unit'] ?>"><?php echo $d['nama_unit'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        

                        <div class="control-group">											
                            <label class="control-label" for="divisi">DIVISI</label>
                            <div class="controls">
                                <input type="text" class="span6" name="divisi" value="">
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                        
                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/divisi/read'); ?>">Cancel</a>
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