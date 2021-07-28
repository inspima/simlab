
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Laporan WGS Covid-19
                    <?php if ((!empty($awal)) && (!empty($akhir))) {
                        echo '  (Per : ' . $this->TanggalToIndo($awal) . " - " . $this->TanggalToIndo($akhir) . ")";
                    } ?>
                </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">

                <form class="form-horizontal form-validation" method="post">
                    <fieldset>
                        Tanggal :
                        <input type="text" class="span2 datepicker validate[required]" name="awal" value="<?= $awal == null ? date('Y-m-d') : $awal; ?>">
                        Sampai:
                        <input type="text" class="span2 datepicker validate[required]" name="akhir" value="<?= $akhir == null ? date('Y-m-d') : $akhir; ?>">
                        <button type="submit" class="btn btn-primary"><i class="icon icon-ok"></i> Tampilkan</button>
                        <?php if (count($data) > 0) {
                            echo '<a class="btn btn-s" target="_blank" href="' . Yii::app()->createUrl("laporan/pemeriksaan/ExcelWgscovid?b=$awal&e=$akhir") . '"><i class="icon-arrow-down"></i>&nbsp;&nbsp;Download Excel</a>';
                        } ?>
                        <hr/>
                        <table style="margin :10px 0px;width: 100%" id="dokter-datatable bg" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th valign="top">
                                    <div align="center"><strong>No</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>ID Registrasi</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Waktu Registrasi</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Sampel</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Nama Pasien</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Alamat</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Gender</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Umur</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Nama Instansi</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Kota</strong></div>
                                </th>
                                <th valign="top">
                                    <div align="center"><strong>Hasil</strong></div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (count($data) > 0) {
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
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="11" style="text-align: center"><b style="color: red;">Data Kosong</b></td>
                                    </tr>
                                    <?php
                                }

                            ?>

                            </tbody>

                        </table>
                        <br/>
                    </fieldset>
                </form>
            </div> <!-- /controls -->
        </div> <!-- /control-group -->
    </div>

</div> <!-- /widget-content -->

<?php
    include 'plugins.php';
?>
<script>
    $(document).ready(function () {
        $('#rekanan-datatable').dataTable({
            "lengthChange": true,
        });
        $('#rekanan-datatable tbody').on('click', '.rekanan-delete-button', function () {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('master/unit/delete'); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function (data) {
                        window.location.reload();
                    }
                });
        });
    });
</script>



