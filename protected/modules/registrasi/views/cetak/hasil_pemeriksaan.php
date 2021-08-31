
<!--<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
           window.print();
        }, 1000);
    });

</script>-->

<div class="container" >
    <div class="row-fluid" style="display: none">
        <div class="col-xs-2">
            <img height="85" width="85" src="<?php echo Yii::app()->createUrl('img/logo_unair.gif'); ?>"/>
        </div>
        <div class="col-xs-10">
            <div style="text-align: center" class="">
                <h4>TROPICAL DISEASE DIAGNOSTIC CENTER</h4>

                <address style="margin: 4px 0px" class="align-left">
                    Institute of Tropical Disease (Lembaga Penyakit Tropis)<br/>
                    Universitas Airlangga<br/>
                    Ex.Tropical Disease Center (TDC), Kampus C Unair, Jl.Mulyorejo Surabaya -60115<br/>
                    Telp. (031) 5992445-46, Fax. (031) 5992445 <br/>
                    Email : <span style="text-decoration: underline">sekretariat@itd.unair.ac.id</span> Website: <span style="text-decoration: underline">www.itd.unair.ac.id</span> <br/>
                </address>
            </div>
        </div>
    </div>
    <div class="row-fluid" style="margin: 120px 0px;">
        <div style="width:200px;position: absolute;top: 10px;right: 0px;text-align: right">
            <h4 style="font-size: 0.9em">F.05.10.01 Rev.0</h4>
        </div>
    </div>
    <h4 style="margin: 20px 0px;text-align: center">HASIL PEMERIKSAAN LABORATORIUM</h4>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-condensed ">
            <tr>
                <!--<td><b>Jenis Pasien</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien_tipe'] ?></td>
                -->
                <td><b>Nama Pasien</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien'] ?></td>
                <td><b>Umur</b> </td>
                <td> : <?php echo is_numeric($data_registrasi['umur']) ? "" . $data_registrasi['umur'] . " th " : $data_registrasi['umur']; ?></td>
            </tr>
            <tr>
                <td><b>Alamat Pasien</b> </td>
                <td> : <?php echo $data_registrasi['alamat_pasien'] ?></td>
                <td><b>Telephone</b> </td>
                <td> : <?php echo $data_registrasi['telephone'] ?> / <?php echo $data_registrasi['hp'] ?></td>
            </tr>
            <tr>
                <td><b>Dokter Pengirim</b> </td>
                <td> : <?php echo $data_registrasi['gelar_depan'] ?> <?php echo $data_registrasi['nama_dokter'] ?> <?php echo $data_registrasi['gelar_belakang'] ?></td>
                <td><b>No.Registrasi</b> </td>
                <td> : <?php echo $data_registrasi['no_registrasi'] ?></td>

            </tr>
            <tr>
                <td><b>Instansi Pengirim</b> </td>
                <td> : <?php echo $data_registrasi['nama_instansi'] ?></td>

                <td><b>Waktu Registrasi</b></td>
                <td> : <?php echo $data_registrasi['waktu_registrasi'] ?></td>
            </tr>
        </table>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-consended " style="width: 100%">
            <thead >
                <tr>
                   <!--<th style="text-align: center;width: 10%">No</th>-->
                    <th style="text-align: center;width: 40%;font-size:1.1em">Jenis Pemeriksaan</th>
                    <!--<th style="text-align: center;width: 10%">Bahan/Sample</th>-->
                    <th style="text-align: center;width: 30%;font-size:1.1em">Hasil</th>
                    <th style="text-align: center;width: 30%;font-size:1.1em">Nilai Normal</th>
                    <!--<th style="text-align: center;width: 20%">Keterangan </th>-->
                </tr>
            </thead>
            <tbody id="pemeriksaan-pembayaran-data-table ">
                <?php
                $no = 1;
                foreach ($data_pemeriksaan as $d):
                    $status_validasi = $d['status_validasi'];
                    ?>
                    <tr>
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
        <table class="table table-striped " style="width: 100%;height: 200px;position: fixed;bottom: 0px;left: 0px;">
            <tfoot>
                <tr>
                    <td style="border: none"></td>
                    <td style="border: none">

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;width: 60%;padding-left:100px">
                        <br/>
                        <div class="pull-left">
                            <div class="pull-right">
                                <p style="text-align: center">
                                    Catatan : <br/> <?php echo $d['keterangan_pemeriksaan']; ?>


                                    <br/>
                                    <br/>
                                    <img width="100" src="<?php echo Yii::app()->createUrl('img/qrcode/registrasi/'.$id_registrasi.'.png'); ?>">

                                    <br/>
                                    <br/>
                                    Dicetak Oleh :(<?php echo $user_login['nama_pegawai'] ?>)<br/>
                                <p style="text-align: right">Waktu : <?php echo date('Y-m-d H:i:s') ?></p>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: right;padding-left:10%;width: 30%">
                        <br/>
                        <div class="pull-left">
                            <p style="text-align: center">
                                Surabaya <?php echo $this->getDateIndo(date('Y-m-d')) ?><br/>
                                <b>Manajer Teknis</b>
                                <br/>
                                <?php if($status_validasi == 1) { ?>
                                <img height="147" width="274" src="<?php echo Yii::app()->createUrl('img/nrt-ttd.png'); ?>"/>
                                <?php } ?>
                                <br/>
                                (<?php echo $user_pj['gelar_depan'] . ' ' . $user_pj['nama_pegawai'] . ' ' . $user_pj['gelar_belakang'] ?>)
                            </p>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
<style>
    .container{
        font-size: 0.98em;
    }
    table.table-bordered tbody td{
        padding: 5px;
    }
</style>
