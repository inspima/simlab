
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Kode</th> 
                            <th>Nama Pengujian</th>
                            <th>Nilai Normal</th>
                            <th>Kelompok Pengujian</th>
                            <th>Group</th>
                            <th>Unit</th>
                            <th>Divisi</th>
                            <th>Tarif Pengujian</th>
                            <th>Tarif Konsul</th>
                            
                        </tr>
                    </thead>
                   
                    <tbody>
                        <?php
                        foreach ($gruoup_uji as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['kode_pengujian'] ?></td>
                                <td><?php echo $d['nama_pengujian'] ?></td>
                                <td><?php echo nl2br($d['nilai_normal']) ?></td>
                                <td><?php echo $d['nama_pengujian_kelompok'] ?></td>
                                <td><?php echo $d['grup'] ?></td>
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td><?php echo $d['nama_divisi'] ?></td>
                                <td><?php echo $this->idr($d['tarif_pengujian']) ?></td>
                                <td><?php echo $this->idr($d['tarif_konsul']) ?></td>
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
header("Content-disposition: attachment; filename=MS_UJI_".date('m-Y').".xls"); 
?>