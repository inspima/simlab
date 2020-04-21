<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Template Sistem</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Template</h2>
                <p style="margin: 20px 0px"><a href="<?php echo Yii::app()->createUrl('setting/template_menu/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Template Baru</a></p>
                <table style="margin :10px 0px" id="template-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Template</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                           <th>Nama Template</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_template as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_template'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('setting/template_menu/update?id=' . $d['id_template']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn" title="Edit Menu" href="<?php echo Yii::app()->createUrl('setting/template_menu/edit_menu?id=' . $d['id_template']); ?>"><i class="icon-list"></i></a>
                                        <a class="btn template-delete-button" title="Delete" id="<?php echo $d['id_template'] ?>" ><i class="icon-remove"></i></a>
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
        $('#template-datatable').dataTable({
            "lengthChange": true,
        });
        $('#template-datatable tbody').on('click', '.template-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('setting/template_menu/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        $('body').html(data);
                    }
                });
        });
    });
</script>