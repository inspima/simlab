<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data pasien</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data pasien</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/pasien/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
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
                                <input type="text" class="span8 validate[required]" name="nama" value="<?php echo $pasien['nama'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nik">NIK</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nik" value="<?php echo $pasien['nik'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <label class="radio inline">
                                    <input type="radio" value="1" <?php if ($pasien['jenis_kelamin'] == 1) echo "checked='true'"; ?> class="validate[required]"  name="jenis_kelamin"> Laki-Laki
                                </label>

                                <label class="radio inline">
                                    <input type="radio" value="2" <?php if ($pasien['jenis_kelamin'] == 2) echo "checked='true'"; ?> class="validate[required]" name="jenis_kelamin"> Perempuan
                                </label>
                            </div>	<!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="text" class="span2" name="tgl_lahir" id="tanggal_lahir" value="<?php echo $pasien['tgl_lahir'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="umur">Umur</label>
                            <div class="controls">
                                <input type="text" class="span8" id="umur" name="umur" value="<?php echo $pasien['umur'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="telepon">Telepon</label>
                            <div class="controls">
                                <input type="text" class="span8" name="telepon" value="<?php echo $pasien['telephone'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="hp">HP</label>
                            <div class="controls">
                                <input type="text" class="span8" name="hp" value="<?php echo $pasien['hp'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama">Agama</label>
                            <div class="controls">
                                <div style="width: 60%">
                                    <select name="agama" class="chosen span5 validate[required]" id="agama" data-placeholder="Pilih Agama..." tabindex="2">
                                        <?php
                                        foreach ($data_agama as $d):
                                            ?>
                                            <option value="<?php echo $d['id_agama'] ?>" <?php if ($pasien['id_agama'] == $d['id_agama']) echo "selected='true'"; ?>><?php echo $d['nama_agama'] ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
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
                                        if ($propinsi_pasien['id_propinsi'] == $d['id_propinsi']) {
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
                                        if ($pasien['id_kota_lahir'] == $d['id_kota']) {
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
                                <textarea name="alamat"  style="resize: none;height:80px" class="span6"><?php echo $pasien['alamat'] ?></textarea>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/pasien/read'); ?>">Cancel</a>
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