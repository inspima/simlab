
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Bahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($bj as $bj):
                            ?>
                            <tr>
                                <td><?php echo $bj['id_bahan_jenis'] ?></td>
                                <td><?php echo $bj['nama_bahan_jenis'] ?></td>
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
header("Content-disposition: attachment; filename=MS_BHN-JNS_".date('m-Y').".xls"); 
?>