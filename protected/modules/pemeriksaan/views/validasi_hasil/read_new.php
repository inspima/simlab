<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget" >
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Validasi Hasil Pemeriksaan </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content" style="padding-bottom: 250px">    
                <h2>Data Registrasi Pemeriksaan Pasien</h2>
                <form style="margin: 10px" class="form-inline" role="form">
                    <div class="control-group-group">
                        <label class="sr-only" for="unit" style="float: left;;margin-right:10px;margin-top:5px">Pilih Unit : </label>
                        <div style="width: 200px;float:left;margin-right:10px">
                            <select name="unit" class="form-control chosen"  tabindex="2">
                                <option value="">---PILIH UNIT---</option>
                                <?php
                                foreach ($data_unit as $d):
                                    if ($id_unit_user == '') {
                                        ?>
                                        <option value="<?php echo $d['id_unit'] ?>" <?php if($id_unit == $d['id_unit']){echo "selected='true'";} ?>><?php echo $d['nama_unit'] ?></option>
                                        <?php
                                    } else {
                                        if ($id_unit == $d['id_unit']) {
                                            ?>
                                            <option value="<?php echo $d['id_unit'] ?>" <?php if($id_unit == $d['id_unit']){echo "selected='true'";} ?>><?php echo $d['nama_unit'] ?></option>
                                            <?php
                                        }
                                    }

                                endforeach;
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>                    
                </form>
                <hr/>
                <?php
                if(!empty($id_unit)){
                ?>                
                <table style="margin :10px 0px" id="registrasi-pemeriksaan-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Registrasi/Order</th>
                            <th>Waktu Order</th>
                            <th>Nama pasien</th>
                            <th>Keluhan Diagnosa</th>
                            <th>Status Pemeriksaan</th>
                            <th>Status Pembayaran</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Registrasi/Order</th>
                            <th>Waktu Order</th>
                            <th>Nama pasien</th>
                            <th>Keluhan Diagnosa</th>
                            <th>Status Pemeriksaan</th>
                            <th>Status Pembayaran</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                </table>
                <?php
                }
                ?>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<?php
if(!empty($id_unit)){
?>            
<script>
    $(document).ready(function() {
        $('#registrasi-pemeriksaan-datatable').dataTable({
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo Yii::app()->createUrl('pemeriksaan/validasi_hasil/readDataAjax?id_unit='.$id_unit); ?>", 
            "language": {
                "processing": "Sedang memuat data, mohon tunggu"
            },
        });

    });
</script>
<?php
}
?>