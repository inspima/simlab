
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Divisi</th>
                            <th>Nama Unit</th>
                            <th>Nama Divisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($divisi as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['id_divisi'] ?></td>
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td><?php echo $d['nama_divisi'] ?></td>
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
header("Content-disposition: attachment; filename=MS_DIVISI_".date('m-Y').".xls"); 
?>