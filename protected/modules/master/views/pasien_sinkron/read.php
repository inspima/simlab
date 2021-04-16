<?php
    include 'breadcumbs.php';
    //var_dump($pasien_sinkron);

?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master - Data Pasien Antrian SIMLAB</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">
                <h2>Data Antrian Pasien</h2>
                <form class="form-horizontal form-validation" method="get" style="width: 98%">
                    <table class="table table-condensed" style="width:100%">
                        <tr>
                            <td style="text-align: center">
                                <b>Status Sinkronisasi</b>
                                <br/>
                                <select style="margin-top: 10px" name="sinkron">
                                    <option value="0" <?=$sinkron=='0'?'selected':''?>>Belum</option>
                                    <option value="1" <?=$sinkron=='1'?'selected':''?>>Sudah</option>
                                </select>
                                <hr/>
                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                                <hr/>
                            </td>
                        </tr>
                    </table>

                </form>
                <table style="margin :10px 0px" id="pasien-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Kode Reg</th>
                        <th>Asal</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Test</th>
                        <th>Tgl Lahir (Umur)</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Telephone, HP</th>
                        <th>-</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Kode Reg</th>
                        <th>Asal</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Test</th>
                        <th>Tgl Lahir (Umur)</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Telephone, HP</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        foreach ($pasien_sinkron as $d):
                            $status_sinkron = $this->cekData($d['id']) >= 1 ? true : false;
                            if ($sinkron == '0') {
                                if (!$status_sinkron) {
                                    ?>
                                    <tr>
                                        <td><?php echo $d['code'] ?></td>
                                        <td><?php echo $d['type'] == 'Individu' ? 'Individu' : $d['org_name'] ?></td>
                                        <td><?php echo $d['name'] ?></td>
                                        <td><?php echo $d['id_number'] ?></td>
                                        <td><?php echo $d['test_loop'] ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($d['born_date'])) . " (" . $d['age'] . ")"; ?></td>
                                        <td><?php if ($d['gender'] == 1 || $d['gender'] == 'Laki-Laki') {
                                                echo "Laki - Laki";
                                            } else if ($d['gender'] == 2 || $d['gender'] == 'Perempuan') {
                                                echo "Perempuan";
                                            } else {
                                                echo "NOT SET";
                                            } ?></td>
                                        <td><?php echo $d['address'] ?></td>
                                        <td><?php echo $d['phone'] . ", " . $d['mobile'] ?></td>
                                        <td style="width: 120px;text-align: center">

                                            <p>
                                                <?php if ($status_sinkron) {
                                                    echo '<div class="btn btn-success" ><b>Registered</b></div>';
                                                } ?>
                                            </p>
                                        </td>
                                        <td>
                                            <?php
                                                if (!$status_sinkron) {
                                                    ?>
                                                    <form method="post" action="">
                                                        <button type="submit" class="btn btn-primary">Sinkron</button>
                                                        <input type="hidden" name="mode" value="sinkron"/>
                                                        <input type="hidden" name="id" value="<?= $d['id'] ?>"/>
                                                    </form>
                                                    <?php
                                                }
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                if ($status_sinkron) {
                                    ?>
                                    <tr>
                                        <td><?php echo $d['code'] ?></td>
                                        <td><?php echo $d['type'] == 'Individu' ? 'Individu' : $d['org_name'] ?></td>
                                        <td><?php echo $d['name'] ?></td>
                                        <td><?php echo $d['id_number'] ?></td>
                                        <td><?php echo $d['test_loop'] ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($d['born_date'])) . " (" . $d['age'] . ")"; ?></td>
                                        <td><?php if ($d['gender'] == 1 || $d['gender'] == 'Laki-Laki') {
                                                echo "Laki - Laki";
                                            } else if ($d['gender'] == 2 || $d['gender'] == 'Perempuan') {
                                                echo "Perempuan";
                                            } else {
                                                echo "NOT SET";
                                            } ?></td>
                                        <td><?php echo $d['address'] ?></td>
                                        <td><?php echo $d['phone'] . ", " . $d['mobile'] ?></td>
                                        <td style="width: 120px;text-align: center">

                                            <p>
                                                <?php if ($status_sinkron) {
                                                    echo '<div class="btn btn-success" ><b>Registered</b></div>';
                                                } ?>
                                            </p>
                                        </td>
                                        <td>
                                            <?php
                                                if (!$status_sinkron) {
                                                    ?>
                                                    <form method="post" action="">
                                                        <button type="submit" class="btn btn-primary">Sinkron</button>
                                                        <input type="hidden" name="mode" value="sinkron"/>
                                                        <input type="hidden" name="id" value="<?= $d['id'] ?>"/>
                                                    </form>
                                                    <?php
                                                }
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
    include 'plugins.php';
?>
<script>
    $(document).ready(function () {
        $('#pasien-datatable').dataTable({
            "lengthChange": true,
            "order": [
                [9, "asc"],
                [0, "desc"]
            ]
        });

    });
</script>