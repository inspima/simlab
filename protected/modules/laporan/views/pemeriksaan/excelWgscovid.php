<?php

    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
    header("Content-disposition: attachment; filename=lap-wgs-covid.xls");

?>
<div class="container">
    <table rules="all" cellspacing="0" border="1" width="100%">
        <thead>
        <tr>
            <td valign="top">
                <div align="center"><strong>No</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>ID Registrasi</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Waktu Registrasi</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Sampel</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Nama Pasien</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Alamat</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Gender</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Umur</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Nama Instansi</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Kota</strong></div>
            </td>
            <td valign="top">
                <div align="center"><strong>Hasil</strong></div>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            foreach ($data as $d):
                $id_reg = $d['id_registrasi_pemeriksaan'];
                ?>
                <tr>
                    <td><span class="style3"><?php echo $no; ?></span></td>
                    <td><span class="style3"><?php echo $d['id_registrasi_pemeriksaan'] ?> </span></td>
                    <td><span class="style3"><?= $d['waktu_registrasi'] ?></span></td>
                    <td><span class="style3"><?= $d['sample'] ?></span></td>
                    <td><span class="style3"><?= $d['nama'] ?></span></td>
                    <td><span class="style3"><?= $d['alamat'] ?></span></td>
                    <td><span class="style3"><?= $d['kelamin'] ?></span></td>
                    <td><span class="style3"><?= ($d['umur']) ?></span></td>
                    <td><span class="style3"><?= $d['nama_instansi'] ?></span></td>
                    <td><span class="style3"><?= $d['nama_kota'] ?></span></td>
                    <td><span class="style3"><?= $d['hasil_pengujian'] ?></span></td>
                </tr>

                <?php $no++;
            endforeach;
        ?>

        </tbody>
    </table>
    </fieldset>
    </form>
</div>

</div> <!-- /widget-content -->
</div> <!-- /widget -->
</div> <!-- /spa12 -->
</div> <!-- /row -->

<style type="css">
    #thead {
        display: table-header-group;
    }

    #tfoot {
        display0: table-footer-group;
    }

</style>




