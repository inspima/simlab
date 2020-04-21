
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Kode Bahan</th>
                            <th>Jenis Bahan</th>
                            <th>Nama Bahan</th>
                            <th>Harga Bahan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($bp as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_bahan'] ?></td>
                                <td><?php echo $d['nama_bahan_jenis'] ?></td>
                                <td><?php echo $d['nama_bahan'] ?></td>
                                <td><?php echo $this->idr($d['harga_bahan']) ?></td>
                                <td><?php echo $d['keterangan_bahan'] ?></td>
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
header("Content-disposition: attachment; filename=MS_BHN-UJI_".date('m-Y').".xls"); 
?>