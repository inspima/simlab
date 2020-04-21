<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Tambah Data Group Pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Unit</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/group_pengujian/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
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
                                <input type="text" class="span2 validate[required]" name="kode" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama Group</label>
                            <div class="controls">
                                <input type="text" class="span5 validate[required]" name="nama" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="kelompok">Kelompok Pengujian</label>
                            <div class="controls">
                                <select name="kelompok" class="chosen span2" id="kelompok" data-placeholder="Pilih...." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_kelompok as $d):
                                        ?>
                                        <option value="<?php echo $d['id_pengujian_kelompok'] ?>"><?php echo $d['nama_pengujian_kelompok'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="unit">Unit</label>
                            <div class="controls">
                                <select name="unit" class="chosen span5" id="unit" data-placeholder="Pilih" tabindex="2">
                                    <option value="">--</option>
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
                            <label class="control-label" for="divisi">Divisi</label>
                            <div class="controls">
                                <select name="divisi" class="chosen span5" id="divisi" data-placeholder="Pilih" tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_divisi as $d):
                                        ?>
                                        <option value="<?php echo $d['id_divisi'] ?>"><?php echo $d['nama_divisi'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="t_uji_grup">Tarif Pengujian Group</label>
                            <div class="controls">
                                <input type="text" class="span3 validate[required]" name="t_uji_grup" value="" id="t_uji_grup" autocomplete="off" onkeyup="document.getElementById('format1').innerHTML = formatCurrency(this.value);" />
                                <br><span  id="format1"></span>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="t_konsul">Tarif Konsul</label>
                            <div class="controls">
                                <input type="text" class="span3 validate[required]" name="t_konsul" value="" id="t_konsul" autocomplete="off" onkeyup="document.getElementById('format2').innerHTML = formatCurrency(this.value);" />
                                <br><span  id="format2"></span>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/group_pengujian/read'); ?>">Cancel</a>
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