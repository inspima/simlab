<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan PFL Bulalan <?php //if($pil_bulan !='') echo'Tahun '.$pil_tahun;  ?></h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    

                <a class="btn btn-info" href="<?php echo Yii::app()->createUrl("laporan/pemeriksaan/pflBulanan") ?>" target="_blank">Buka Laporan</a>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->

<?php
include 'plugins.php';
?>