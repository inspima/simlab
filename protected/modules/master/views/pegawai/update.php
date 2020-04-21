<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data pegawai</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data pegawai</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pegawai/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
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
                                <input type="text" class="span8 validate[required]" name="nama" value="<?php echo $pegawai['nama_pegawai'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nip">NIP/NIK</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nip" value="<?php echo $pegawai['nip'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="g_depan">Gelar Depan</label>
                            <div class="controls">
                                <input type="text" class="span3" name="g_depan" value="<?php echo $pegawai['gelar_depan'] ?>">
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                       <div class="control-group">						
                            <label class="control-label" for="g_belakang">Gelar Belakang</label>
                            <div class="controls">
                                <input type="text" class="span3" name="g_belakang" value="<?php echo $pegawai['gelar_belakang'] ?>">
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="text" class="span2 datepicker validate[required]" name="tgl_lahir" value="<?php echo $pegawai['tgl_lahir'] ?>">
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
                                        if ($pegawai['id_agama'] == $d['id_agama']) {
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
                                        if ($propinsi_pegawai['id_propinsi'] == $d['id_propinsi']) {
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
                                        if ($pegawai['id_kota_lahir'] == $d['id_kota']) {
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
                                <textarea name="alamat"  style="resize: none;height:80px" class="span6"><?php echo $pegawai['alamat'] ?></textarea>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="telp">Telp</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="telp" value="<?php echo $pegawai['telephone'] ?>">                           </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="hp">HP</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="hp" value="<?php echo $pegawai['hp'] ?>">
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="jabatan">Jabatan</label>
                            <div class="controls">
                                <select name="jabatan" class="chosen span5" id="jabatan" data-placeholder="Pilih Jabatan..." tabindex="2">
                                    <?php
                                    foreach ($data_jabatan as $d):
                                        ?>
                                        <option value="<?php echo $d['id_jabatan'] ?>" <?php
                                        if ($pegawai['id_jabatan'] == $d['id_jabatan']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_jabatan'] ?></option>
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
                                        <option value="<?php echo $d['id_unit'] ?>" <?php
                                        if ($pegawai['id_unit'] == $d['id_unit']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_unit'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
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