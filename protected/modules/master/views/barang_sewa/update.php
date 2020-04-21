<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Fasilitas</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Fasilitas</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/barang_sewa/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama Fasilitas</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="<?php echo $barang['nama_barang'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                               <div class="control-group">											
                            <label class="control-label" for="unit">Unit</label>
                            <div class="controls">
                                <select name="unit" class="chosen span5" id="propinsi" data-placeholder="Pilih..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_unit as $d):
                                        ?>
                                        <option value="<?php echo $d['id_unit'] ?>" <?php
                                        if ($unit_barang['id_unit'] == $d['id_unit']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_unit'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                            <label class="control-label" for="jumlah">Jml Per Sewa</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="jumlah" value="<?php echo $tarif_barang['jumlah_satuan_sewa'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="satuan">Satuan Sewa</label>
                            <div class="controls">
                                <select name="satuan" class="chosen span5" id="propinsi" data-placeholder="Pilih..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_satuan as $d):
                                        ?>
                                        <option value="<?php echo $d['id_satuan_sewa'] ?>" <?php
                                        if ($satuan_barang['id_satuan_sewa'] == $d['id_satuan_sewa']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_satuan'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="tarif">Tarif Sewa</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="tarif" value="<?php echo $tarif_barang['tarif_sewa'] ?> "id="tarif" autocomplete="off" onkeyup="document.getElementById('format').innerHTML = formatCurrency(this.value);"/>
                                <br><span  id="format"></span>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="jenis_barang">Jenis Sewa</label>
                            <div class="controls">
                                <select name="jenis_barang" id="propinsi" data-placeholder="Pilih..." tabindex="2">
                                    <option value="1" <?php if($barang['jenis_barang']==1) {echo "selected='true'";} ?>>Alat</option>
                                    <option value="2" <?php if($barang['jenis_barang']==2) {echo "selected='true'";} ?>>Kandang Hewan</option>
                                    <option value="3" <?php if($barang['jenis_barang']==3) {echo "selected='true'";} ?>>Jasa Konsultasi</option>
                                    <option value="4" <?php if($barang['jenis_barang']==4) {echo "selected='true'";} ?>>Bahan</option>
                                    <option value="5" <?php if($barang['jenis_barang']==5) {echo "selected='true'";} ?>>Jasa Teknisi</option>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="keterangan">Keterangan</label>
                            <div class="controls">
                                <input type="text" class="span8" name="keterangan" value="<?php echo $barang['keterangan_barang'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/barang/read'); ?>">Cancel</a>
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