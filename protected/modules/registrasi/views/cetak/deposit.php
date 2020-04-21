
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
    <h4 style="margin: 20px 0px">BUKTI BAYAR DEPOSIT PEMAKAIAN FASILITAS</h4>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <div class="col-xs-12">
            <table class="table table-condensed small">
                <tr>
                    <td><b>No Registrasi</b> </td>
                    <td> : <?php echo $data_registrasi['no_registrasi_penyewaan'] ?></td>
                    <td><b>Intansi Asal</b> </td>
                    <td> : <?php echo $data_registrasi['nama_instansi'] ?></td>
                </tr>
                <tr>
                    <td><b>Nama Pemohon</b> </td>
                    <td> : <?php echo $data_registrasi['nama_penanggung_jawab'] ?></td>

                    <td><b>Tgl & No.Surat Permohonan</b> </td>
                    <td> : <?php echo $data_registrasi['tgl_surat_permohonan'] ?> / <?php echo $data_registrasi['no_surat_permohonan'] ?></td>
                </tr>
                <tr>
                    <td><b>Alamat Pemohon</b> </td>
                    <td> : <?php echo $data_registrasi['alamat_saat_ini'] ?></td>

                    <td><b>Tgl & No.Surat Daftar </b> </td>
                    <td> : <?php echo $data_registrasi['tgl_surat_daftar'] ?> / <?php echo $data_registrasi['no_surat_daftar'] ?></td>
                </tr>
                <tr>
                    <td><b>Telp/HP</b> </td>
                    <td> : <?php echo $data_registrasi['no_telp'] ?> / <?php echo $data_registrasi['no_hp'] ?></td>
                    <td><b>Jenis Penelitian</b> </td>
                    <td> : <?php echo $data_registrasi['nama_pasien_tipe'] ?></td>
                </tr>
                <tr>
                    <td><b>Status Perpanjangan</b> </td>
                    <td> : <?php echo $data_registrasi['status_perpanjangan'] == 1 ? "Baru" : "Perpanjangan" ?></td>
                    <td><b>Tanggal Registrasi</b></td>
                    <td> : <?php echo $data_registrasi['tgl_order_masuk'] ?></td>
                </tr>
            </table>

        </div>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <hr style="border: 1px solid black;margin: 10px 0px"/>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
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
                <td>#<i><?php echo $total_terbilang ?></i>#</td>
            </tr>
            <tr>
                <td><b>Untuk Pembayaran</b></td>
                <td>:</td>
                <td>
                    <p>Biaya pendaftaran pemakaian fasilitas laboratorium di Lembaga Penyakit Tropis Universitas Airlangga</p>
                    <table class="table-condensed">
                        <tr>
                            <td>1. Bench fee Deposit <?php echo $data_registrasi['nama_biaya'] ?> dalam bulan</td>
                            <td>=Rp. </td>
                            <td style="text-align: right"><?php echo number_format($data_registrasi['besar_deposit']) ?></td>
                        </tr>
                        <tr>
                            <td>2. Biaya Administrasi</td>
                            <td>=Rp. </td>
                            <td style="text-align: right"><?php echo number_format($data_registrasi['besar_biaya_administrasi']) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        <div class="row-fluid" style="margin: 10px 0px;"></div>
        <hr style="border: 1px solid black;margin: 10px 0px"/>
        <div class="row-fluid" style="margin: 10px 0px;"></div>
        <table class="table table-condensed" style="width: 100%">
            <tr>
                <td colspan="2" style="text-align: left">
                    <br/>
                    <b>Terbilang </b> Rp. <?php echo number_format($data_registrasi['besar_deposit'] + $data_registrasi['besar_biaya_administrasi']) ?>
                </td>
                <td style="text-align: right">
                    <br/>
                    <div class="pull-right">
                        <p style="text-align: center">
                            Surabaya <?php echo date('d-F-Y') ?><br/>
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
        font-size: 0.98em;
    }
    table.table-bordered tbody td{
        padding: 5px;
    }
</style>
