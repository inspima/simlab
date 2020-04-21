<table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th> 
                            <th>Kode</th> 
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Telp</th>
                            <th>Fax</th>
                            <th>Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_instansi as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_instansi'] ?></td>
                                <td><?php echo $d['kode_instansi'] ?></td>
                                <td><?php echo $d['alamat_instansi'] ?></td>
                                <td><?php echo $d['nama_kota'] ?></td>
                                <td><?php echo $d['telephone'] ?></td>
                                <td><?php echo $d['fax'] ?></td>
                                <td><?php echo $d['nama_instansi_jenis'] ?></td>
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
header("Content-disposition: attachment; filename=MS_INSTANSI_".date('m-Y').".xls");
?>

