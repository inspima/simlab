<style>
    table, th, td {
        border: none;
        border-collapse: collapse;
        padding: 10px
    }
    .bordered {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px
    }
</style>
<div style="width: 100%;height: 15%">

</div>
<table  style="width: 95%;margin-left: 5%;margin-top: 20px;" class="table-bordered ">
    <tr class="bordered">
        <td><b>No.Order Lab</b> </td>
        <td> : <?php echo $data_registrasi['no_registrasi'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>Jenis / Kode Sampel</b> </td>
        <td> : <!--<?php echo $data_registrasi['nama_pasien_tipe'] ?>-->
            <?php echo !empty($data_pemeriksaan[0]['data_sample'][0]['nama_sample'])?$data_pemeriksaan[0]['data_sample'][0]['nama_sample']:""; ?>
             <?php echo !empty($data_pemeriksaan[0]['data_sample'][0]['keterangan_sample'])?'/ '.$data_pemeriksaan[0]['data_sample'][0]['keterangan_sample']:""; ?>
        </td>
    </tr>

</table>
<table  style="width: 95%;margin-left: 5%;font-size: 0.8em" >
    <tr>
        <td style="text-align: center"><h3>HASIL PENGUJIAN</h3></td>
    </tr>
</table>
<table style="width: 95%;margin-left: 5%;font-size: 0.8em">
    <thead >
        <tr>
            <th class="bordered">Jenis Pemeriksaan</th>
            <th class="bordered">Hasil</th>
            <th class="bordered">Nilai Normal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($data_pemeriksaan as $d):
            ?>
            <tr  class="bordered">
                <!--<td><?php echo $no ?></td>-->
                <td style="text-align: left;padding-left:5%"><?php echo $d['nama_pengujian'] ?></td>
                <!--<td style="text-align: center">
                <?php
                foreach ($d['data_sample'] as $ds) {
                    if ($ds['id_pemeriksaan_sample'] != '') {
                        echo '- ' . $ds['nama_sample'] . '<br/>';
                    }
                }
                ?>
                </td>
                -->
                <td style="text-align: center;"><?php echo $d['hasil_pengujian']; ?></td>
                <td style="text-align: center;"><?php echo $d['nilai_normal']; ?></td>
                <!--<td style="text-align: center"><?php echo $d['keterangan_pemeriksaan']; ?></td>-->
            </tr>
            <?php
            if (count($d['data_child']) > 0) {
                $no_child = 1;
                foreach ($d['data_child'] as $dc) {
                    ?>
                    <tr>
                        <td style="text-align: left;padding-left:5%" >- <?php echo $dc['nama_pengujian'] ?></td>
                        <td style="text-align: center;" >
                            <?php echo strip_tags($dc['hasil_pengujian']) ?>
                        </td>
                        <td style="text-align: center;"><?php echo $dc['nilai_normal'] ?></td>
                    </tr>
                    <?php
                    $no_child++;
                }
            }
            $no++;
        endforeach;
        ?>

    </tbody>
    <tfoot>
        <tr>
            <td style="text-align: left;padding-top: 300px">
                <br/>
                <div class="pull-left">

                </div>
            </td>
            <td colspan="2" style="text-align: right">
                <br/>
                <div class="pull-right">

                </div>
            </td>
        </tr>
    </tfoot>
</table>

<table style="width: 95%;margin-left: 5%;margin-top: 100px;font-size: 0.8em">
    <tr>

        <td style="width: 50%"></td>
        <td style="text-align: center;padding-left:10%;width: 50%">
            <p style="text-align: center">
                Surabaya <?php echo $this->getDateIndo(date('Y-m-d')) ?><br/>
                <b>Validasi Hasil</b>
                <br/>
                <br/>
                <br/>
                <br/>
                (.....................)
            </p>
        </td>

    </tr>
</table>