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
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li <?php if ($step == 1) echo 'class="active"'; ?> >
                            <a href="#registrasi" data-toggle="tab">Registrasi</a>
                        </li>
                        <li <?php if ($step == 2) echo 'class="active"'; ?> >
                            <a href="#anggota" data-toggle="tab">Anggota dan Biaya Registrasi</a>
                        </li>
                        <li <?php if ($step == 3) echo 'class="active"'; ?> >
                            <a href="#fasilitas" data-toggle="tab">Input Fasilitas</a>
                        </li>
                        <li <?php if ($step == 4) echo 'class="active"'; ?> >
                            <a href="#pembayaran" data-toggle="tab">Pembayaran</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane <?php if ($step == 1) echo 'active'; ?> " id="registrasi">
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
                                                <input type="text" class="span4 validate[required]" readonly="" name="no_registrasi" value="<?php echo $data_registrasi['no_registrasi_penyewaan'] ?>">
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
                                        <input type="hidden" name="id_registrasi" value="<?php echo $data_registrasi['id_registrasi_penyewaan'] ?>" />
                                        <?php
                                    }else {
                                        ?>
                                        <div class="control-group">											
                                            <label class="control-label" for="no_registrasi">ID PFL</label>
                                            <div class="controls">
                                                <input type="text" class="span4 validate[required]" readonly="" name="no_registrasi" value="<?php echo $no_registrasi_auto ?>">
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
                        <div class="tab-pane <?php if ($step == 2) echo 'active'; ?> " id="anggota">
                            <h2>Input Data Anggota Pemakaian Fasilitas dan Penyewaan Biaya</h2>
                            <hr/>
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
                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <fieldset>
                                    <div class="control-group">											
                                        <label class="control-label" for="nama_anggota">Nama Anggota</label>
                                        <div class="controls">
                                            <input type="text" class="span4 validate[required]" name="nama_anggota" value="">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="judul">Judul Penelitian</label>
                                        <div class="controls">
                                            <textarea style="width: 50%;resize: none" name="judul"></textarea>
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

                                    <br/>

                                    <div class="form-actions">
                                        <input type="hidden" name="mode" value="tambah-anggota"/>
                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                            <h2>Data Anggota</h2>
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
                                        <button type="submit" class="btn btn-primary">Save & Continue</button>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($step == 3) echo 'active'; ?> " id="fasilitas">
                            <h2>Input data fasilitas yang dipakai</h2>
                            <hr/>
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

                            <h2>Form Pemakaian</h2>
                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <fieldset>
                                    <div class="control-group">											
                                        <label class="control-label" for="fasilitas">Data Fasilitas</label>
                                        <div class="controls">
                                            <div style="width:70%">
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
                                            <input type="text" class="span2" name="tgl_awal_sewa" id="tgl_awal_sewa" >
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="tgl_akhir_sewa">Tanggal Akhir Sewa</label>
                                        <div class="controls">
                                            <input type="text" class="span2" name="tgl_akhir_sewa" id="tgl_akhir_sewa" >
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->                                    

                                    <div class="control-group">											
                                        <label class="control-label" for="jumlah_pemakaian">Lama/Jumlah Pemakaian</label>
                                        <div class="controls">
                                            <input type="text" id="jumlah_pemakaian" class="span4 validate[required]" name="jumlah_pemakaian" value="1">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="tarif_sewa">Besar Tarif</label>
                                        <div class="controls">
                                            <input type="text" id="besar_tarif_sewa" class="span4 validate[required]" name="tarif_sewa" value="">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->


                                    <div class="control-group">											
                                        <label class="control-label" for="keterangan">Keterangan </label>
                                        <div class="controls">
                                            <textarea name="keterangan"  style="resize: none;height:80px" class="span6"></textarea>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <br/>

                                    <div class="form-actions">
                                        <input type="hidden" name="mode" value="tambah-fasilitas"/>
                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                            <hr/>
                            <h2>Data Pemakaian Fasilitas</h2>
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
                                        <input type="hidden" name="mode" value="selesai-fasilitas"/>
                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                        <button type="submit" class="btn btn-primary">Continue</button>
                                         <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/pemakaian_fasilitas?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Form Pemakaian</a>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane <?php if ($step == 4) echo 'active'; ?> " id="pembayaran">

                            <?php if (Yii::app()->user->hasFlash('success_pembayaran')): ?>
                                <div class="alert alert-success">
                                    <?php echo Yii::app()->user->getFlash('success_pembayaran'); ?>
                                </div>
                            <?php endif; ?>
                            <h2>Form Pembayaran</h2>
                            <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                <fieldset>
                                    <div class="control-group">											
                                        <label class="control-label" for="no_registrasi">No.Registrasi</label>
                                        <div class="controls">
                                            <input type="hidden" class="span4" name="no_kwitansi_pembayaran" value="<?php echo $no_kwitansi_auto?>">
                                            <input type="text" class="span4" name="no_registrasi" readonly="" value="<?php echo empty($data_registrasi['no_kwitansi_daftar'])?$no_daftar_auto:$data_registrasi['no_kwitansi_daftar'] ?>">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->
                                    <div class="control-group">											
                                        <label class="control-label" for="waktu_pembayaran">Waktu Pembayaran</label>
                                        <div class="controls">
                                            <div id="waktu_pembayaran"  class="input-append">
                                                <input class="span4 m-wrap" name="waktu_pembayaran" type="text"  value="<?php echo date('Y-m-d H:i:s') ?>"  type="text"/>
                                                <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="status_pembayaran">Status Pembayaran</label>
                                        <div style="width: 50%">
                                            <div class="controls">
                                                <select name="status_pembayaran" class=""  data-placeholder="Pilih Status Pembayaran..." tabindex="2">
                                                    <option value="1">Registrasi</option>
                                                    <option value="2">Pelunasan</option>
                                                </select>
                                            </div> <!-- /controls -->				
                                        </div>
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="">Biaya yang Akan Dibayar</label>
                                        <div class="controls">
                                            <table style="width: 40%">
                                                <?php
                                                if (!empty($penyewaan_biaya)) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: left">
                                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_1" value="1"/>
                                                            <input type="hidden" name="nama_biaya_1" value="Bench Fee"/>
                                                            <label style="display: inline-block;margin: auto 0px">Bench Fee</label>
                                                        </td>
                                                        <td style="text-align: left">
                                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_1" value="<?php echo (count($data_anggota_registrasi)+1)*$penyewaan_biaya['besar_biaya'] ?>"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left">
                                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_2" value="1"/>
                                                            <input type="hidden" name="nama_biaya_2" value="Deposit"/>
                                                            <label style="display: inline-block;margin: auto 0px">Deposit</label>
                                                        </td>
                                                        <td style="text-align: left">
                                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_2" value="<?php echo number_format($penyewaan_biaya['besar_deposit'],0,'','') ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left">
                                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_3" value="1"/>
                                                            <input type="hidden" name="nama_biaya_3" value="Administrasi"/>
                                                            <label style="display: inline-block;margin: auto 0px">Biaya Administrasi</label>
                                                        </td>
                                                        <td style="text-align: left">
                                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_3" value="<?php echo number_format($penyewaan_biaya['besar_biaya_administrasi'],0,'','') ?>">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: left">
                                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_1" value="1"/>
                                                            <input type="hidden" name="nama_biaya_1" value="Bench Fee"/>
                                                            <label style="display: inline-block;margin: auto 0px">Bench Fee</label>
                                                        </td>
                                                        <td style="text-align: left">
                                                            <input type="text" class="span2 biaya_detail"  style="text-align: right"  style="text-align: right" name="besar_biaya_1" value="0"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left">
                                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_2" value="1"/>
                                                            <input type="hidden" name="nama_biaya_2" value="Deposit"/>
                                                            <label style="display: inline-block;margin: auto 0px">Deposit</label>
                                                        </td>
                                                        <td style="text-align: left">
                                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_2" value="0">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: left">
                                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_3" value="1"/>
                                                            <input type="hidden" name="nama_biaya_3" value="Administrasi"/>
                                                            <label style="display: inline-block;margin: auto 0px">Biaya Administrasi</label>
                                                        </td>
                                                        <td style="text-align: left">
                                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_3" value="0">
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td style="text-align: left">
                                                        <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_4" value="1"/>
                                                        <input type="hidden" name="nama_biaya_4" value="Pemakaian Fasilitas"/>
                                                        <label style="display: inline-block;margin: auto 0px">Pemakaian Fasilitas</label>
                                                    </td>
                                                    <td style="text-align: left">
                                                        <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_4" value="<?php echo number_format($jumlah_biaya_fasilitas,0,'','') ?>">
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="total_biaya">Total Biaya</label>
                                        <div class="controls">
                                            <input type="text" id="total_biaya" class="span4 validate[required]" name="total_biaya" value="">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="potongan">Potongan/Diskon</label>
                                        <div class="controls">
                                            <input class="validate[required]"  id="potongan"  name="potongan" id="appendedPrependedInput" type="text" value="0">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="total_dibayar">Total Dibayar</label>
                                        <div class="controls">
                                            <input type="text" id="total_dibayar" class="span4 validate[required]" name="total_dibayar" value="">
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->


                                    <div class="control-group">											
                                        <label class="control-label" for="via_pembayaran">Via Pembayaran</label>
                                        <div class="controls">
                                            <select name="via_pembayaran" class="span3">
                                                <option value="1">Tunai</option>
                                                <option value="2">Via Mesin EDC</option>
                                                <option value="3">Transfer Rekening Giro</option>
                                            </select>
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->


                                    <div class="control-group">											
                                        <label class="control-label" for="tgl_jatuh_tempo">Tanggal Jatuh Tempo</label>
                                        <div class="controls">
                                            <input type="text" class="span2" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" >
                                        </div> <!-- /controls -->				
                                    </div> <!-- /control-group -->

                                    <div class="control-group">											
                                        <label class="control-label" for="keterangan">Keterangan </label>
                                        <div class="controls">
                                            <textarea name="keterangan"  style="resize: none;height:80px" class="span6"></textarea>
                                        </div> <!-- /controls -->
                                    </div> <!-- /control-group -->

                                    <br/>

                                    <div class="form-actions">
                                        <input type="hidden" name="mode" value="pembayaran"/>
                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                        <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/penyewaan_lembar_pemohon?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Lembar Pemohon</a>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/penyewaan_lembar_lab?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Lembar Lab</a>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/penyewaan_lembar_registrasi?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Lembar Registrasi</a>
                                    </div> <!-- /form-actions -->
                                </fieldset>
                            </form>
                            <h2>Data Pembayaran</h2>
                            <table id="pembayaran-penyewaan-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu Pembayaran</th>
                                        <th>Total Biaya</th>
                                        <th>Potongan Diskon</th>
                                        <th>Total Dibayar</th>
                                        <th>Keterangan</th>
                                        <th>Tgl Jatuh Tempo</th>
                                        <th>Status Pembayaran</th>
                                        <th>Via Pembayaran</th>
                                        <th>Detail Biaya</th>
                                        <th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total_pembayaran = 0;
                                    foreach ($data_pembayaran as $pem) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $pem['waktu_pembayaran'] ?></td>
                                            <td style="text-align: right"><?php echo number_format($pem['total_biaya']) ?></td>
                                            <td style="text-align: right"><?php echo number_format($pem['potongan']) ?></td>
                                            <td style="text-align: right"><?php echo number_format($pem['total_dibayar']) ?></td>
                                            <td><?php echo $pem['keterangan'] ?></td>
                                            <td><?php echo $pem['tgl_jatuh_tempo'] ?></td>
                                            <td style="text-align: center">
                                                <?php
                                                if ($pem['status_pembayaran'] == '1') {
                                                    ?>
                                                    <button class="btn btn-info">Registrasi</button>
                                                    <?php
                                                } else if ($pem['status_pembayaran'] == '2') {
                                                    ?>
                                                    <button class="btn btn-success">Pelunasan</button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center">
                                                <?php
                                                if ($pem['via_pembayaran'] == '1') {
                                                    ?>
                                                    <button class="btn btn-default">Tunai</button>
                                                    <?php
                                                } else if ($pem['via_pembayaran'] == '2') {
                                                    ?>
                                                    <button class="btn btn-default">EDC</button>
                                                    <?php
                                                }else if ($pem['via_pembayaran'] == '3') {
                                                    ?>
                                                    <button class="btn btn-default">Transfer Rekening Giro</button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: right">
                                                <?php
                                                foreach ($pem['detail'] as $dp) {
                                                    echo $dp['nama_biaya'] . ' Rp. ' . number_format($dp['besar_biaya'])."<br/>";
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center">
                                                <a class="btn pembayaran-penyewaan-delete-button" title="Delete" id="<?php echo $pem['id_pembayaran_penyewaan'] ?>" ><i class="icon-remove"></i></a>
                                                <?php
                                                if (in_array($pem['status_pembayaran'], array(1,2))) {
                                                    ?>
                                                    <a class="btn" title="Cetak Bukti Bayar" href="<?php echo Yii::app()->createUrl('registrasi/cetak/bayar_penyewaan?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi. '&id_pembayaran=' . $pem['id_pembayaran_penyewaan']); ?>" target="_blank" ><i class="icon-print"></i></a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                        $total_pembayaran+=$pem['total_dibayar'];
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center">
                                            <b>TOTAL</b>
                                        </td>
                                        <td style="text-align: right"><?php echo number_format($total_pembayaran) ?></td>
                                        <td colspan="6"></td>
                                    </tr>
                                </tbody>
                            </table>
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
        var total_pembayaran_detail=0;
        $(".biaya_detail").each(function(index, value) {
            if ($("input[name='check_biaya_" + (index+1) + "']").is(':checked')) {
                total_pembayaran_detail += parseInt($("input[name='besar_biaya_" + (index+1) + "']").val());
                $('#total_biaya').val(total_pembayaran_detail);
                $('#total_dibayar').val(total_pembayaran_detail);
            }
        });
    });

</script>
