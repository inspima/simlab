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
<table  style="width: 95%;margin-left: 5%;" class="table-bordered ">
    <tr>
        <td colspan="2" style="text-align: center;padding: 20px">
            <h3 style="text-decoration: underline">SERTIFIKAT PENGUJIAN</h3><br/>
            <h4>  <?php echo !empty($data_pemeriksaan[0]['no_sertifikat_pengujian'])?$data_pemeriksaan[0]['no_sertifikat_pengujian']:"No. xxx/LPT-SP/"; ?>
                <?php echo $this->integerToRoman(date('m')) ?>/<?php echo date('Y') ?>
            </h4>
        </td>
    </tr>
    <tr class="bordered">
        <td style="width: 40%"><b>1. No.Registrasi</b> </td>
        <td style="width: 60%"> : <?php echo $data_registrasi['no_registrasi'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>2. No.Order Lab</b> </td>
        <td> : <?php echo $data_registrasi['no_order'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>3. Tanggal Terima Sampel</b> </td>
        <td> : <?php echo date('d-m-Y', strtotime($data_registrasi['waktu_registrasi'])) ?></td>
    </tr>
    <tr class="bordered">
        <td><b>4. Nama Pengirim</b> </td>
        <td> : <?php echo $data_registrasi['nama'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>5. Alamat Pengirim</b> </td>
        <td> : <?php echo $data_registrasi['nama_instansi'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>6. Jenis / Kode Sampel</b> </td>
        <td> : <!--<?php echo $data_registrasi['nama_pasien_tipe'] ?>-->
            <?php echo !empty($data_pemeriksaan[0]['data_sample'][0]['nama_sample'])?$data_pemeriksaan[0]['data_sample'][0]['nama_sample']:""; ?>
             <?php echo !empty($data_pemeriksaan[0]['data_sample'][0]['keterangan_sample'])?'/ '.$data_pemeriksaan[0]['data_sample'][0]['keterangan_sample']:""; ?>
        </td>
    </tr>
    <tr class="bordered">
        <td><b>7. Tanggal Pengujian Sampel</b> </td>
        <td> : </td>
    </tr>
    <tr class="bordered">
        <td><b>8. Keperluan Uji</b> </td>
        <td> : <?php echo $data_registrasi['uji_keperluan'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>9. Parameter Uji</b> </td>
        <td> : <?php echo $data_registrasi['uji_parameter'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>10. Metode Uji</b> </td>
        <td> : <?php echo $data_registrasi['uji_metode'] ?></td>
    </tr>
    <tr class="bordered">
        <td><b>11. Hasil Pengujian *)</b> </td>
        <td> : Terlampir</td>
    </tr>
</table>
<table style="width: 95%;margin-left: 5%;margin-top: 100px;">
    <tr>

        <td style="width: 50%"></td>
        <td style="text-align: center;padding-left:10%;width: 50%">
            <p style="text-align: center">
                Surabaya <?php echo $this->getDateIndo(date('Y-m-d')) ?><br/>
                <b>Manajer Teknis</b>
                <br/>
                <br/>
                <br/>
                <br/>
                (<?php echo $user_pj['gelar_depan'] . ' ' . $user_pj['nama_pegawai'] . ' ' . $user_pj['gelar_belakang'] ?>)
            </p>
        </td>

    </tr>
</table>