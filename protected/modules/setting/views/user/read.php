<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master User Sistem</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Personil</h2>
                <table style="margin :10px 0px" id="personil-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama (NRP)</th>
                            <th>TTL</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>Status User</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama (NRP)</th>
                            <th>TTL</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>Status User</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_personil as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['gelar_depan'] ?><?php echo $d['nama_pegawai'] ?> <?php echo $d['gelar_belakang'] ?> <br/> NIP/NIK : <?php echo $d['nip'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['nama_jabatan'] ?></td>
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <?php
                                    if ($d['nama_user'] != '') {
                                        ?>
                                        <span class="btn btn-success">Sudah Ada</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="btn btn-danger">Belum Ada</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <?php
                                        if ($d['nama_user'] != '') {
                                            ?>
                                            <a class="btn" title="Edit User" href="<?php echo Yii::app()->createUrl('setting/user/update?id=' . $d['id_pegawai'].'&user='.$d['id_user']); ?>"><i class="icon-edit"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a class="btn" title="Tambah User" href="<?php echo Yii::app()->createUrl('setting/user/create?id=' . $d['id_pegawai']); ?>"><i class="icon-plus"></i></a>
                                            <?php
                                            }
                                            ?>

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
        $('#personil-datatable').dataTable({
            "lengthChange": true,
        });
        $('#personil-datatable tbody').on('click', '.personil-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('setting/user/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>