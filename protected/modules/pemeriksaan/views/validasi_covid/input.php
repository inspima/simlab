<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Validasi Hasil Pasien Pemeriksaan</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Pasien Pemeriksaan</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('pemeriksaan/validasi_covid/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                    <fieldset>
                        <table id="pasien-pemeriksaan-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengujian</th>
                                    <th>Sample</th>
                                    <th>Hasil Pemeriksaan</th>
                                    <th>Nilai Normal</th>
                                    <th>Tgl Selesai</th>
                                    <th>Keterangan</th>
                                    <th>Validasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_pasien_pemeriksaan as $dpp) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td>(<?php echo $dpp['kode_pengujian'] ?>) <?php echo $dpp['nama_pengujian'] ?></td>
                                        <td>
                                            <?php
                                            foreach ($dpp['data_sample'] as $ds) {
                                                if ($ds['id_pemeriksaan_sample'] != '') {
                                                    echo '- ' . $ds['nama_sample'].'<br/>';
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: right">
                                            <?php echo $dpp['hasil_pengujian'] ?>
                                        </td>
                                        <td><?php echo $dpp['nilai_normal'] ?></td>
                                        <td style="text-align: center">
                                            <?php echo $dpp['tgl_selesai'] ?>

                                        </td>
                                        <td style="text-align: center">
                                            <?php echo $dpp['keterangan_pemeriksaan'] ?>
                                        </td>
                                        <td style="text-align: center">
                                            <input type="checkbox" value="1" <?php if ($dpp['status_validasi'] == 1) echo 'checked="true"'; ?> name="validasi_<?php echo $no ?>"/><br/>
                                            <?php
                                            if ($dpp['status_validasi'] == 1) {
                                                echo 'Validasi Oleh : ' . $dpp['nama_validator'];
                                            }
                                            ?>
                                            <input type="hidden" name="pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['id_pasien_pemeriksaan']; ?>"/>
                                        </td>

                                    </tr>
                                    <?php
                                    if(count($dpp['data_child'])>0){
                                        ?>
                                        <input type="hidden" name="id_pemeriksaan_parent_<?php echo $no ?>" value="<?php echo $dpp['id_pasien_pemeriksaan']; ?>"/>
                                        <?php
                                        $no_child=1;
                                        foreach($dpp['data_child'] as $dc){
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $no.'.'.$no_child ?> (<?php echo $dc['kode_pengujian'] ?>) <?php echo $dc['nama_pengujian'] ?></td>
                                                <td>
                                                -
                                                </td>
                                                <td style="text-align: center;" >
                                                    <?php echo strip_tags($dc['hasil_pengujian']) ?>
                                                </td>
                                                <td><?php echo $dc['nilai_normal'] ?></td>
                                                <td style="text-align: center">
                                                    -
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo strip_tags($dc['keterangan_hasil']) ?>
                                                </td>
                                                <td style="text-align: center">
                                                    -
                                                </td>
                                            </tr>
                                            <?php
                                            $no_child++;
                                        }
                                    }
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="form-actions">
                            <input type="hidden" name="mode" value="pasien_pemeriksaan"/>
                            <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                            <input type="hidden" name="jumlah_data" value="<?php echo $no-1 ?>"/>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/hasil_pemeriksaan_new?reg=' . $id_registrasi); ?>" target="_blank" title="Cetak Hasil Pemeriksaan" id="" ><i class="icon-print"></i>Cetak Hasil</a>
                        </div> <!-- /form-actions -->
                    </fieldset>
                </form>

            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('table.datatable').dataTable({
            "lengthChange": true,
        });
        $('.tgl_selesai').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>