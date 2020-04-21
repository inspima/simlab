
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nama & NIP</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>TTL</th>
                            <th>Agama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>HP</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        <?php
                        foreach ($pegawai as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['gelar_depan'] ?><?php echo $d['nama_pegawai'] ?> <?php echo $d['gelar_belakang'] ?> (<?php echo $d['nip'] ?>)</td>
                                <td><?php echo $d['nama_jabatan'] ?></td>
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td><?php echo $d['nama_kota'] ?><br/> <?php echo date('d-m-Y', strtotime($d['tgl_lahir'])) ?></td>
                                <td><?php echo $d['nama_agama'] ?></td>
                                <td><?php echo $d['alamat'] ?></td>
                                <td><?php echo $d['telephone'] ?></td>
                                <td><?php echo $d['hp'] ?></td>
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
header("Content-disposition: attachment; filename=MS_PEGAWAI_".date('m-Y').".xls"); 
?>