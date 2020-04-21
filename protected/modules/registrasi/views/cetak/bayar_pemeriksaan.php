
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
        </div>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <h4 style="margin: 20px 0px">KWITANSI PEMBAYARAN TEST LABORATORIUM</h4>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-condensed small">
            <tr>
                <td><b>No Kwitansi</b> </td>
                <td> : <?php echo str_pad($data_pembayaran['id_pembayaran_pemeriksaan'], 7, 0, STR_PAD_LEFT) ?></td>
                <td><b>Waktu Pembayaran</b> </td>
                <td> : <?php echo $data_pembayaran['waktu_pembayaran'] ?></td>
            </tr>
            <tr>
                <td><b>Jenis Pasien</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien_tipe'] ?> / <?php echo $data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan" ?></td>
                <td><b>Umur</b> </td>
                <td> : <?php echo $data_registrasi['umur'] ?> Tahun</td>
            </tr>
            <tr>
                <td><b>Nama Pasien</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien'] ?></td>
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
                <td> : <?php echo $data_registrasi['nama_dokter'] ?></td>
                <td><b>Waktu Registrasi</b></td>
                <td> : <?php echo $data_registrasi['waktu_registrasi'] ?></td>
            </tr>
            <tr>
                <td><b>Instansi Pengirim</b> </td>
                <td> : <?php echo $data_registrasi['nama_instansi'] ?></td>
                <td><b>Jenis Pembayaran</b></td>
                <td> : <?php echo $data_pembayaran['via_pembayaran']==1?"Tunai":"EDC" ?></td>
            </tr>
            <tr>
                <td><b>Jumlah Pembayaran</b> </td>
                <td colspan="3"> : #<i><?php echo $terbilang_pembayaran ?></i>#</td>
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
                    <th style="text-align: center;width: 40%">Jenis Pemeriksaan</th>
                    <th style="text-align: center;width: 10%">Bahan/Sample</th>
                    <th style="text-align: center;width: 10%">Selesai</th>
                    <th style="text-align: center;width: 10%">Harga</th>
                    <th style="text-align: center;width: 10%">Jumlah</th>
                    <th style="text-align: center;width: 15%">Subtotal </th>
                </tr>
            </thead>
            <tbody id="pemeriksaan-pembayaran-data-table ">
                <?php
                $no = 1;
                $total_pemeriksaan = 0;
                foreach ($data_pemeriksaan as $d):
                    ?>
                    <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $d['nama_pengujian'] ?></td>
                        <td>
                            <?php
                            $jumlah_bahan =0;
                            foreach ($d['data_sample'] as $ds) {
                                if ($ds['id_pemeriksaan_sample'] != '') {
                                    echo '- ' . $ds['nama_sample'] . '<br/>';
                                    $jumlah_bahan++;
                                }
                            }
                            if($jumlah_bahan==0){
                                $jumlah_bahan=1;
                            }
                            ?>
                        </td>
                        <td style="text-align: center"><?php echo $d['tgl_selesai']; ?></td>
                        <td style="text-align: center"><?php echo number_format($d['tarif_pengujian']); ?></td>
                        <td style="text-align: center"><?php echo $jumlah_bahan ?></td>
                        <td style="text-align: right"><?php echo number_format($d['besar_tarif']*$jumlah_bahan) ?></td>
                    </tr>
                    <?php
                    $no++;
                    $total_pemeriksaan+=$d['besar_tarif']*$jumlah_bahan;
                endforeach;
                ?>
                <tr class="bg-success">
                    <td colspan="6" style="text-align: right">
                        <b>TOTAL</b>

                    </td>
                    <td style="text-align: right">
                        <b>Rp. <?php echo number_format($total_pemeriksaan) ?></b>

                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: left">
                        <br/>
                        <div class="pull-left">
                            <p style="text-align: center">
                                <b>Terbilang</b> : Rp. <?php echo number_format($data_pembayaran['total_dibayar']) ?><br/><br/>
                                Surabaya <?php echo date('d-F-Y') ?><br/>
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
                                    <td style="text-align: right"><?php echo number_format($total_pemeriksaan) ?></td>
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
                                    <td><b>Total Biaya</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_biaya']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Potongan</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['potongan']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Dibayar</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_dibayar']) ?></td>
                                </tr>
                                <tr>
                                    <td><b>Kekurangan</b></td>
                                    <td>= Rp. </td>
                                    <td style="text-align: right"><?php echo number_format($data_pembayaran['total_biaya']-$data_pembayaran['total_dibayar']) ?></td>
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
