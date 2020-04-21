<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master Menu</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Menu</h2>
                <p style="margin: 20px 0px"><a href="<?php echo Yii::app()->createUrl('setting/menu/create'); ?>" class="btn btn"><i class="icon-plus"></i>&nbsp;&nbsp;Tambah Menu</a></p>
                <table style="margin :10px 0px" id="menu-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Parent Menu</th>
                            <th>Label Menu</th>
                            <th>Url Menu</th>
                            <th>Order Menu</th>
                            <th>Icon</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Parent Menu</th>
                            <th>Label Menu</th>
                            <th>Url Menu</th>
                            <th>Order Menu</th>
                            <th>Icon</th>
                            <th>-</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($data_menu as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['parent_label'] ?></td>
                                <td><?php echo $d['label'] ?></td>
                                <td><?php echo $d['url'] ?></td>
                                <td><?php echo $d['order'] ?></td>
                                <td><?php echo $d['icon'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('setting/menu/update?id=' . $d['id_menu']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn menu-delete-button" title="Delete" id="<?php echo $d['id_menu'] ?>" ><i class="icon-remove"></i></a>
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
        $('#menu-datatable').dataTable({
            "lengthChange": true,
            "ordering": false
        });
        $('#menu-datatable tbody').on('click', '.menu-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('setting/menu/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function() {
                        window.location.reload();
                    }
                });
        });
    });
</script>