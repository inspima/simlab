<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Registrasi Pemakaian Lab - Perpanjangan</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content"> 
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('registrasi/pemakaian_lab_perpanjangan/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li <?php if ($step == 1) echo 'class="active"'; ?> >
                            <a href="#registrasi" data-toggle="tab">Registrasi</a>
                        </li>
                        <li <?php if ($step == 2) echo 'class="active"'; ?> >
                            <a href="#biaya" data-toggle="tab">Biaya Registrasi Perpanjangan</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane <?php if ($step == 1) echo 'active'; ?> " id="registrasi">
                            <h2>Data Registrasi</h2>
                            
                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 160px 10px">
                                <fieldset>
                                    <?php
                                    if (!empty($data_registrasi)) {
                                        ?>
                                        <div class="control-group">											
                                            <label class="control-label" for="no_registrasi">ID PFL</label>
                                            <div class="controls">
                                                <input type="text" class="span4 validate[required]" readonly="" name="no_registrasi" value="<?php echo $data_registrasi['no_registrasi_penyewaan'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->


                                        <div class="control-group">											
                                            <label class="control-label" for="no_kwitansi_daftar">No.Registrasi</label>
                                            <div class="controls">
                                                <input type="text" class="span4" name="no_kwitansi_daftar" value="<?php echo $no_daftar_auto ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->


                                        <div class="control-group">											
                                            <label class="control-label" for="pasien_tipe">Jenis Penelitian</label>
                                            <div class="controls">
                                                <div style="width: 50%">
                                                    <select name="pasien_tipe" class="chosen"  data-placeholder="Pilih Tipe..." tabindex="2">

                                                        <?php
                                                        foreach ($data_pasien_tipe as $d):
                                                            if ($d['jenis_pasien_tipe'] == 1) {
                                                                ?>
                                                                <option value="<?php echo $d['id_pasien_tipe'] ?>" <?php if ($data_registrasi['id_pasien_tipe'] == $d['id_pasien_tipe']) echo "selected='true'"; ?>><?php echo $d['nama_pasien_tipe'] ?></option>
                                                                <?php
                                                            }
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="instansi_asal">Instansi Asal</label>
                                            <div class="controls">
                                                <textarea name="instansi_asal"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['instansi_asal'] ?></textarea>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="status_biaya">Jenis Biaya</label>
                                            <div class="controls">
                                                <div style="width: 50%">
                                                    <select name="status_biaya" class="chosen"  data-placeholder="Pilih Jenis Biaya..." tabindex="2">
                                                        <option value="1" <?php if($data_registrasi['status_biaya']==1){echo "selected='true'";} ?>>Internal Unair</option>
                                                        <option value="2" <?php if($data_registrasi['status_biaya']==2){echo "selected='true'";} ?>>Luar Unair</option>
                                                    </select>
                                                </div>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="tgl_order_masuk">Tanggal Mulai Penelitian</label>
                                            <div class="controls">
                                                <input type="text" class="span2 validate[required]" name="tgl_order_masuk" id="tgl_order_masuk" value="<?php echo $data_registrasi['tgl_order_masuk'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="tgl_order_warning">Tanggal Warning</label>
                                            <div class="controls">
                                                <input type="text" class="span2 validate[required]" name="tgl_order_warning" id="tgl_order_warning" value="<?php echo $data_registrasi['tgl_order_warning'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="no_surat_permohonan">No.Surat Permohonan</label>
                                            <div class="controls">
                                                <input type="text" class="span4 validate[required]" name="no_surat_permohonan" value="<?php echo $data_registrasi['no_surat_permohonan'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="tgl_surat_permohonan">Tgl Surat Permohonan</label>
                                            <div class="controls">
                                                <input type="text" class="span2 validate[required]" name="tgl_surat_permohonan" id="tgl_surat_permohonan" value="<?php echo $data_registrasi['tgl_surat_permohonan'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="tgl_surat_daftar">Tanggal Surat Masuk</label>
                                            <div class="controls">
                                                <input type="text" class="span2 validate[required]" name="tgl_surat_daftar" id="tgl_surat_daftar" value="<?php echo $data_registrasi['tgl_surat_daftar'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="nama_penanggung_jawab">Nama Pemohon</label>
                                            <div class="controls">
                                                <input type="text" class="span4 validate[required]" name="nama_penanggung_jawab" value="<?php echo $data_registrasi['nama_penanggung_jawab'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="no_telp">No Telp</label>
                                            <div class="controls">
                                                <input type="text" class="span4 validate[required]" name="no_telp" value="<?php echo $data_registrasi['no_telp'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="no_hp">No Hp</label>
                                            <div class="controls">
                                                <input type="text" class="span4 validate[required]" name="no_hp" value="<?php echo $data_registrasi['no_hp'] ?>">
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="alamat_saat_ini">Alamat Saat Ini</label>
                                            <div class="controls">
                                                <textarea name="alamat_saat_ini"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['alamat_saat_ini'] ?></textarea>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="judul_penelitian">Judul Penilitian</label>
                                            <div class="controls">
                                                <textarea name="judul_penelitian"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['judul_penelitian'] ?></textarea>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label" for="keterangan_registrasi">Keterangan Tambahan</label>
                                            <div class="controls">
                                                <textarea name="keterangan_registrasi"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['keterangan_registrasi'] ?></textarea>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->

                                        <div class="control-group">											
                                            <label class="control-label">Dokumen Pelengkap</label>
                                            <div class="controls">
                                                <?php
                                                foreach ($data_dokumen as $d):
                                                    ?>
                                                    <label><input type="checkbox" class="validate[required]" name="dokumen[]" value="<?php echo $d['id_dokumen_penyewaan']; ?>" <?php if ($d['no_registrasi_penyewaan'] != '') echo "checked='true'"; ?> /> <?php echo $d['nama_dokumen'] ?></label>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        <?php
                                    }
                                    ?>


                                    <br />

                                    <div class="form-actions">
                                        <input type="hidden" name="mode" value="registrasi"/>
                                        <button type="submit" class="btn btn-primary">Save & Continue</button>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($step == 2) echo 'active'; ?> " id="biaya">
                            <h2>Input Data Penyewaan Biaya Perpanjangan</h2>
                            <hr/>
                            <?php if (Yii::app()->user->hasFlash('success_registrasi')): ?>
                                <div class="alert alert-success">
                                    <?php echo Yii::app()->user->getFlash('success_registrasi'); ?>
                                </div>
                            <?php endif; ?>
                             <?php if (Yii::app()->user->hasFlash('success_penyewaan_biaya')): ?>
                                <div class="alert alert-success">
                                    <?php echo Yii::app()->user->getFlash('success_penyewaan_biaya'); ?>
                                </div>
                            <?php endif; ?>
                            <h2>Biaya Registrasi Perpanjangan Pemakaian Fasilitas</h2>
                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <fieldset>
                                    <table id="pasien-penyewaan-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Biaya </th>
                                                <th>Bench Fee (Rp)</th>
                                                <th>Deposit (Rp)</th>
                                                <th>Administrasi (Rp)</th>
                                                <th>Jumlah (Rp)</th>
                                                <th>Status Biaya</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($data_penyewaan_biaya as $db) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $db['nama_biaya'] ?></td>
                                                    <td style="text-align: right"><?php echo number_format($db['besar_biaya']) ?> </td>
                                                    <td style="text-align: right"><?php echo number_format($db['besar_deposit']) ?> </td>
                                                    <td style="text-align: right"><?php echo number_format($db['besar_biaya_administrasi']) ?> </td>
                                                    <td style="text-align: right"><?php echo number_format($db['total_biaya']) ?> </td>
                                                    <td style="text-align: right"><?php echo $db['status_biaya'] == 1 ? "Internal" : "Luar Unair"; ?> </td>
                                                    <td style="text-align: center">
                                                        <input type="radio" <?php if ($id_registrasi_penyewaan_biaya == $db['id_registrasi_penyewaan_biaya']) echo "checked='true'"; ?> name="penyewaan_biaya" value="<?php echo $db['id_registrasi_penyewaan_biaya'] ?>"
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <div class="form-actions">
                                        <input type="hidden" name="mode" value="penyewaan-biaya"/>
                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                        <button type="submit" class="btn btn-primary">Save & Selesai Perpanjangan</button>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<?php
if ($step == 4) {
    ?>
    <script type="text/javascript">
        $('#pembayaran-penyewaan-table tbody').on('click', '.pembayaran-penyewaan-delete-button', function() {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('AjaxData/deletePembayaranPasienPenyewaan/?id_registrasi=' . $id_registrasi . '&no_registrasi=' . $no_registrasi); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function(data) {
                        $('#pembayaran-penyewaan-table').html(data);
                    }
                });
        });
    </script>
    <?php
}
?>
<script type="text/javascript">
    $('#potongan').keyup(function() {
        $('#total_dibayar').val($('#total_biaya').val() - $(this).val())
    });
    $('#tanggal_lahir,#tgl_order_masuk,#tgl_order_warning,#tgl_surat_permohonan,#tgl_surat_daftar, #tgl_jatuh_tempo, #tgl_selesai, #tgl_awal_sewa, #tgl_akhir_sewa').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#jumlah_pemakaian').keyup(function() {
        var id_barang_sewa_tarif = $('#fasilitas_sewa').val();
        var jumlah = $(this).val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBarangSewaTarif/') ?>',
            data: 'id_barang_sewa_tarif=' + id_barang_sewa_tarif,
            type: 'post',
            success: function(data) {
                var barang_sewa_tarif = $.parseJSON(data);
                $('#besar_tarif_sewa').val(barang_sewa_tarif.tarif_sewa * jumlah);
            }
        });

    });

    $('#fasilitas_sewa').change(function() {
        var id_barang_sewa_tarif = $(this).val();
        var jumlah = $('#jumlah_pemakaian').val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBarangSewaTarif/') ?>',
            data: 'id_barang_sewa_tarif=' + id_barang_sewa_tarif,
            type: 'post',
            success: function(data) {
                var barang_sewa_tarif = $.parseJSON(data);
                $('#besar_tarif_sewa').val(barang_sewa_tarif.tarif_sewa * jumlah);
            }
        });

    });
    $('#tanggal_lahir').datepicker().on('changeDate', function(ev) {
        $('#umur').val(getAge($(this).val()));
    });
    $('#waktu_registrasi, #waktu_pembayaran').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'pt-BR'
    });
    var total_pembayaran_detail = 0;

    $(".check_biaya_detail").click(function() {
        var total_pembayaran_detail = 0;
        $(".biaya_detail").each(function(index, value) {
            if ($("input[name='check_biaya_" + (index + 1) + "']").is(':checked')) {
                total_pembayaran_detail += parseInt($("input[name='besar_biaya_" + (index + 1) + "']").val());
                $('#total_biaya').val(total_pembayaran_detail);
                $('#total_dibayar').val(total_pembayaran_detail);
            }
        });
    });

</script>
