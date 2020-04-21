<?php
include 'breadcumbs.php';


foreach ($barang as $peg):
?>


<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>View Data </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Fasilitas</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/barang_sewa/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a>
                                            <a class="btn btn" href="<?php echo Yii::app()->createUrl('master/barang_sewa/update?id=' . $peg['id_barang_sewa']); ?>">Edit&nbsp;&nbsp;<i class="icon-chevron-right"></i></a>
                                            <?php echo CHtml::link('Generate Barcode', Yii::app()->createUrl('master/barang_sewa/barcode?id=' . $peg["id_barang_sewa"]) , array('class'=>'btn btn', 'target'=>'blank'));?></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; 
                
                ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>ID</b></label>
                            <div class="controls">
                                <?php echo $peg['id_barang_sewa'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Nama Fasilitas</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_barang'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                      
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Unit</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_unit'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Jumlah Per Sewa</b></label>
                            <div class="controls">
                                <?php echo $peg['jumlah_satuan_sewa'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Nama Satuan Sewa</b></label>
                            <div class="controls">
                                <?php echo $peg['nama_satuan'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                        <div class="control-group">											
                            <label class="control-label" for="nama"><b>Tarif Sewa</b></label>
                            <div class="controls">
                                <?php echo $this->idr($peg['tarif_sewa'])?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        
                          <div class="control-group">											
                            <label class="control-label" for="nama"><b>Keterangan</b></label>
                            <div class="controls">
                                <?php echo $peg['keterangan_barang'] ?>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                         
                        <br />
                        <!--
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a class="btn"  href="<?php // echo Yii::app()->createUrl('master/pegawai/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
                        
                             <?php
                        endforeach;
                        ?>
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