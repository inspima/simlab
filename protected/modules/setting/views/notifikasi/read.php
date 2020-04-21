<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Notifikasi Sistem</h3>
            </div> <!-- /widget-header -->
            <div id="ajax-wrapper" class="widget-content">    
                <?php $this->renderPartial('set-terbaca',array('data_notifikasi'=>$data_notifikasi)) ?>
            </div> <!-- /widget-content -->

        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->

