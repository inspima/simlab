
<!--<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
           window.print();
        }, 1000);
    });

</script>-->
<div class="container" >
    <div class="row-fluid">
        <div class="col-xs-2"  style="display: none">
            <img style="width: 77px;height: 77px" src="<?php echo Yii::app()->createUrl('img/logo_unair.gif'); ?>"/>
        </div>
        <div class="col-xs-12" style="margin: 0px 0px;padding: 0px">
            <div style="text-align: left" class="small">
                <h6>TROPICAL DISEASE DIAGNOSTIC CENTER</h6>

                <address style="margin: 4px 0px;text-align: left" class="align-left">
                    Universitas Airlangga, Kampus C Unair, Jl.Mulyorejo Surabaya -60115<br/>
                    Telp. (031) 5992445-46, Fax. (031) 5992445 ,Email : <span style="text-decoration: underline">sekretariat@itd.unair.ac.id</span> Website: <span style="text-decoration: underline">www.itd.unair.ac.id</span> <br/>
                </address>
            </div>
            
            <div style="width:200px;position: absolute;top: 10px;right: 0px;text-align: right">
                <h4 style="font-size: 0.9em">F.04.04.03 Rev.0</h4>
            </div>
        </div>
    </div>
    <div class="row-fluid" style="margin: 0px 0px;"></div>
    <hr style="border: 1px solid black;margin: 0px 0px"/>
    <h6 style="margin: 10px 0px">KWITANSI PEMBAYARAN TEST LABORATORIUM</h6>
    <div class="row-fluid" style="margin: 5px 0px;"></div>
    <div class="row-fluid" style="margin: 0px">
        <table class="table table-condensed small">
            <tr>
                <td style="width: 30%"><b>No Kwitansi</b> </td>
                <td colspan="3"> : <?php echo str_pad($no_kwitansi_cetak, 10, 0, STR_PAD_LEFT); ?></td>
            </tr>
            <tr>
                <td><b>Terima Dari Yth</b> </td>
                <td  colspan="3"> : <?php echo $data_registrasi['nama_pasien'] ?> <?php echo is_numeric($data_registrasi['umur']) ? " / " . $data_registrasi['umur']." th /" : $data_registrasi['umur']; ?> <?php echo $data_registrasi['nama_instansi'] != "" ? "" . $data_registrasi['nama_instansi'] : ""; ?>
            </tr>
            <tr>
                <td><b>Jumlah Pembayaran</b> </td>
                <td colspan="3"> : #<i><?php echo $terbilang_pembayaran ?> rupiah </i>#</td>
            </tr>
            <tr>
                <td  colspan="4">
                    Untuk untuk pembayaran <?php echo $data_registrasi['status_pembayaran'] == 1 ? "Registrasi" : "Pelunasan"; ?> Order Test Lab 
                    No <?php echo $data_registrasi['no_registrasi'] ?> dengan rincian Sbb
                </td>
            </tr>

        </table>
    </div>
    <div class="row-fluid" style="margin: 0px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <div class="row-fluid" style="margin: 0px 0px;"></div>
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
                                    echo '- ' . $db['nama_bahan'] .' '. $db['jumlah_bahan'] . '<br/>';
                                    $jumlah_pemeriksaan_bahan = $jumlah_pemeriksaan_bahan + 1 * $db['jumlah_bahan'];
                                    $jumlah_tarif_bahan = $jumlah_tarif_bahan + $db['total_tarif'];
                                }
                            }
                            if ($jumlah_pemeriksaan_bahan == 0) {
                                $jumlah_pemeriksaan_bahan = 1;
                            }
                            $total_tarif_pemeriksaan =$d['besar_tarif'] * $jumlah_pemeriksaan_sample+$jumlah_tarif_bahan;
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
                    <td colspan="4" style="text-align: left;">
                        <br/>
                        <div class="pull-left">
                            <p style="text-align: center;font-size: 0.97em">
                                <b>Terbilang</b> : Rp. <?php echo number_format($data_pembayaran['total_dibayar']) ?><br/>
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
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['potongan']+$potongan_pemeriksaan) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Total Biaya</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_biaya']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Dibayar</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_dibayar']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Kekurangan</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_biaya'] -$data_pembayaran['potongan']- $data_pembayaran['total_dibayar']) ?></td>
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
    table tbody td{
        padding: 2px;
    }
</style>
