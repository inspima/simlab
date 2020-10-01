                                <?php
include 'breadcumbs.php';
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget" style="padding-bottom: 200px">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Input Data Instansi</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Instansi</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/instansi/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama Instansi</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="nama" value="">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                         <div class="control-group">											
                            <label class="control-label" for="jenis">Jenis Instansi</label>
                            <div class="controls">
                                <div style="width: 50%">
                                    <select name="jenis_instansi" class="chosen span5"  id="jenis_instansi" tabindex="2">
                                        <?php
                                        foreach ($data_instansi_jenis as $d):
                                            ?>
                                            <option value="<?php echo $d['id_instansi_jenis'] ?>"><?php echo $d['nama_instansi_jenis'] ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        
                        <div class="control-group">											
                            <label class="control-label" for="kode">Kode Instansi</label>
                            <div class="controls">
                                <select name="kode_instansi" class="chosen span5 validate[required]" id="kode_instansi" data-placeholder="" tabindex="2"></select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea name="alamat"  style="resize: none;height:80px" class="span6"></textarea>
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="telp">Telp</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="telp" value="">                          
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="fax">Fax</label>
                            <div class="controls">
                                <input type="text" class="span8 validate[required]" name="fax" value="">                          
                            </div> <!-- /controls -->	

                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="propinsi">Propinsi</label>
                            <div class="controls">
                                <div style="width: 50%">
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
                            <label class="control-label" for="kota">Kota Instansi</label>
                            <div class="controls">
                                <div style="width: 50%">
                                    <select name="kota" class="chosen span5 validate[required]" id="kota" data-placeholder="Pilih Kota..." tabindex="2"></select>
                                </div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                       
                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('master/instansi/read'); ?>">Cancel</a>
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
                            