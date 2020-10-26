<?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Input Data pasien</h3>
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
                                <input type="text" class="span8 validate[required]" name="nama" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nik">NIK</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nik" value="">
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
                                <input type="text" class="span2" name="tgl_lahir" id="tanggal_lahir" value="1960-01-01">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="umur">Umur</label>
                            <div class="controls">
                                <input type="text" class="span8"  id="umur" name="umur" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="telepon">Telepon</label>
                            <div class="controls">
                                <input type="text" class="span8" name="telepon" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="hp">HP</label>
                            <div class="controls">
                                <input type="text" class="span8" name="hp" value="">
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
                                            <option value="<?php echo $d['id_agama'] ?>"><?php echo $d['nama_agama'] ?></option>
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
                                <div style="width: 60%">
                                    <select name="propinsi" class="chosen span5" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                                        <?php
                                        foreach ($data_propinsi as $d):
                                            ?>
                                            <option value="<?php echo $d['id_propinsi'] ?>"><?php echo $d['nama_propinsi'] ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <div id="kota_loading"></div>
                        <div class="control-group">											
                            <label class="control-label" for="kota">Kota Lahir</label>
                            <div class="controls">
                                <div style="width: 60%">
                                    <select name="kota" class="chosen span5 validate[required]" id="kota" data-placeholder="Pilih Kota..." tabindex="2"></select>
                                </div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->


                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea name="alamat"  style="resize: none;height:80px" class="span6"></textarea>
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
        $('#tanggal_lahir').datepicker().on('changeDate', function(ev) {
            $('#umur').val(getAge($(this).val()));
        });
    });
</script>