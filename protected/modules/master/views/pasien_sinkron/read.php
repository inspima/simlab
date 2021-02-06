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
                <form class="form-horizontal form-validation" method="post" style="width: 90%">
                    <table class="table table-bordered" style="width:35%">
                        <tr>
                            <td>Tanggal Registrasi</td>
                            <td><input type="text" class="span2 datepicker validate[required]" name="awal" value="<?php if ($awal == null) {
                                    echo date('Y-m-d');
                                } else {
                                    echo $awal;
                                } ?>"></td>
                            <td>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
                            ?>
                            <tr>
                                <td><?php echo $d['code'] ?></td>
                                <td><?php echo $d['type']=='Individu'?'Individu':$d['org_name'] ?></td>
                                <td><?php echo $d['name'] ?></td>
                                <td><?php echo $d['id_number'] ?></td>
                                <td><?php echo $d['test_loop'] ?></td>
                                <td><?php echo date('d-m-Y', strtotime($d['born_date'])) . " (" . $d['age'] . ")"; ?></td>
                                <td><?php if ($d['gender'] == 1) {
                                        echo "Laki - Laki";
                                    } else if ($d['gender'] == 2) {
                                        echo "Perempuan";
                                    } else {
                                        echo "NOT SET";
                                    } ?></td>
                                <td><?php echo $d['address'] ?></td>
                                <td><?php echo $d['phone'] . ", " . $d['mobile'] ?></td>
                                <td style="width: 120px;text-align: center">

                                    <p>
                                        <?php if ($this->cekData($d['id']) >= 1) {
                                            echo '<div class="btn btn-success" ><b>Registered</b></div>';
                                        } ?>
                                    </p>
                                </td>
                                <td>
                                    <?php
                                        if ($this->cekData($d['id']) == 0) {
                                            ?>
                                            <form method="post" action="">
                                                <button type="submit" class="btn btn-primary">Sinkron</button>
                                                <input type="hidden" name="mode" value="sinkron"/>
                                                <input type="hidden" name="id" value="<?= $d['id'] ?>"/>
                                                <input type="hidden" name="awal" value="<?= $awal ?>"/>
                                            </form>
                                            <?php
                                        }
                                    ?>

                                </td>
                            </tr>
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
                [ 9, "asc" ],
                [ 0, "desc" ]
            ]
        });

    });
</script>