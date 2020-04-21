<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Tambah Data Dokter</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Dokter</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/dokter/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation" method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="g_depan">Gelar Depan</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="g_depan" value="">
                            </div> <!-- /controls -->		
                            <label class="control-label" for="g_belakang">Gelar Belakang</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="g_belakang" value="">
                            </div> <!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <label class="radio inline">
                                    <input type="radio" value="1" class="validate[required]"  name="jenis_kelamin"> Laki-Laki
                                </label>

                                <label class="radio inline">
                                    <input type="radio" value="2" class="validate[required]" name="jenis_kelamin"> Perempuan
                                </label>
                            </div>	<!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="text" class="span2 datepicker validate[required]" name="tgl_lahir" value="<?php echo $this->tglDefault(); ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama">Agama</label>
                            <div class="controls">
                                <select name="agama" class="chosen span5" id="agama" data-placeholder="Pilih Agama..." tabindex="2">
                                    <?php
                                    foreach ($data_agama as $d):
                                        ?>
                                        <option value="<?php echo $d['id_agama'] ?>"><?php echo $d['nama_agama'] ?></option>
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
                                        <option value="<?php echo $d['id_propinsi'] ?>"><?php echo $d['nama_propinsi'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <div id="kota_loading"></div>
                        <div class="control-group">											
                            <label class="control-label" for="kota">Kota Lahir</label>
                            <div class="controls">
                                <select name="kota" class="chosen span5 validate[required]" id="kota" data-placeholder="Pilih Kota..." tabindex="2"></select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        

                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea name="alamat"  style="resize: none;height:80px" class="span6"></textarea>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="instansi">Instansi Dokter</label>
                            <div class="controls">
                                <select name="instansi" class="chosen span5" id="agama" data-placeholder="Pilih Instansi..." tabindex="2">
                                    <?php
                                    foreach ($data_instansi as $d):
                                        ?>
                                        <option value="<?php echo $d['id_instansi'] ?>"><?php echo $d['nama_instansi'] ?></option>
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
            "lengthChange": true,
        });
    });
</script>