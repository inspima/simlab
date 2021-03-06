
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
    <h4 style="text-align: right">Lembar 1 : Untuk PFL</h4>
    <h4 style="margin: 20px 0px">DESKRIPSI PENGGUNA FASILITAS LABORATORIUM</h4>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <div class="row-fluid">
        <table class="table table-condensed small">
            <tr>
                <td><b>No Registrasi</b> </td>
                <td> : <?php echo $data_registrasi['no_kwitansi_daftar'] ?></td>
                <td><b>Instansi Asal</b> </td>
                <td> : <?php echo $data_registrasi['instansi_asal'] ?></td>
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

                <td><b>Tgl Surat Masuk & Tgl Masuk Sistem</b> </td>
                <td> : <?php echo $data_registrasi['tgl_surat_daftar'] ?> / <?php echo $data_registrasi['tgl_order_masuk'] ?></td>
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
            <tr>
                <td><b>Status Penelitian</b> </td>
                <td> : <?php echo $data_registrasi['status_team_penelitian'] == 1 ? "Single" : "Group" ?></td>
                <td><b>Data Anggota</b></td>
                <td> : 
                    <ol style="display: inline-block;margin-left: 0px;padding-left: 16px">
                        <?php
                        if (count($data_anggota > 0)) {
                            $no = 1;
                            foreach ($data_anggota as $da) {
                                echo "<li>" . $da['nama_anggota'] . "</li>";
                                $no++;
                            }
                        }
                        ?>
                    </ol>
                </td>
            </tr>
        </table>
    </div>
    <div class="row-fluid" style="margin: 10px 0px;"></div>
    <?php if (count($data_pasien_penyewaan) > 0) {
        ?>
        <hr style="border: 1px solid black;margin: 10px 0px"/>
        <h4 style="margin: 20px 0px">PEMAKAIAN FASILITAS</h4>
        <div class="row-fluid" style="margin: 10px 0px;">
            <table class="table table-condensed small" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: center">Nama Fasilitas</th>
                        <th style="text-align: center">Lama/Jumlah Pemakaian</th>
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
                        </tr>
                        <?php
                        $no++;
                        $total_fasilitas+=$dr['besar_tarif'];
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    ?>
    <div class="row-fluid">
        <div class="row-fluid" style="margin: 10px 0px;"></div>
        <table class="table table-condensed" style="width: 100%">
            <tr>
                <td style="text-align: left">
                    <br/>
                    <div class="pull-left">
                        <p style="text-align: center">
                            Surabaya <?php echo $this->getDateIndo(date('Y-m-d')) ?><br/>
                            Hormat Kami<br/>
                            <br/>
                            <br/>
                            <br/>
                            (<b><?php echo $user_login['nama_pegawai'] ?></b>)
                        </p>
                    </div>
                </td>
                <td style="text-align: left">
                    <br/>
                    <b>Catatan Khusus :</b>
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
