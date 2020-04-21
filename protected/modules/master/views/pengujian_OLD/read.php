<?php
include 'breadcumbs.php';
?>
<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master pengujian</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data pengujian</h2>
                <p style="margin: 20px 0px"><a href="<?php echo Yii::app()->createUrl('master/pengujian/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah pengujian</a></p>
                <table style="margin :10px 0px" id="pengujian-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Pengujian</th>
                            <th>Kelompok</th>
                            <th>Sub Kelompok</th>
                            <th>Group</th>
                            <th>Unit</th>
                            <th>N Normal</th>
                            <th>Tarif Pengujian</th>
                            <th>Tarif Konsul</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Pengujian</th>
                            <th>Kelompok</th>
                            <th>Sub Kelompok</th>
                            <th>Group</th>
                            <th>Unit</th>
                            <th>N Normal</th>
                            <th>Tarif Pengujian</th>
                            <th>Tarif Konsul</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_pengujian as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_pengujian'] ?></td>
                                <td><?php echo $d['nama_pengujian'] ?></td>
                                <td><?php echo $d['nama_kelompok_pengujian'] ?></td>
                                <td><?php echo $d['nama_subkelompok'] ?><br/>
                                <td><?php echo $d['nama_pengujian_group'] ?><br/>  
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td><?php echo $d['nilai_normal'] ?></td>
                                <td><?php echo $d['tarif_pengujian'] ?></td>
                                <td><?php echo $d['tarif_konsul'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/pengujian/view?id=' . $d['id_pengujian']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/pengujian/update?id=' . $d['id_pengujian']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn pengujian-delete-button" title="Delete" id="<?php echo $d['id_pengujian'] ?>" ><i class="icon-remove"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('#pengujian-datatable').dataTable({
            "lengthChange": true,
        });
        $('#pengujian-datatable tbody').on('click', '.pengujian-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/pengujian/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>