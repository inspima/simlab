 <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Kelompok Pengujian</th>
                            <th>Kelompok Pengujian</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                           <th>Kode Kelompok Pengujian</th>
                           <th>Kelompok Pengujian</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($kel_pengujian as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_kelompok'] ?></td>
                                <td><?php echo $d['nama_pengujian_kelompok'] ?></td>

                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/kelompok_pengujian/view?id=' . $d['id_pengujian_kelompok']); ?>" ><i class="icon-search"></i></a>
                                        <a class="btn" title="Edit" href="<?php echo Yii::app()->createUrl('master/kelompok_pengujian/update?id=' . $d['id_pengujian_kelompok']); ?>"><i class="icon-edit"></i></a>
                                        <a class="btn kelompok-delete-button" title="Delete" id="<?php echo $d['id_pengujian_kelompok'] ?>" ><i class="icon-remove"></i></a>
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
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=MS_KEL-UJI_".date('m-Y').".xls"); 
?>