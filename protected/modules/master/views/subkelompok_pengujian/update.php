<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Sub Kelompok</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Sub Kelompok Pengujian</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/subkelompok_pengujian/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="kode">KODE</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="kode" value="<?php echo $subkelompok_pengujian['kode_subkelompok'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                       
                        <div class="control-group">											
                            <label class="control-label" for="kelompok">KELOMPOK</label>
                            <div class="controls">
                                <select name="kelompok" class="chosen span5" id="kelompok" data-placeholder="Pilih Kelompok..." tabindex="2">
                                    <?php
                                    foreach ($data_kelompok_pengujian as $d):
                                        ?>
                                        <option value="<?php echo $d['id_pengujian_kelompok'] ?>" <?php
                                        if ($subkelompok_pengujian['id_pengujian_kelompok'] == $d['id_pengujian_kelompok']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_kelompok_pengujian'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        

                        <div class="control-group">											
                            <label class="control-label" for="sub_kelompok">SUB-KELOMPOK</label>
                            <div class="controls">
                                <input type="text" class="span3" name="sub_kelompok" value="<?php echo $subkelompok_pengujian['nama_subkelompok'] ?>">
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                        
                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/pegawai/read'); ?>">Cancel</a>
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