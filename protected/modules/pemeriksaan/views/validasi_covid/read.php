<?php
include 'breadcumbs.php';
?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Data Registrasi Pemeriksaan TDDC </h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Registrasi Pemeriksaan Pasien TDDC</h2>
                <form style="margin: 20px" class="form-inline" role="form">
                    <div class="control-group-group">
                        <label class="sr-only" for="unit">Pilih Tgl Pengujian : </label>
                        <input type="date" class="span2 datepicker validate[required]" name="tgl" value="<?php if($tgl == null) {echo date('Y-m-d');} else {echo $tgl;}?>">
                        
                    </div>   
                    <p>&nbsp;</p>
                    <div class="control-group-group">
                        <label class="sr-only" for="unit">Atau Cari berdasarkan Nama : </label>
                         <input type="nama" class="" name="nama" value="">
                   
                    </div>   
                    <br />
                        <button type="submit" class="btn btn-default">Tampilkan</button>
                </form>
                <?php
                if (!empty($data_pasien)) {
                    ?>
                    <table style="margin :10px 0px" id="registrasi-pemeriksaan-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No Registrasi/Order</th>
                                <th>Waktu Order</th>
                                <th>Nama pasien</th>
                                <th>Status Pemeriksaan</th>
                                <th>Status Validasi</th>
                                <th>Validasi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No Registrasi/Order</th>
                                <th>Waktu Order</th>
                                <th>Nama pasien</th>
                                <th>Status Pemeriksaan</th>
                                <th>Status Validasi</th>
                                <th>Validasi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($data_pasien as $d):
                                ?>
                                <tr>
                                    <td><?php echo $d['no_registrasi'] ?></td>
                                    <td><?php echo $d['waktu_registrasi'] ?></td>
                                    <td>
                                        <?php echo $d['nama'] ?><br/>
                                        <b>Instansi : </b><?php echo $d['nama_instansi'] ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($d['status_registrasi'] == 0) {
                                            ?>
                                            <span class="btn btn-info">Baru</span>
                                            <?php
                                        } else if ($d['status_registrasi'] == 1) {
                                            ?>
                                            <span class="btn btn-warning">Proses Pengujian</span>
                                            <?php
                                        } else if ($d['status_registrasi'] == 2) {
                                            ?>
                                            <span class="btn btn-success">Sudah Selesai</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($d['status_validasi'] == 0) {
                                            ?>
                                            <span class="btn btn-danger">Belum Valid</span>
                                            <?php
                                        } else if ($d['status_validasi'] == 1) {
                                            ?>
                                            <span class="btn btn-success">Valid</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 50px;text-align: center">
                                        <div>
                                            <a class="btn" title="Lihat Sample" href="<?php echo Yii::app()->createUrl('pemeriksaan/validasi_covid/input?reg=' . $d['id_registrasi_pemeriksaan']); ?>" ><i class=" icon-list-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('#registrasi-pemeriksaan-datatable').dataTable({
            "lengthChange": true,
            "bSort": false
        });

    });
</script>