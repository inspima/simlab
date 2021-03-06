<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Dokter</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Dokter</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/dokter/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="<?php echo $dokter['nama_dokter'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="g_depan">Gelar Depan</label>
                            <div class="controls">
                                <input type="text" class="span3" name="g_depan" value="<?php echo $dokter['gelar_depan'] ?>">
                            </div> <!-- /controls -->		
                            <label class="control-label" for="g_belakang">Gelar Belakang</label>
                            <div class="controls">
                                <input type="text" class="span3" name="g_belakang" value="<?php echo $dokter['gelar_belakang'] ?>">
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <label class="radio inline">
                                    <input type="radio" value="1" class="validate[required]" <?php
                                    if ($dokter['jenis_kelamin'] == 1) {
                                        echo "checked='true'";
                                    }
                                    ?> name="jenis_kelamin"> Laki-Laki
                                </label>

                                <label class="radio inline">
                                    <input type="radio" value="2" class="validate[required]" <?php
                                    if ($dokter['jenis_kelamin'] == 2) {
                                        echo "checked='true'";
                                    }
                                    ?> name="jenis_kelamin"> Perempuan
                                </label>
                            </div>	<!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="text" class="span2 datepicker validate[required]" name="tgl_lahir" value="<?php echo $dokter['tgl_lahir'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama">Agama</label>
                            <div class="controls">
                                <select name="agama" class="chosen span5" id="agama" data-placeholder="Pilih Agama..." tabindex="2">
                                    <?php
                                    foreach ($data_agama as $d):
                                        ?>
                                        <option value="<?php echo $d['id_agama'] ?>" <?php
                                        if ($dokter['id_agama'] == $d['id_agama']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_agama'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="propinsi">Propinsi</label>
                            <div class="controls">
                                <select name="propinsi" class="chosen span5" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                                    <?php
                                    foreach ($data_propinsi as $d):
                                        ?>
                                        <option value="<?php echo $d['id_propinsi'] ?>" <?php
                                        if ($propinsi_dokter['id_propinsi'] == $d['id_propinsi']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_propinsi'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        
                        <div id="kota_loading"></div>
                        
                        <div class="control-group">											
                            <label class="control-label" for="kota">Kota</label>
                            <div class="controls">
                                <select name="kota" class="chosen span5" id="kota" data-placeholder="Pilih Kota..." tabindex="2">
                                    <?php
                                    foreach ($data_kota as $d):
                                        ?>
                                        <option value="<?php echo $d['id_kota'] ?>" <?php
                                        if ($dokter['id_kota_lahir'] == $d['id_kota']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_kota'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->



                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea name="alamat"  style="resize: none;height:80px" class="span6"><?php echo $dokter['alamat'] ?></textarea>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                        
                        
                        <div class="control-group">											
                            <label class="control-label" for="instansi">Instansi Dokter</label>
                            <div class="controls">
                                <select name="instansi" class="chosen span5" id="instansi" data-placeholder="Pilih Instansi..." tabindex="2">
                                    <option value="">--</option>
                                    <?php
                                    foreach ($data_instansi as $d):
                                        ?>
                                        <option value="<?php echo $d['id_instansi'] ?>" <?php
                                        if ($dokter['id_instansi'] == $d['id_instansi']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_instansi'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <br />
                            
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/dokter/read'); ?>">Cancel</a>
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