<div class="accordion-inner">

    <h2>Data Registrasi</h2>
    <?php if (Yii::app()->user->hasFlash('success_pasien')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_pasien'); ?>
        </div>
    <?php endif; ?>
    <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 160px 10px">
        <fieldset>
            <?php
            if (!empty($data_registrasi)) {
                ?>
                <div class="control-group">											
                    <label class="control-label" for="no_registrasi">ID PFL</label>
                    <div class="controls">
                        <input type="text" class="span4 validate[required]"  name="no_registrasi" value="<?php echo $data_registrasi['no_registrasi_penyewaan'] ?>">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="no_kwitansi_daftar">No.Registrasi</label>
                    <div class="controls">
                        <input type="text" class="span4" name="no_kwitansi_daftar" value="<?php echo $data_registrasi['no_kwitansi_daftar'] ?>">
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
                                <option value="1" <?php
                                if ($data_registrasi['status_biaya'] == 1) {
                                    echo "selected='true'";
                                }
                                ?>>Internal Unair</option>
                                <option value="2" <?php
                                if ($data_registrasi['status_biaya'] == 2) {
                                    echo "selected='true'";
                                }
                                ?>>Luar Unair</option>
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
                    <label class="control-label" for="judul_penelitian">Judul Penelitian</label>
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
                <input type="hidden" name="id_registrasi" value="<?php echo $data_registrasi['id_registrasi_penyewaan'] ?>" />
                <?php
            }else {
                ?>
                <div class="control-group">											
                    <label class="control-label" for="no_registrasi">ID PFL</label>
                    <div class="controls">
                        <input type="text" class="span4 validate[required]" name="no_registrasi" value="<?php echo $no_registrasi_auto ?>">
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
                                        <option value="<?php echo $d['id_pasien_tipe'] ?>"><?php echo $d['nama_pasien_tipe'] ?></option>
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
                        <textarea name="instansi_asal"  style="resize: none;height:80px" class="span6"></textarea>
                    </div> <!-- /controls -->
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="status_biaya">Jenis Biaya</label>
                    <div class="controls">
                        <div style="width: 50%">
                            <select name="status_biaya" class="chosen"  data-placeholder="Pilih Jenis Biaya..." tabindex="2">
                                <option value="1" >Internal Unair</option>
                                <option value="2" >Luar Unair</option>
                            </select>
                        </div>
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="tgl_order_masuk">Tanggal Mulai Penelitian</label>
                    <div class="controls">
                        <input type="text" class="span2 validate[required]" name="tgl_order_masuk" id="tgl_order_masuk" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="tgl_order_warning">Tanggal Warning</label>
                    <div class="controls">
                        <input type="text" class="span2 validate[required]" name="tgl_order_warning" id="tgl_order_warning" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="no_surat_permohonan">No.Surat Permohonan</label>
                    <div class="controls">
                        <input type="text" class="span4 validate[required]" name="no_surat_permohonan" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="tgl_surat_permohonan">Tgl Surat Permohonan</label>
                    <div class="controls">
                        <input type="text" class="span2 validate[required]" name="tgl_surat_permohonan" id="tgl_surat_permohonan" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="tgl_surat_daftar">Tanggal Surat Masuk</label>
                    <div class="controls">
                        <input type="text" class="span2 validate[required]" name="tgl_surat_daftar" id="tgl_surat_daftar" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="nama_penanggung_jawab">Nama Pemohon</label>
                    <div class="controls">
                        <input type="text" class="span4 validate[required]" name="nama_penanggung_jawab" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="no_telp">No Telp</label>
                    <div class="controls">
                        <input type="text" class="span4 validate[required]" name="no_telp" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="no_hp">No Hp</label>
                    <div class="controls">
                        <input type="text" class="span4 validate[required]" name="no_hp" value="">
                    </div> <!-- /controls -->				
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="alamat_saat_ini">Alamat Saat Ini</label>
                    <div class="controls">
                        <textarea name="alamat_saat_ini"  style="resize: none;height:80px" class="span6"></textarea>
                    </div> <!-- /controls -->
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="judul_penelitian">Judul Penilitian</label>
                    <div class="controls">
                        <textarea name="judul_penelitian"  style="resize: none;height:80px" class="span6"></textarea>
                    </div> <!-- /controls -->
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label" for="keterangan_registrasi">Keterangan Tambahan</label>
                    <div class="controls">
                        <textarea name="keterangan_registrasi"  style="resize: none;height:80px" class="span6"></textarea>
                    </div> <!-- /controls -->
                </div> <!-- /control-group -->

                <div class="control-group">											
                    <label class="control-label">Dokumen Pelengkap</label>
                    <div class="controls">
                        <?php
                        foreach ($data_dokumen as $d):
                            ?>
                            <label><input type="checkbox" class="validate[required]" name="dokumen[]" value="<?php echo $d['id_dokumen_penyewaan']; ?>" /> <?php echo $d['nama_dokumen'] ?></label>
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