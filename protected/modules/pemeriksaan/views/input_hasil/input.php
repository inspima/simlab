<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Input Hasil Pasien Pemeriksaan</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Pasien Pemeriksaan</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('pemeriksaan/input_hasil/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation" method="post" enctype="multipart/form-data" style="width: 98%;margin: 10px 10px 10px 10px">
                    <fieldset>
                        <table id="pasien-pemeriksaan-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengujian</th>
                                    <th>Sample</th>
                                    <th>Hasil Pemeriksaan</th>
                                    <th>Nilai Normal</th>
                                    <th>Tgl Pemeriksaan</th>
                                    <th>Keterangan</th>
                                    <th>No.Sertifikat & No.Order</th>
                                    <th>Validasi</th>
                                    <th>File Lampiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_pasien_pemeriksaan as $dpp) {
                                    if ($dpp['status_validasi'] == 0) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td>(<?php echo $dpp['kode_pengujian'] ?>) <?php echo $dpp['nama_pengujian'] ?>
                                                <input type="hidden" name="pengujian_txt<?php echo $no ?>" value="<?php echo $dpp['nama_pengujian'] ?>"/>
                                            </td>
                                            <td>
                                                <?php
                                                foreach ($dpp['data_sample'] as $ds) {
                                                    if ($ds['id_pemeriksaan_sample'] != '') {
                                                        echo '- ' . $ds['nama_sample'] . '<br/>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: right;width: 200px" >
                                                <textarea style="width: 90%;height: 60px;resize: none" name="hasil_pemeriksaan<?php echo $no ?>"><?php echo strip_tags($dpp['hasil_pengujian']) ?></textarea>
                                            </td>
                                            <td><?php echo $dpp['nilai_normal'] ?></td>
                                            <td style="text-align: center">
                                                Tanggal Pengujian <br/>
                                                <input type="text" style="width: 90%"  class="tgl_pengujian" name="tgl_pengujian<?php echo $no ?>" value="<?php echo $dpp['tgl_pengujian'] == '' ? date('Y-m-d') : $dpp['tgl_selesai'] ?>"/>
                                                <br/>
                                                Tanggal Selesai  <br/>
                                                <input type="text" style="width: 90%"  class="tgl_selesai" name="tgl_selesai<?php echo $no ?>" value="<?php echo $dpp['tgl_selesai'] == '' ? date('Y-m-d') : $dpp['tgl_selesai'] ?>"/>
                                                <input type="hidden" name="pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['id_pasien_pemeriksaan']; ?>"/>
                                            </td>
                                            <td style="text-align: center">
                                                <textarea style="width: 90%;height: 60px;resize: none" name="keterangan_<?php echo $no ?>"><?php echo $dpp['keterangan_pemeriksaan'] ?></textarea>
                                            </td>
                                            <td>
                                                NO.Sertifikat <br/>
                                                <input style="width: 90%" type="text" name="no_sertifikat_<?php echo $no ?>" size="20" value=""/>
                                                <br/>
                                                No.Order Lab<br/>
                                                <input style="width: 90%" type="text" name="no_order_<?php echo $no ?>" size="20" value=""/>
                                            </td>
                                            <td style="text-align: center">
                                                <span class="btn btn-warning">Belum Divalidasi</span>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if($dpp['file_lampiran'] != ''){echo CHtml::link('DOWNLOAD FILE',Yii::app()->request->baseUrl.'/files/hasil_pemeriksaan/'.$dpp['file_lampiran'],array('target'=>'_blank'))."<br />";}?>
                                                <input type="file" name="lampiran_<?php echo $no ?>">
                                            </td>
                                        </tr>
                                        <?php
                                        
                                    } else {
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td>(<?php echo $dpp['kode_pengujian'] ?>) <?php echo $dpp['nama_pengujian'] ?></td>
                                            <td>
                                                <?php
                                                foreach ($dpp['data_sample'] as $ds) {
                                                    if ($ds['id_pemeriksaan_sample'] != '') {
                                                        echo '- ' . $ds['nama_sample'] . '<br/>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?php echo $dpp['hasil_pengujian'] ?>
                                                <input type="hidden" name="hasil_pemeriksaan<?php echo $no ?>" value="<?php echo strip_tags($dpp['hasil_pengujian']) ?>"/>
                                            </td>
                                            <td><?php echo $dpp['nilai_normal'] ?></td>
                                            <td style="text-align: center">
                                                <?php echo $dpp['tgl_selesai'] ?>
                                                <input type="hidden" name="tgl_selesai<?php echo $no ?>" value="<?php echo $dpp['tgl_selesai']; ?>"/>
                                                <input type="hidden" name="pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['id_pasien_pemeriksaan']; ?>"/>
                                            </td>
                                            <td style="text-align: center">
                                                <?php echo $dpp['keterangan_pemeriksaan'] ?>
                                                <input type="hidden" name="keterangan_<?php echo $no ?>" value="<?php echo $dpp['keterangan_pemeriksaan']; ?>"/>
                                            </td>
                                            <td style="text-align: center">
                                                <span class="btn btn-success">Sudah Divalidasi</span><br/>
                                                <?php
                                                if ($dpp['status_validasi'] == 1) {
                                                    echo 'Validasi Oleh : ' . $dpp['nama_validator'];
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center">
                                                <input type="file" name="lampiran">
                                            </td>

                                        </tr>
                                        <?php
                                    }
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
                                                <td style="text-align: right;width: 250px" >
                                                    <textarea style="width: 90%;height: 60px;resize: none" name="hasil_pemeriksaan_child_<?php echo $no ?>_<?php echo $no_child ?>"><?php echo strip_tags($dc['hasil_pengujian']) ?></textarea>
                                                    <input type="hidden" name="id_pengujian_child_<?php echo $no ?>_<?php echo $no_child ?>" value="<?php echo $dc['id_pengujian_child']; ?>"/>
                                                </td>
                                                <td><?php echo $dc['nilai_normal'] ?></td>
                                                <td style="text-align: center">
                                                    -
                                                </td>
                                                <td style="text-align: center">
                                                    <textarea style="width: 90%;height: 60px;resize: none" name="keterangan_child_<?php echo $no ?>_<?php echo $no_child ?>"><?php echo strip_tags($dc['keterangan_hasil']) ?></textarea>
                                                </td>
                                                <td style="text-align: center">
                                                    -
                                                </td>
                                            </tr>
                                            <?php
                                            $no_child++;
                                        }
                                        ?>
                                        <input type="hidden" name="jumlah_child_<?php echo $no ?>" value="<?php echo $no_child ?>"/>
                                        <?php
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
        $('.tgl_selesai, .tgl_pengujian').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>