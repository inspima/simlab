
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Unit&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>Jumlah Per Sewa</th>
                            <th>Nama Satuan Sewa</th>
                            <th>Tarif Sewa</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($barang as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['id_barang_sewa'] ?></td>
                                <td><?php echo $d['nama_barang'] ?></td>
                                <td><?php echo $d['nama_unit'] ?></td>
                                <td><?php echo $d['jumlah_satuan_sewa'] ?></td>
                                <td><?php echo $d['nama_satuan'] ?></td>
                                <td><?php echo $this->idr($d['tarif_sewa']) ?></td>
                                <td>
                                    <?php
                                    if($d['jenis_barang']==1){
                                        echo "Alat";
                                    }else if($d['jenis_barang']==2){
                                        echo "Kandang Hewan";
                                    }else if($d['jenis_barang']==3){
                                        echo "Jasa Konsultasi";
                                    }else if($d['jenis_barang']==4){
                                        echo "Bahan";
                                    }else if($d['jenis_barang']==5){
                                        echo "Jasa Teknisi";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $d['keterangan_barang'] ?></td>
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
header("Content-disposition: attachment; filename=MS_FASILITAS_".date('m-Y').".xls"); 
?>