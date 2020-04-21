
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
        </div>
    </div>
    <div class="row-fluid" style="margin: 0px 0px;"></div>
    <hr style="border: 1px solid black;margin: 0px 0px"/>
    <h6 style="margin: 5px 0px">KWITANSI PEMBAYARAN <?php echo $data_pembayaran['status_pembayaran'] == 1 ? "REGISTRASI" : "PELUNASASN" ?> PEMAKAIAN FASILITAS</h6>
    <div class="row-fluid" style="margin: 0px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-condensed small">
            <tr>
                <td style="width: 20%"><b>No.Kwitansi</b> </td>
                <td style="width: 30%"> : <?php echo str_pad($no_kwitansi_cetak, 10, 0, STR_PAD_LEFT); ?></td>
                <td style="width: 20%"><b>No.<?php echo $data_pembayaran['status_pembayaran'] == 1 ? "Registrasi" : "Pelunasan" ?></b>  </td>
                <td style="width: 30%"> : <?php echo $data_pembayaran['status_pembayaran'] == 1 ? $data_registrasi['no_kwitansi_daftar'] : $data_pembayaran['no_kwitansi_pembayaran'] ?></td>
            </tr>
            <tr>
                 <td><b>Nama Pemohon</b> </td>
                <td> : <?php echo $data_registrasi['nama_penanggung_jawab'] ?></td>
                <td><b>Alamat Pemohon</b> </td>
                <td> : <?php echo $data_registrasi['alamat_saat_ini'] ?></td>
                
            </tr>
            <tr>
                <td><b>Instansi Asal</b> </td>
                <td> : <?php echo $data_registrasi['nama_instansi']==''?$data_registrasi['instansi_asal']:$data_registrasi['nama_instansi'] ?></td>
                <td><b>Telp/HP</b> </td>
                <td> : <?php echo $data_registrasi['no_telp'] ?> / <?php echo $data_registrasi['no_hp'] ?></td>
            </tr>
            <tr>
                <td><b>Jenis Penelitian</b> </td>
                <td> : <?php echo $data_registrasi['nama_pasien_tipe'] ?></td>
                <td><b>ID PFL</b></td>
                <td> : <?php echo $data_registrasi['no_registrasi_penyewaan'] ?></td>
            </tr>
            <tr>
                <td><b>Tanggal Registrasi</b></td>
                <td colspan="3"> : <?php echo $data_registrasi['tgl_order_masuk'] ?></td>
            </tr>
        </table>

    </div>
    <!-- DIHILANGKAN BU YANI REVISI
    <div class="row-fluid" style="margin: 4px 0px;"></div>
    <?php if (count($data_pasien_penyewaan) > 0) {
        ?>
        <hr style="border: 1px solid black;margin: 10px 0px"/>
        <div class="row-fluid" style="margin: 10px 0px;">
            <table class="table table-condensed small">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: center">Nama Fasilitas</th>
                        <th style="text-align: center">Lama/Jumlah Pemakaian</th>
                        <th style="text-align: center">Tarif Pemakaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_fasilitas = 0;
                    foreach ($data_pasien_penyewaan as $dr) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $dr['nama_barang'] ?></td>
                            <td style="text-align: center"><?php echo $dr['lama_sewa']; ?></td>
                            <td style="text-align: right"><?php echo number_format($dr['besar_tarif']) ?></td>
                        </tr>
                        <?php
                        $no++;
                        $total_fasilitas+=$dr['besar_tarif'];
                    }
                    ?>
                    <tr>
                        <td colspan="3" style="text-align: center">
                            <b>TOTAL</b>
                        </td>
                        <td style="text-align: right">Rp. <?php echo number_format($total_fasilitas) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
    }
    ?>
    -->
    <hr style="border: 1px solid black;margin: 4px 0px"/>
    <div class="row-fluid">
        <table class="table table-condensed small" style="width: 100%;">
            <tr>
                <td style="width: 20%;te"><b>Sudah Diterima Dari</b></td>
                <td style="width: 5%">:</td>
                <td style="width: 75%"><?php echo $data_registrasi['nama_penanggung_jawab'] ?></td>
            </tr>
            <tr>
                <td><b>Jumlah Pembayaran</b></td>
                <td>:</td>
                <td>#<i><?php echo $total_terbilang ?> rupiah</i> #</td>
            </tr>
            <tr>
                <td><b>Untuk Pembayaran</b></td>
                <td>:</td>
                <td>
                    <p style="font-size: 0.9em">Biaya pemakaian fasilitas laboratorium di Lembaga Penyakit Tropis Universitas Airlangga</p>
                    <table class="table-condensed">
                        <?php
                        $no = 1;
                        foreach ($data_pembayaran_detail as $dp) {
                            ?>
                            <tr>
                                <td><?php echo $no ?>. <?php echo $dp['nama_biaya'] ?></td>
                                <td>= Rp. </td>
                                <td style="text-align: right"><?php echo number_format($dp['besar_biaya']) ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </table>
                </td>
            </tr>

        </table>
        <div class="row-fluid" style="margin: 0px 0px;"></div>
        <hr style="border: 1px solid black;margin: 5px 0px"/>
        <div class="row-fluid" style="margin: 0px 0px;"></div>
        <table class="table table-condensed" style="width: 100%">
            <tr>
                <td colspan="2" style="text-align: left">
                    <br/>
                    <b>Terbilang </b> Rp. <?php echo number_format($data_pembayaran['total_dibayar']) ?>
                </td>
                <td style="text-align: right">
                    <br/>
                    <div class="pull-right">
                        <p style="text-align: center;font-size: 0.9em">
                            Surabaya <?php echo $this->getDateIndo(date('Y-m-d')) ?><br/>
                            Hormat Kami<br/>
                            <br/>
                            <br/>
                            <br/>
                            (<b><?php echo $user_login['nama_pegawai'] ?></b>)
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</div>
<style>
    .container{
        font-size: 0.9em;
    }
    table.table-bordered tbody td{
        padding: 5px;
    }
</style>
