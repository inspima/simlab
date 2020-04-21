<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Registrasi Pemakaian Lab</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content"> 
                <div class="accordion" id="accordion-pemeriksaan">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-satu">
                                REGISTRASI
                            </a>
                        </div>
                        <div id="collapse-satu" class="accordion-body collapse <?php if ($step == 1) echo 'in'; ?>">
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
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-dua">
                                ANGGOTA DAN BIAYA REGISTRASI
                            </a>
                        </div>
                        <div id="collapse-dua" class="accordion-body collapse <?php if ($step == 2) echo 'in'; ?>">
                            <div class="accordion-inner">

                                <?php if (Yii::app()->user->hasFlash('success_registrasi')): ?>
                                    <div class="alert alert-success">
                                        <?php echo Yii::app()->user->getFlash('success_registrasi'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (Yii::app()->user->hasFlash('success_delete_anggota')): ?>
                                    <div class="alert alert-success">
                                        <?php echo Yii::app()->user->getFlash('success_delete_anggota'); ?>
                                    </div>
                                <?php endif; ?>


                                <h2>Data Anggota</h2>
                                <a href="#modal-anggota-fasilitas" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Anggota</a>
                                <div id="modal-anggota-fasilitas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-anggota-fasilitasLabel" aria-hidden="true">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="modal-anggota-fasilitasLabel">Form Anggota Pemakaian Fasilitas</h3>
                                    </div>
                                    <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                        <fieldset>
                                            <div class="modal-body">
                                                <div class="control-group">											
                                                    <label class="control-label" for="nama_anggota">Nama Anggota</label>
                                                    <div class="controls">
                                                        <input type="text" class="span3 validate[required]" name="nama_anggota" value="">
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->

                                                <div class="control-group">											
                                                    <label class="control-label" for="judul">Judul Penelitian</label>
                                                    <div class="controls">
                                                        <textarea style="width: 90%;resize: none" name="judul"></textarea>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->

                                                <div class="control-group">											
                                                    <label class="control-label" for="status_anggota">Status Anggota</label>
                                                    <div class="controls">
                                                        <select name="status_anggota">
                                                            <option value="1">Mahasiswa</option>
                                                            <option value="2">Dosen</option>
                                                            <option value="3">Lainya</option>
                                                        </select>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->
                                            </div>
                                            <div class="modal-footer">

                                                <input type="hidden" name="mode" value="tambah-anggota"/>
                                                <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                                <button type="submit" class="btn btn-primary">Tambah Anggota</button>
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                            </div>


                                            <br/>


                                        </fieldset>
                                    </form>


                                </div>
                                <hr/>

                                <table id="anggota-penyewaan-table" style="width: 80%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Anggota</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_anggota_registrasi as $da) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $da['nama_anggota'] ?></td>
                                                <td><?php echo $da['judul_anggota'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($da['status_anggota'] == 1) {
                                                        echo"Mahasiswa";
                                                    } else if ($da['status_anggota'] == 2) {
                                                        echo"Dosen";
                                                    } else if ($da['status_anggota'] == 3) {
                                                        echo"Lain-Lain";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <form method="post">
                                                        <input type="hidden" name="id_anggota_penyewaan" value="<?php echo $da['id_registrasi_anggota_penyewaan'] ?>"/>
                                                        <input type="hidden" name="mode" value="delete-anggota"/>
                                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                                        <button type="submit" class="btn"><i class="icon-remove"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <br/>
                                <hr/>
                                <br/>
                                <h2>Biaya Registrasi Pemakaian Fasilitas</h2>
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
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div> <!-- /form-actions -->
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-tiga">
                                FASILITAS
                            </a>
                        </div>
                        <div id="collapse-tiga" class="accordion-body collapse <?php if ($step == 3) echo 'in'; ?>">
                            <div class="accordion-inner">
                                <?php if (Yii::app()->user->hasFlash('success_penyewaan_biaya')): ?>
                                    <div class="alert alert-success">
                                        <?php echo Yii::app()->user->getFlash('success_penyewaan_biaya'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (Yii::app()->user->hasFlash('success_tambah_fasilitas')): ?>
                                    <div class="alert alert-success">
                                        <?php echo Yii::app()->user->getFlash('success_tambah_fasilitas'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (Yii::app()->user->hasFlash('success_hapus_fasilitas')): ?>
                                    <div class="alert alert-success">
                                        <?php echo Yii::app()->user->getFlash('success_hapus_fasilitas'); ?>
                                    </div>
                                <?php endif; ?>


                                <h2>Data Pemakaian Fasilitas</h2>
                                <hr/>

                                <a href="#modal-barang-fasilitas" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Pemakaian</a>
                                <div id="modal-barang-fasilitas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-barang-fasilitasLabel" aria-hidden="true">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="modal-barang-fasilitasLabel">Form Pemakaian Fasilitas</h3>
                                    </div>
                                    <form class="form-horizontal form-validation" method="post" style="margin: 10px 10px 10px 10px">
                                        <fieldset>
                                            <div class="modal-body">
                                                <div class="control-group">											
                                                    <label class="control-label" for="fasilitas">Data Fasilitas</label>
                                                    <div class="controls">
                                                        <div style="width:90%">
                                                            <select name="fasilitas" id="fasilitas_sewa" class="chosen" tabindex="2">
                                                                <?php
                                                                foreach ($data_fasilitas_sewa as $df):
                                                                    ?>
                                                                    <option value="<?php echo $df['id_barang_sewa_tarif'] ?>" ><?php echo $df['nama_barang'] . ', per ' . $df['jumlah_satuan_sewa'] . ' ' . $df['nama_satuan'] . ' ' . $df['keterangan_tarif'] . ', Tarif : Rp. ' . number_format($df['tarif_sewa']) ?></option>
                                                                    <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->

                                                <div class="control-group">											
                                                    <label class="control-label" for="tgl_awal_sewa">Tanggal Awal Sewa</label>
                                                    <div class="controls">
                                                        <div id="tgl_awal_sewa"  class="input-append">
                                                            <input class="span3 m-wrap" name="tgl_awal_sewa" type="text"  value=""  type="text"/>
                                                            <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div> <!-- /control-group -->

                                                <div class="control-group">											
                                                    <label class="control-label" for="tgl_akhir_sewa">Tanggal Akhir Sewa</label>
                                                    <div class="controls">
                                                        <div id="tgl_akhir_sewa"  class="input-append">
                                                            <input class="span3 m-wrap" name="tgl_akhir_sewa" type="text"  value=""  type="text"/>
                                                            <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div> <!-- /control-group -->                                    

                                                <div class="control-group">											
                                                    <label class="control-label" for="jumlah_pemakaian">Lama/Jumlah Pemakaian</label>
                                                    <div class="controls">
                                                        <input type="text" id="jumlah_pemakaian" class="span3 validate[required]" name="jumlah_pemakaian" value="1">
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->

                                                <div class="control-group">											
                                                    <label class="control-label" for="tarif_sewa">Besar Tarif</label>
                                                    <div class="controls">
                                                        <input type="text" id="besar_tarif_sewa" class="span3 validate[required]" name="tarif_sewa" value="">
                                                    </div> <!-- /controls -->				
                                                </div> <!-- /control-group -->


                                                <div class="control-group">											
                                                    <label class="control-label" for="keterangan">Keterangan </label>
                                                    <div class="controls">
                                                        <textarea name="keterangan"  style="resize: none;height:80px" class="span3"></textarea>
                                                    </div> <!-- /controls -->
                                                </div> <!-- /control-group -->
                                            </div>
                                            <div class="modal-footer">

                                                <input type="hidden" name="mode" value="tambah-fasilitas"/>
                                                <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                                <button type="submit" class="btn btn-primary">Tambah Pemakaian Fasilitas</button>
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                            </div>


                                            <br/>


                                        </fieldset>
                                    </form>


                                </div>
                                <table id="fasilitas-penyewaan-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Fasilitas</th>
                                            <th>Waktu Pemakaian</th>
                                            <th>Lama/Jumlah Pemakaian</th>
                                            <th>Tarif Pemakaian</th>
                                            <th>Keterangan</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $total_fasilitas = 0;
                                        foreach ($data_registrasi_fasilitas as $dr) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $dr['nama_barang'] ?></td>
                                                <td style="text-align: center;width: 200px">
                                                    Mulai : <?php echo $dr['tgl_awal_penyewaan']; ?><br/>
                                                    Akhir : <?php echo $dr['tgl_akhir_penyewaan']; ?><br/>
                                                </td>
                                                <td style="text-align: right"><?php echo $dr['lama_sewa']; ?></td>
                                                <td style="text-align: right"><?php echo number_format($dr['besar_tarif']) ?></td>
                                                <td><?php echo $dr['keterangan_penyewaan'] ?></td>
                                                <td style="text-align: center">
                                                    <form method="post">
                                                        <input type="hidden" name="mode" value="hapus-fasilitas"/>
                                                        <input type="hidden" name="id_pasien_penyewaan" value="<?php echo $dr['id_pasien_penyewaan_barang'] ?>"/>
                                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                                        <button type="submit" class="btn"><i class="icon-remove"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                            $total_fasilitas+=$dr['besar_tarif'];
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center">
                                                <b>TOTAL</b>
                                            </td>
                                            <td style="text-align: right"><?php echo number_format($total_fasilitas) ?></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                    <fieldset>

                                        <br/>

                                        <div class="form-actions">
                                            <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/pemakaian_fasilitas?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Form Pemakaian</a>
                                        </div> <!-- /form-actions -->
                                    </fieldset>
                                </form>

                            </div> <!-- /controls -->	

                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-empat">
                                PEMBAYARAN
                            </a>
                        </div>
                        <div id="collapse-empat" class="accordion-body collapse <?php if ($step == 4) echo 'in'; ?>">
                            <?php $this->renderPartial('_tab_pembayaran', array('id_registrasi' => $id_registrasi, 'no_daftar_auto' => $no_daftar_auto, 'no_registrasi' => $no_registrasi, 'no_kwitansi_auto' => $no_kwitansi_auto, 'data_registrasi' => $data_registrasi, 'penyewaan_biaya' => $penyewaan_biaya, 'data_anggota_registrasi' => $data_anggota_registrasi, 'data_pembayaran' => $data_pembayaran, 'jumlah_biaya_fasilitas' => $jumlah_biaya_fasilitas)) ?>
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
        $('#pembayaran-penyewaan-table tbody').on('click', '.pembayaran-penyewaan-delete-button', function () {
            var c = confirm("Apakah anda yakin menghapus data ini");
            if (c === true)
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->createUrl('AjaxData/deletePembayaranPasienPenyewaan/?id_registrasi=' . $id_registrasi . '&no_registrasi=' . $no_registrasi); ?>',
                    data: 'id=' + $(this).attr('id'),
                    success: function (data) {
                        $('#pembayaran-penyewaan-table').html(data);
                    }
                });
        });
    </script>
    <?php
}
?>
<script type="text/javascript">
    $('#potongan').keyup(function () {
        $('#total_dibayar').val($('#total_biaya').val() - $(this).val())
    });
    $('#tanggal_lahir,#tgl_order_masuk,#tgl_order_warning,#tgl_surat_permohonan,#tgl_surat_daftar,#tgl_jatuh_tempo,#tgl_selesai').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#jumlah_pemakaian').keyup(function () {
        var id_barang_sewa_tarif = $('#fasilitas_sewa').val();
        var jumlah = $(this).val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBarangSewaTarif/') ?>',
            data: 'id_barang_sewa_tarif=' + id_barang_sewa_tarif,
            type: 'post',
            success: function (data) {
                var barang_sewa_tarif = $.parseJSON(data);
                $('#besar_tarif_sewa').val(barang_sewa_tarif.tarif_sewa * jumlah);
            }
        });

    });

    $('#fasilitas_sewa').change(function () {
        var id_barang_sewa_tarif = $(this).val();
        var jumlah = $('#jumlah_pemakaian').val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBarangSewaTarif/') ?>',
            data: 'id_barang_sewa_tarif=' + id_barang_sewa_tarif,
            type: 'post',
            success: function (data) {
                var barang_sewa_tarif = $.parseJSON(data);
                $('#besar_tarif_sewa').val(barang_sewa_tarif.tarif_sewa * jumlah);
            }
        });

    });
    $('#tanggal_lahir').datepicker().on('changeDate', function (ev) {
        $('#umur').val(getAge($(this).val()));
    });
    $('#waktu_registrasi, #waktu_pembayaran').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'pt-BR'
    });
    $('#tgl_awal_sewa, #tgl_akhir_sewa').datetimepicker({
        format: 'yyyy-MM-dd',
        language: 'pt-BR'
    });
    var total_pembayaran_detail = 0;

    $(".check_biaya_detail").click(function () {
        var total_pembayaran_detail = 0;
        $(".biaya_detail").each(function (index, value) {
            if ($("input[name='check_biaya_" + (index + 1) + "']").is(':checked')) {
                total_pembayaran_detail += parseInt($("input[name='besar_biaya_" + (index + 1) + "']").val());
                $('#total_biaya').val(total_pembayaran_detail);
                $('#total_dibayar').val(total_pembayaran_detail);
            }
        });
    });
    
    $('#status_pembayaran').change(function () {
        var status_pembayaran = $(this).val();
        if (status_pembayaran == 1) {
            $('#biaya_registrasi_item').fadeIn();
            $('#biaya_pelunasan_item').fadeOut();
        } else if (status_pembayaran == 2) {
            $('#biaya_pelunasan_item').fadeIn();
            $('#biaya_registrasi_item').fadeOut();
        }
    });

</script>
