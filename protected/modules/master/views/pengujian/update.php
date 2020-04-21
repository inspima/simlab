<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Group Pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Unit</h2>
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
                                <input type="text" class="span2 validate[required]" name="kode" value="<?php echo $pengujian['kode_pengujian'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama Pengujian</label>
                            <div class="controls">
                                <input type="text" class="span5 validate[required]" name="nama" value="<?php echo $pengujian['nama_pengujian'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="normal">Nilai Normal</label>
                            <div class="controls">
                            	<textarea name="normal"  style="resize: none;height:80px" class="span6"><?php echo $pengujian['nilai_normal'] ?></textarea>
                               
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
                                        <option value="<?php echo $d['id_pengujian_kelompok'] ?>" <?php
                                        if ($pengujian['id_pengujian_kelompok'] == $d['id_pengujian_kelompok']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_pengujian_kelompok'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="grup">Group Pengujian</label>
                            <div class="controls">
                                <select name="grup" class="chosen span2" id="grup" data-placeholder="Pilih...." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_group as $d):
                                        ?>
                                        <option value="<?php echo $d['id_pengujian'] ?>" <?php
                                        if ( $pengujian['id_pengujian_group'] == $d['id_pengujian']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_pengujian'] ?></option>
                                                <?php
                                            endforeach;
                                            
                                            
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <?php //echo $pengujian['id_pengujian'] ?>
                        <div class="control-group">											
                            <label class="control-label" for="unit">Unit</label>
                            <div class="controls">
                                <select name="unit" class="chosen span5" id="unit" data-placeholder="Pilih" tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_unit as $d):
                                        ?>
                                        <option value="<?php echo $d['id_unit'] ?>" <?php
                                        if ($pengujian['id_unit'] == $d['id_unit']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_unit'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div id="kota_loading"></div>
                        
                        <div class="control-group">											
                            <label class="control-label" for="divisi">Divisi</label>
                            <div class="controls">
                                <select name="divisi" class="chosen span5" id="divisi" data-placeholder="Pilih" tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_divisi as $d):
                                        ?>
                                        <option value="<?php echo $d['id_divisi'] ?>" <?php
                                        if ($pengujian['id_divisi'] == $d['id_divisi']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_divisi'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="t_uji_grup">Tarif Pengujian Group</label>
                            <div class="controls">
                                <input type="text" class="span3 validate[required]" name="t_uji_grup" value="<?php echo $pengujian['tarif_pengujian'] ?>" id="t_uji_grup" autocomplete="off" onkeyup="document.getElementById('format1').innerHTML = formatCurrency(this.value);" />
                                <br><span  id="format1"></span>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="t_konsul">Tarif Konsul</label>
                            <div class="controls">
                                <input type="text" class="span3 validate[required]" name="t_konsul" value="<?php echo $pengujian['tarif_konsul'] ?>" id="t_konsul" autocomplete="off" onkeyup="document.getElementById('format2').innerHTML = formatCurrency(this.value);" />
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