
<!--<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
           window.print();
        }, 1000);
    });

</script>-->

<div class="container" >
    <div class="row-fluid">
        <div class="col-xs-2">
            <img height="85" width="85" src="<?php echo Yii::app()->createUrl('img/logo_unair.gif'); ?>"/>
        </div>
        <div class="col-xs-10">
            <div style="text-align: center" class="small">
                <h4>TROPICAL DISEASE DIAGNOSTIC CENTER</h4>

                <address style="margin: 4px 0px" class="align-left">
                    Institute of Tropical Disease (Lembaga Penyakit Tropis)<br/>
                    Universitas Airlangga<br/>
                    Ex.Tropical Disease Center (TDC), Kampus C Unair, Jl.Mulyorejo Surabaya -60115<br/>
                    Telp. (031) 5992445-46, Fax. (031) 5992445 <br/>
                    Email : <span style="text-decoration: underline">sekretariat@itd.unair.ac.id</span> Website: <span style="text-decoration: underline">www.itd.unair.ac.id</span> <br/>
                </address>
            </div>

            <div style="width:200px;position: absolute;top: 10px;right: 0px;text-align: right">
                <h4 style="font-size: 0.9em">F.04.04.02 Rev.0</h4>
            </div>
        </div>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <h4 style="margin: 20px 0px">NOTA ORDER TEST LABORATORIUM</h4>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-condensed small">
            <tr>
                <td><b>Jenis Pasien</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien_tipe'] ?></td>
                <td><b>Umur</b> </td>
                <td> : <?php echo $data_registrasi['umur'] ?> Tahun</td>
            </tr>
            <tr>
                <td><b>Nama Pasien</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien'] ?> / <?php echo $data_registrasi['jenis_kelamin'] == 1 ? "Laki-laki" : "Perempuan" ?></td>
                <td><b>Telephone</b> </td>
                <td> : <?php echo $data_registrasi['telephone'] ?> / <?php echo $data_registrasi['hp'] ?></td>
            </tr>
            <tr>
                <td><b>Alamat Pasien</b> </td>
                <td> : <?php echo $data_registrasi['alamat_pasien'] ?></td>
                <td><b>No.Registrasi</b> </td>
                <td> : <?php echo $data_registrasi['no_registrasi'] ?></td>

            </tr>
            <tr>
                <td><b>Dokter Pengirim</b> </td>
                <td> : <?php echo $data_registrasi['gelar_depan'] ?> <?php echo $data_registrasi['nama_dokter'] ?> <?php echo $data_registrasi['gelar_belakang'] ?></td>
                <td><b>Waktu Registrasi</b></td>
                <td> : <?php echo $data_registrasi['waktu_registrasi'] ?></td>
            </tr>
            <tr>
                <td><b>Instansi Pengirim</b> </td>
                <td> : <?php echo $data_registrasi['nama_instansi'] ?></td>

            </tr>
        </table>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-striped small" style="width: 100%">
            <thead class="bg-info ">
                <tr>
                    <th style="text-align: center;width: 5%">No</th>
                    <th style="text-align: center;width: 30%">Pemeriksaan</th>
                    <th style="text-align: center;width: 15%">Bahan/Sample</th>
                    <th style="text-align: center;width: 15%">Selesai</th>
                    <th style="text-align: right;width: 10%">Pengujian</th>
                    <th style="text-align: right;width: 10%">Bahan</th>
                    <th style="text-align: right;width: 15%">Subtotal </th>
                </tr>
            </thead>
            <tbody id="pemeriksaan-pembayaran-data-table ">
                <?php
                $no = 1;
                $total_pasien_pemeriksaan = 0;
                foreach ($data_pemeriksaan as $d):
                    $total_tarif_pemeriksaan = 0;
                    ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $d['nama_pengujian'] ?></td>
                        <td>
                            <?php
                            $jumlah_bahan = 0;
                            $jumlah_pemeriksaan_bahan = 0;
                            $jumlah_tarif_bahan = 0;
                            $jumlah_pemeriksaan_sample = 0;
                            foreach ($d['data_sample'] as $ds) {
                                if ($ds['id_pemeriksaan_sample'] != '') {
                                    echo '- ' . $ds['nama_sample'] . ' ' . $ds['jumlah_sample'] . '<br/>';
                                    $jumlah_pemeriksaan_sample = $jumlah_pemeriksaan_sample + 1 * $ds['jumlah_sample'];
                                }
                            }
                            if ($jumlah_pemeriksaan_sample == 0) {
                                $jumlah_pemeriksaan_sample = 1;
                            }
                            foreach ($d['data_bahan'] as $db) {
                                if ($db['id_bahan_pengujian_pasien'] != '') {
                                    echo '- ' . $db['nama_bahan'] . ' ' . $db['jumlah_bahan'] . '<br/>';
                                    $jumlah_pemeriksaan_bahan = $jumlah_pemeriksaan_bahan + 1 * $db['jumlah_bahan'];
                                    $jumlah_tarif_bahan = $jumlah_tarif_bahan + $db['total_tarif'];
                                }
                            }
                            if ($jumlah_pemeriksaan_bahan == 0) {
                                $jumlah_pemeriksaan_bahan = 1;
                            }
                            $total_tarif_pemeriksaan = $d['besar_tarif'] * $jumlah_pemeriksaan_sample + $jumlah_tarif_bahan;
                            ?>
                        </td>
                        <td style="text-align: center"><?php echo $d['tgl_selesai']; ?></td>
                        <td style="text-align: right"><?php echo number_format($d['besar_tarif']) ?></td>
                        <td style="text-align: right"><?php echo number_format($jumlah_tarif_bahan) ?></td>
                        <td style="text-align: right"><?php echo number_format($total_tarif_pemeriksaan) ?></td>
                    </tr>
                    <?php
                    $no++;
                    $total_pasien_pemeriksaan += $total_tarif_pemeriksaan;
                endforeach;
                ?>
                <tr class="bg-success">
                    <td colspan="6" style="text-align: right">
                        <b>TOTAL</b>

                    </td>
                    <td style="text-align: right">
                        <b>Rp. <?php echo number_format($total_pasien_pemeriksaan) ?></b>

                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left">
                        <br/>
                        <div class="pull-left">
                            <p style="text-align: center">
                                <b>Catatan</b> : Hasil Diambil sendiri<br/>
                                Surabaya <?php echo $this->getDateIndo(date('Y-m-d')) ?><br/>
                                Hormat Kami<br/>
                                <br/>
                                <br/>
                                <br/>
                                (<b><?php echo $user_login['nama_pegawai'] ?></b>)
                            </p>
                        </div>
                    </td>
                    <td colspan="3" style="text-align: right">
                        <br/>
                        <div class="pull-right">
                            <table class="table table-condensed">
                                <tr>
                                    <td><b>Biaya Tes</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($total_pasien_pemeriksaan) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Biaya Tambahan</b></td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php
                                $total_biaya_tambahan = 0;
                                foreach ($data_biaya_tambahan as $bt):
                                    ?>
                                    <tr>
                                        <td><?php echo $bt['nama_biaya'] ?></td>
                                        <td>= Rp. </td>
                                        <td style="text-align: right"><?php echo number_format($bt['besar_biaya']) ?></td>
                                    </tr>
                                    <?php
                                    $total_biaya_tambahan+=$bt['besar_biaya'];
                                endforeach;
                                ?>
                                <tr>
                                    <td><b>Potongan</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['potongan'] + $potongan_pemeriksaan) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Total Biaya</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($total_pasien_pemeriksaan + $total_biaya_tambahan - ($data_pembayaran['potongan'] + $potongan_pemeriksaan)) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Dibayar</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_dibayar']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Kekurangan</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($total_pasien_pemeriksaan + $total_biaya_tambahan - $data_pembayaran['total_dibayar'] - $data_pembayaran['potongan'] - $potongan_pemeriksaan) ?></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
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
