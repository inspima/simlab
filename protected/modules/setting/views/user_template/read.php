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
                            <th>User Sistem</th>
                            <th>Template Aktif</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama (NRP)</th>
                            <th>TTL</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>User Sistem</th>
                            <th>Template Aktif</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_personil as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_pegawai'] ?> <br/> NIP/NIK : <?php echo $d['nip'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['nama_jabatan'] ?></td>
                                <td></td>
                                <td style="width: 180px;">
                                    Username : <b><?php echo $d['username']; ?></b> <br/>
                                    Nama User : <b><?php echo $d['nama_user'] ?></b>
                                </td>
                                <td><?php echo $d['nama_template'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="Edit Template" href="<?php echo Yii::app()->createUrl('setting/user_template/template?id=' . $d['id_pegawai']); ?>"><i class="icon-list"></i></a>
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
                    url: '<?php echo Yii::app()->createUrl('setting/user_template/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>