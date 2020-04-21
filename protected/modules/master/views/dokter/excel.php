
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Intansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data_dokter as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_dokter'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['jenis_kelamin'] == 1 ? "Laki-laki" : "Perempuan" ?></td>
                                <td><?php echo $d['nama_agama'] ?></td>
                                <td><?php echo $d['alamat'] ?></td>
                                <td><?php echo $d['nama_instansi'] ?></td>
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
header("Content-disposition: attachment; filename=MS_DOKTER_".date('m-Y').".xls"); 
?>