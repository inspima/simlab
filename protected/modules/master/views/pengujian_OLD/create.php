<?php
include 'breadcumbs.php';
?>


<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data pengujian</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pengujian/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="kode">Kode</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="kode" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="nama">Nama Pengujian</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="sub_kelompok">Sub Kelompok</label>
                            <div class="controls">
                                <select name="sub_kelompok" class="chosen span5 validate[required]" id="sub_kelompok" data-placeholder="Pilih Subkelompok..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_subkelompok as $d):
                                        ?>
                                        <option value="<?php echo $d['id_pengujian_subkelompok'] ?>"><?php echo $d['nama_subkelompok'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                            <label class="control-label" for="kelompok">Kelompok</label>
                            <div class="controls">
                                <select name="kelompok" class="chosen span5" id="sub_kelompok" data-placeholder="Pilih kelompok..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_kelompok as $d):
                                        ?>
                                        <option value="<?php echo $d['id_pengujian_kelompok'] ?>" ><?php echo $d['nama_kelompok_pengujian'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                           <div class="control-group">											
                            <label class="control-label" for="group">Group</label>
                            <div class="controls">
                                <select name="group" class="chosen span5" id="group" data-placeholder="Pilih group..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_group as $d):
                                        ?>
                                        <option value="<?php echo $d['id_pengujian_group'] ?>" ><?php echo $d['nama_pengujian_group'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                           <div class="control-group">											
                            <label class="control-label" for="unit">Unit</label>
                            <div class="controls">
                                <select name="unit" class="chosen span5" id="unit" data-placeholder="Pilih unit..." tabindex="2">
                                    <?php
                                    foreach ($data_unit as $d):
                                        ?>
                                        <option value="<?php echo $d['id_unit'] ?>" ><?php echo $d['nama_unit'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="normal">Nilai Normal</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="normal" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="t_uji">Tarif pengujian</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="t_uji" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="t_konsul">Tarif Konsul</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="t_konsul" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/pengujian/read'); ?>">Cancel</a>
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