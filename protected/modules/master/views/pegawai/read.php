<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Pegawai</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Pegawai</h2>
                <p style="margin: 20px 0px">
                    <a href="<?php echo Yii::app()->createUrl('master/pegawai/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Pegawai</a>
                     <a href="<?php echo Yii::app()->createUrl('master/pegawai/excel'); ?>" class="btn btn"><i class="icon-download-alt"></i>&nbsp;&nbsp;Download Data</a>
                </p>
                <table style="margin :10px 0px" id="pegawai-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama & NIP</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>TTL</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>HP</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama & NIP</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>TTL</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>HP</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($pegawai as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['gelar_depan'] ?><?php echo $d['nama_pegawai'] ?> <?php echo $d['gelar_belakang'] ?> (<?php echo $d['nip'] ?>)</td>
                                <td><?php echo $d['nama_jabatan'] ?></td>
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['nama_agama'] ?></td>
                                <td><?php echo $d['alamat'] ?></td>
                                <td><?php echo $d['telephone'] ?></td>
                                <td><?php echo $d['hp'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/pegawai/view?id=' . $d['id_pegawai']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/pegawai/update?id=' . $d['id_pegawai']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn pegawai-delete-button" title="Delete" id="<?php echo $d['id_pegawai'] ?>" ><i class="icon-remove"></i></a>
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
        $('#pegawai-datatable').dataTable({
            "lengthChange": true,
        });
        $('#pegawai-datatable tbody').on('click', '.pegawai-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/pegawai/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>