<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Tambah Data Menu</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Menu</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('setting/menu/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation" method="post" style="width: 90%">
                    <fieldset>
                        
                        <div class="control-group">											
                            <label class="control-label" for="parent">Parent Menu</label>
                            <div class="controls">
                                <select name="parent" class="chosen span5" data-placeholder="Pilih Parent..." tabindex="2">
                                    <option value="">Kosong</option>
                                    <?php
                                    foreach ($data_parent_menu as $d):
                                        ?>
                                        <option value="<?php echo $d['id_menu'] ?>"><?php echo $d['label'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="label">Label Menu</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="label" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="url">Url Menu</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="url" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="order">Order Menu</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="order" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="icon">Icon Menu</label>
                            <div class="controls">
                                <input type="text" class="span8" name="icon" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        

                        
                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('setting/menu/read'); ?>">Cancel</a>
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
            "lengthChange": true,
        });
    });
</script>