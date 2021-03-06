<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Bahan Pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Bahan Pengujian</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/barang_uji/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="kode">Kode Bahan Pengujian</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="kode" value="<?php echo $bp['kode_bahan'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                               <div class="control-group">											
                            <label class="control-label" for="jenis">Jenis Bahan Pengujian</label>
                            <div class="controls">
                                <select name="jenis" class="chosen span5" id="propinsi" data-placeholder="Pilih..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($bj as $d):
                                        ?>
                                        <option value="<?php echo $d['id_bahan_jenis'] ?>" 
                                        <?php if($d['id_bahan_jenis'] == $bj_bahan['id_bahan_jenis']) {
                                            echo " selected ";
                                        } ?>
                                        ><?php echo $d['nama_bahan_jenis'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                            <label class="control-label" for="nama">Nama Bahan Pengujian</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="<?php echo $bp['nama_bahan'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="harga">Harga</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="harga" id="tarif" value="<?php echo $bp['harga_bahan'] ?>" autocomplete="off" onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);"/>
                                <br><span  id="format"></span>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                       
                          <div class="control-group">											
                            <label class="control-label" for="ket">Keterangan</label>
                            <div class="controls">
                                <input type="text" class="span8" name="ket" value="<?php echo $bp['keterangan_bahan'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/bahan_uji/read'); ?>">Cancel</a>
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