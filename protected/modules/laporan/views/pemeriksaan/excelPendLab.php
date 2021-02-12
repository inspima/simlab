<?php
    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
    header("Content-disposition: attachment; filename=lap-PendLab-".$awal."-".$akhir.".xls");


    function getData($begin, $end){
        /*
        if($id_unit != '0'){$query_unit = "AND g.id_unit = '$id_unit'";}
          else{$query_unit = " ";}
         *
         */

        $query = "SELECT a.id_registrasi_pemeriksaan, a.no_registrasi, a.waktu_registrasi, c.nama, 
              SUM(b.total_dibayar) AS total_dibayar, (AVG(b.total_biaya) - SUM(b.total_dibayar+b.potongan)) as piutang, (AVG(b.total_biaya)- SUM(b.potongan)) AS total_biaya,
              d.nama_instansi, e.nama_dokter
            FROM registrasi_pemeriksaan a
            LEFT JOIN pembayaran_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
            LEFT JOIN pasien c ON a.id_pasien = c.id_pasien
            LEFT JOIN instansi d ON a.id_instansi = d.id_instansi
            LEFT JOIN dokter e ON a.id_dokter_pengirim = e.id_dokter
            WHERE DATE_FORMAT(a.waktu_registrasi, '%Y-%m-%d') <= '$end'
            AND DATE_FORMAT(a.waktu_registrasi, '%Y-%m-%d') >= '$begin' 
            GROUP BY a.id_registrasi_pemeriksaan";
        $data = Yii::app()->db->createCommand($query)->queryAll();
        return $data;
    }

    function getPengujian($id_reg){
        $query = "SELECT c.nama_pengujian
            FROM pasien_pemeriksaan a
            LEFT JOIN registrasi_pemeriksaan b ON a.id_registrasi_pemeriksaan = b.id_registrasi_pemeriksaan
            LEFT JOIN pengujian c ON a.id_pengujian = c.id_pengujian
            WHERE a.id_registrasi_pemeriksaan = '$id_reg'";
        $data = Yii::app()->db->createCommand($query)->queryAll();
        return $data;
    }
?>




<table rules="all" cellspacing="0" border="1" width="100%">
    <thead>
    <tr>
        <td  valign="top"><div align="center"><strong>No</strong></div></td>
        <td  valign="top"><div align="center"><strong>Nota Order</strong></div></td>
        <td  valign="top"><div align="center"><strong>Tgl Daftar</strong></div></td>
        <td  valign="top"><div align="center"><strong>Nama Pasien</strong></div></td>
        <td  valign="top"><div align="center"><strong>Lunas</strong></div></td>
        <td  valign="top"><div align="center"><strong>Piutang</strong></div></td>
        <td  valign="top"><div align="center"><strong>Pendapatan</strong></div></td>
    </tr>
    </thead>
    <tbody>
    <?php $data_pendapatan = getData($awal, $akhir);
        $no = 1;
        $Jtotal = 0;
        $Jbayar = 0;
        $Jutang = 0;
        foreach ($data_pendapatan as $d):
            $id_reg = $d['id_registrasi_pemeriksaan'];
            ?>
            <tr>
                <td><span class="style3"><?php echo $no; ?></span> </td>
                <td><span class="style3"><?php echo $d['no_registrasi']."<br>";
                            $pengujian = getPengujian($id_reg);
                            foreach ($pengujian as $dp) :
                                echo "- ".$dp['nama_pengujian']."<br>";
                            endforeach;
                        ?></span> </td>
                <td valign="top" ><span class="style3"><?php echo $d['waktu_registrasi']."<br>";
                            echo '<b><u>instansi pengirim : '.$d['nama_instansi']."<br> dokter pengirim :".$d['nama_dokter'];
                        ?></span> </td>
                <td><span class="style3">
                                    <?=$d['nama']?>
                                    </span></td>
                <td><span class="style3">
                                    <?=$this->idr($d['total_dibayar'])?>
                                    </span></td>
                <td><span class="style3">
                                    <?=$this->idr($d['piutang'])?>
                                    </span></td>
                <td><span class="style3">
                                    <?=$this->idr($d['total_biaya'])?>
                                    </span></td>
            </tr>

            <?php $no++;
            $Jtotal = $Jtotal + $d['total_biaya'];
            $Jbayar = $Jbayar + $d['total_dibayar'];
            $Jutang = $Jutang + $d['piutang'];
        endforeach;
    ?>

    <tr>
        <td colspan="4"><center>
                <strong>Total</strong>
            </center></td>
        <td><strong>
                <?=$this->idr($Jbayar)?>
            </strong></td>
        <td><strong>
                <?=$this->idr($Jutang)?>
            </strong></td>
        <td><strong>
                <?=$this->idr($Jtotal)?>
            </strong></td>
    </tr>
    </tbody>
</table>
</fieldset>
</form>
</div>

</div> <!-- /widget-content -->
</div> <!-- /widget -->
</div> <!-- /spa12 -->
</div> <!-- /row -->


<?php
    //include 'plugins.php';
?>





