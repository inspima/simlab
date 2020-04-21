
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th> 
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>No Surat MoU</th>
                            <th>Masa Mou</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rekanan as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_rekanan'] ?></td>
                                <td><?php echo $d['alamat_rekanan'] ?></td>
                                <td><?php echo $d['telp'] ?></td>
                                <td><?php echo $d['no_surat_mou'] ?></td>
                                <td><?php echo $this->TanggalToIndo($d['tgl_mou_mulai'])." s/d ".$this->TanggalToIndo($d['tgl_mou_selesai'])."<br>".$this->expired($d['tgl_mou_mulai'],$d['tgl_mou_selesai']); ?></td>
                               
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
header("Content-disposition: attachment; filename=MS_REKANAN_".date('m-Y').".xls"); 
?>