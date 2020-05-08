<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Registrasi Pemeriksaan Baru</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content"> 
                <div class="alert alert-info">
                    <strong>INFORMASI!</strong> Klik judul berwarna abu-abu untuk membuka tiap form.
                </div>
                <div class="control-group">
                    <div class="controls">

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
                                        <a href="#modal-pasien" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Pasien</a>
                                        <div id="modal-pasien" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-pasienLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="modal-pasienLabel">Form Pasien</h3>
                                            </div>

                                            <form class="form-horizontal form-validation" method="post" style="">
                                                <fieldset>
                                                    <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="nama">Nama</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3 validate[required]" name="nama" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label">Jenis Kelamin</label>
                                                            <div class="controls">
                                                                <label class="radio inline">
                                                                    <input type="radio" value="1" class="validate[required]"  name="jenis_kelamin"> Laki-Laki
                                                                </label>

                                                                <label class="radio inline">
                                                                    <input type="radio" value="2" class="validate[required]" name="jenis_kelamin"> Perempuan
                                                                </label>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->
                                                        
                                                        <div class="control-group">											
                                                            <label class="control-label" for="tgl_lahir">Tgl Lahir</label>
                                                            <div class="controls">
                                                                <div id="tanggal_lahir"  class="input-append">
                                                                    <input class="span3 m-wrap" name="tgl_lahir" id="tanggal_lahir_val" type="text"  value="1960-01-01"  type="text"/>
                                                                    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="umur">Umur</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3"  id="umur" name="umur" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="telepon">Telepon</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3" name="telepon" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="hp">HP</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3" name="hp" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="agama">Agama</label>
                                                            <div class="controls">
                                                                <div style="width: 60%">
                                                                    <select name="agama" class="chosen span5 validate[required]" id="agama" data-placeholder="Pilih Agama..." tabindex="2">
                                                                        <?php
                                                                        foreach ($data_agama as $d):
                                                                            ?>
                                                                            <option value="<?php echo $d['id_agama'] ?>"><?php echo $d['nama_agama'] ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="propinsi">Propinsi</label>
                                                            <div class="controls">
                                                                <div style="">
                                                                    <select name="propinsi" class="chosen span3" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                                                                        <?php
                                                                        foreach ($data_propinsi as $d):
                                                                            ?>
                                                                            <option value="<?php echo $d['id_propinsi'] ?>"><?php echo $d['nama_propinsi'] ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
                                                        <div id="kota_loading"></div>
                                                        <div class="control-group">											
                                                            <label class="control-label" for="kota">Kota Lahir</label>
                                                            <div class="controls">
                                                                <div style="">
                                                                    <select name="kota" class="chosen span3 validate[required]" id="kota" data-placeholder="Pilih Kota..." tabindex="2"></select>
                                                                </div>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label" for="alamat">Alamat</label>
                                                            <div class="controls">
                                                                <textarea name="alamat"  style="resize: none;height:80px" class="span3"></textarea>
                                                            </div> <!-- /controls -->
                                                        </div> <!-- /control-group -->
                                                    </div>
                                                    <div class="modal-footer">

                                                        <input type="hidden" name="mode" value="pasien"/>
                                                        <button type="submit" class="btn btn-primary">Tambah Pasien</button> 
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </div>


                                                    <br/>


                                                </fieldset>
                                            </form>

                                        </div>
                                        <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 160px 10px">
                                            <fieldset>
                                                <?php
                                                if (!empty($data_registrasi)) {
                                                    ?>
                                                    <div class="control-group">											
                                                        <label class="control-label" for="pasien">Pilih Pasien</label>
                                                        <div class="controls">
                                                            <div style="width: 60%" id="pasien_wrap">
                                                                <img src="<?php echo Yii::app()->baseUrl; ?>/img/ajax-loader.gif"  style="width: 128px;height: 15px;margin: 0px auto;">
                                                            </div>
                                                        </div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="instansi">Instansi Asal</label>
                                                        <div class="controls">
                                                            <div style="width: 60%">
                                                                <select name="instansi" class="chosen" id="instansi" data-placeholder="Pilih Instansi..." tabindex="2">
                                                                    <?php
                                                                    foreach ($data_instansi as $d):
                                                                        ?>
                                                                        <option value="<?php echo $d['id_instansi'] ?>" <?php if ($data_registrasi['id_instansi'] == $d['id_instansi']) echo "selected='true'"; ?>><?php echo $d['nama_instansi'] ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="no_registrasi">No.Registrasi</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4 validate[required]" id="no_registrasi" name="no_registrasi" value="<?php echo $data_registrasi['no_registrasi'] ?>">
                                                        </div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->
                                                    
                                                      <div class="control-group">											
                                                        <label class="control-label" for="waktu_registrasi">Waktu Registrasi</label>
                                                        <div class="controls">
                                                            <div id="waktu_registrasi"  class="input-append">
                                                                <input class="span4 m-wrap" name="waktu_registrasi" type="text"  value="<?php echo $data_registrasi['waktu_registrasi'] ?>"  type="text"/>
                                                                <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="pasien_tipe">Tipe Pasien</label>
                                                        <div class="controls">
                                                            <div style="width: 60%">
                                                                <select name="pasien_tipe" class="chosen span5"  data-placeholder="Pilih Tipe..." tabindex="2">
                                                                    <?php
                                                                    foreach ($data_pasien_tipe as $d):
                                                                        if ($d['jenis_pasien_tipe'] == 2) {
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
                                                        <label class="control-label" for="dokter_pengirim">Dokter Pengirim</label>
                                                        <div class="controls">
                                                            <div style="width: 60%">
                                                                <select name="dokter_pengirim" class="chosen span5"  data-placeholder="Pilih Dokter..." tabindex="2">
                                                                    <option value="">Pilih Dokter</option>
                                                                    <?php
                                                                    foreach ($data_dokter as $d):
                                                                        ?>
                                                                        <option value="<?php echo $d['id_dokter'] ?>" <?php if ($data_registrasi['id_dokter_pengirim'] == $d['id_dokter']) echo "selected='true'"; ?>><?php echo $d['gelar_depan'] . ' ' . $d['nama_dokter'] . ' ' . $d['gelar_belakang'] ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="keluhan">Keluhan/Diagnosa</label>
                                                        <div class="controls">
                                                            <textarea name="keluhan"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['keluhan_diagnosa'] ?></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="keterangan">Keterangan Tambahan</label>
                                                        <div class="controls">
                                                            <textarea name="keterangan"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['keterangan_registrasi'] ?></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="uji_keperluan">Keperluan Uji</label>
                                                        <div class="controls">
                                                            <textarea name="uji_keperluan"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['uji_keperluan'] ?></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="uji_parameter">Parameter Uji</label>
                                                        <div class="controls">
                                                            <textarea name="uji_parameter"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['uji_parameter'] ?></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="uji_metode">Metode Uji</label>
                                                        <div class="controls">
                                                            <textarea name="uji_metode"  style="resize: none;height:80px" class="span6"><?php echo $data_registrasi['uji_metode'] ?></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <input type="hidden" name="id_registrasi" value="<?php echo $data_registrasi['id_registrasi_pemeriksaan'] ?>"/>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="control-group">											
                                                        <label class="control-label" for="pasien">Pilih Pasien</label>
                                                        <div class="controls">
                                                            <div style="width: 60%" id="pasien_wrap">
                                                                <img src="<?php echo Yii::app()->baseUrl; ?>/img/ajax-loader.gif"  style="width: 128px;height: 15px;margin: 0px auto;">
                                                            </div>
                                                        </div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="instansi">Instansi Asal</label>
                                                        <div class="controls">
                                                            <div style="width: 60%">
                                                                <select name="instansi" class="chosen" id="instansi" data-placeholder="Pilih Instansi..." tabindex="2">
                                                                    <option value="">Pilih Instansi</option>
                                                                    <?php
                                                                    foreach ($data_instansi as $d):
                                                                        ?>
                                                                        <option value="<?php echo $d['id_instansi'] ?>"><?php echo $d['nama_instansi'] ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="no_registrasi">No.Registrasi</label>
                                                        <div class="controls">
                                                            <input type="text" class="span5 validate[required]" id="no_registrasi" name="no_registrasi" value="">
                                                        </div> <!-- /controls -->				
                                                    </div> <!-- /control-group -->
                                                    
                                                    
                                                    <div class="control-group">											
                                                        <label class="control-label" for="waktu_registrasi">Waktu Registrasi</label>
                                                        <div class="controls">
                                                            <div id="waktu_registrasi"  class="input-append">
                                                                <input class="span4 m-wrap" name="waktu_registrasi" type="text"  value="<?php echo date('Y-m-d H:i:s') ?>"  type="text"/>
                                                                <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="pasien_tipe">Tipe Pasien</label>
                                                        <div class="controls">
                                                            <div style="width: 60%">
                                                                <select name="pasien_tipe" class="chosen span5"  data-placeholder="Pilih Tipe..." tabindex="2">
                                                                    <?php
                                                                    foreach ($data_pasien_tipe as $d):
                                                                        if ($d['jenis_pasien_tipe'] == 2) {
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
                                                        <label class="control-label" for="dokter_pengirim">Dokter Pengirim</label>
                                                        <div class="controls">
                                                            <div style="width: 60%">
                                                                <select name="dokter_pengirim" class="chosen span5"  data-placeholder="Pilih Dokter..." tabindex="2">
                                                                    <option value="">Pilih Dokter</option>
                                                                    <?php
                                                                    foreach ($data_dokter as $d):
                                                                        ?>
                                                                        <option value="<?php echo $d['id_dokter'] ?>"><?php echo $d['gelar_depan'] . ' ' . $d['nama_dokter'] . ' ' . $d['gelar_belakang'] ?></option>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="keluhan">Keluhan/Diagnosa</label>
                                                        <div class="controls">
                                                            <textarea name="keluhan"  style="resize: none;height:80px" class="span6"></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->

                                                    <div class="control-group">											
                                                        <label class="control-label" for="keterangan">Keterangan Tambahan</label>
                                                        <div class="controls">
                                                            <textarea name="keterangan"  style="resize: none;height:80px" class="span6"></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="uji_keperluan">Keperluan Uji</label>
                                                        <div class="controls">
                                                            <textarea name="uji_keperluan"  style="resize: none;height:80px" class="span6"></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="uji_parameter">Parameter Uji</label>
                                                        <div class="controls">
                                                            <textarea name="uji_parameter"  style="resize: none;height:80px" class="span6"></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <div class="control-group">											
                                                        <label class="control-label" for="uji_metode">Metode Uji</label>
                                                        <div class="controls">
                                                            <textarea name="uji_metode"  style="resize: none;height:80px" class="span6"></textarea>
                                                        </div> <!-- /controls -->
                                                    </div> <!-- /control-group -->
                                                    <?php
                                                }
                                                ?>


                                                <br />

                                                <div class="form-actions">
                                                    <input type="hidden" name="mode" value="registrasi"/>
                                                    <input type="hidden" name="id_pasien" value="<?php echo $id_pasien ?>"/>
                                                    <button type="submit" class="btn btn-primary">Simpan Registrasi</button>
                                                </div> <!-- /form-actions -->
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-dua">
                                        PEMERIKSAAN
                                    </a>
                                </div>
                                <div id="collapse-dua" class="accordion-body collapse <?php if ($step == 2) echo 'in'; ?>">
                                    <div class="accordion-inner">
                                        <h2>Input Pemeriksaan</h2>
                                        <?php if (Yii::app()->user->hasFlash('success_registrasi')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_registrasi'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 160px 10px">
                                            <fieldset>
                                                <div class="row" style="padding: 10px">
                                                    <?php
                                                    $no_pengujian = 1;
                                                    $data_pengujian_col_1 = array_slice($data_pengujian, 0, 5);
                                                    $data_pengujian_col_2 = array_slice($data_pengujian, 5, 6);
                                                    $data_pengujian_col_3 = array_slice($data_pengujian, 11, 6);
                                                    $data_pengujian_col_4 = array_slice($data_pengujian, 17, (count($data_pengujian) - 17));
                                                    ?>
                                                    <div style="margin-left: 15px" class="span-4">
                                                        <?php
                                                        foreach ($data_pengujian_col_1 as $dk) {
                                                            ?>
                                                            <h3>Kelompok <?php echo $dk['nama_pengujian_kelompok'] ?></h3>
                                                            <ul style="list-style: cross-fade">
                                                                <?php
                                                                foreach ($dk['data_pengujian'] as $dp) {
                                                                    ?>
                                                                    <li>
                                                                        <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['id_pengujian'] ?>" data-id="<?php echo $dp['id_pengujian'] ?>" class="group_pengujian"/> <?php echo $dp['nama_pengujian'] ?>
                                                                        <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['jenis_pengujian'] ?>" />
                                                                    </li>
                                                                    <?php
                                                                    $no_pengujian++;
                                                                    if ($dp['jenis_pengujian'] == '1') {
                                                                        $id_group_pengujian = $dp['id_pengujian'];
                                                                        ?>
                                                                        <ol>
                                                                            <?php
                                                                            foreach ($dp['data_anak'] as $da) {
                                                                                ?>
                                                                                <li>
                                                                                    <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['id_pengujian'] ?>"   class="anak_pengujian_<?php echo $id_group_pengujian ?>"/> <?php echo $da['nama_pengujian'] ?>
                                                                                    <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['jenis_pengujian'] ?>" />
                                                                                </li>
                                                                                <?php
                                                                                $no_pengujian++;
                                                                            }
                                                                            ?>
                                                                        </ol>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div style="margin-left: 15px" class="span-4">
                                                        <?php
                                                        foreach ($data_pengujian_col_2 as $dk) {
                                                            ?>
                                                            <h3>Kelompok <?php echo $dk['nama_pengujian_kelompok'] ?></h3>
                                                            <ul style="list-style: cross-fade">
                                                                <?php
                                                                foreach ($dk['data_pengujian'] as $dp) {
                                                                    ?>
                                                                    <li>
                                                                        <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['id_pengujian'] ?>" data-id="<?php echo $dp['id_pengujian'] ?>" class="group_pengujian"/> <?php echo $dp['nama_pengujian'] ?>
                                                                        <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['jenis_pengujian'] ?>" />
                                                                    </li>
                                                                    <?php
                                                                    $no_pengujian++;
                                                                    if ($dp['jenis_pengujian'] == '1') {
                                                                        $id_group_pengujian = $dp['id_pengujian'];
                                                                        ?>
                                                                        <ol>
                                                                            <?php
                                                                            foreach ($dp['data_anak'] as $da) {
                                                                                ?>
                                                                                <li>
                                                                                    <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['id_pengujian'] ?>"   class="anak_pengujian_<?php echo $id_group_pengujian ?>"/> <?php echo $da['nama_pengujian'] ?>
                                                                                    <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['jenis_pengujian'] ?>" />
                                                                                </li>
                                                                                <?php
                                                                                $no_pengujian++;
                                                                            }
                                                                            ?>
                                                                        </ol>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div style="margin-left: 15px" class="span-4">
                                                        <?php
                                                        foreach ($data_pengujian_col_3 as $dk) {
                                                            ?>
                                                            <h3>Kelompok <?php echo $dk['nama_pengujian_kelompok'] ?></h3>
                                                            <ul style="list-style: cross-fade">
                                                                <?php
                                                                foreach ($dk['data_pengujian'] as $dp) {
                                                                    ?>
                                                                    <li>
                                                                        <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['id_pengujian'] ?>" data-id="<?php echo $dp['id_pengujian'] ?>" class="group_pengujian"/> <?php echo $dp['nama_pengujian'] ?>
                                                                        <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['jenis_pengujian'] ?>" />
                                                                    </li>
                                                                    <?php
                                                                    $no_pengujian++;
                                                                    if ($dp['jenis_pengujian'] == '1') {
                                                                        $id_group_pengujian = $dp['id_pengujian'];
                                                                        ?>
                                                                        <ol>
                                                                            <?php
                                                                            foreach ($dp['data_anak'] as $da) {
                                                                                ?>
                                                                                <li>
                                                                                    <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['id_pengujian'] ?>"   class="anak_pengujian_<?php echo $id_group_pengujian ?>"/> <?php echo $da['nama_pengujian'] ?>
                                                                                    <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['jenis_pengujian'] ?>" />
                                                                                </li>
                                                                                <?php
                                                                                $no_pengujian++;
                                                                            }
                                                                            ?>
                                                                        </ol>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div style="margin-left: 15px" class="span-4">
                                                        <?php
                                                        foreach ($data_pengujian_col_4 as $dk) {
                                                            ?>
                                                            <h3>Kelompok <?php echo $dk['nama_pengujian_kelompok'] ?></h3>
                                                            <ul style="list-style: cross-fade">
                                                                <?php
                                                                foreach ($dk['data_pengujian'] as $dp) {
                                                                    ?>
                                                                    <li>
                                                                        <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['id_pengujian'] ?>" data-id="<?php echo $dp['id_pengujian'] ?>" class="group_pengujian"/> <?php echo $dp['nama_pengujian'] ?>
                                                                        <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $dp['jenis_pengujian'] ?>" />
                                                                    </li>
                                                                    <?php
                                                                    $no_pengujian++;
                                                                    if ($dp['jenis_pengujian'] == '1') {
                                                                        $id_group_pengujian = $dp['id_pengujian'];
                                                                        ?>
                                                                        <ol>
                                                                            <?php
                                                                            foreach ($dp['data_anak'] as $da) {
                                                                                ?>
                                                                                <li>
                                                                                    <input type="checkbox" name="pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['id_pengujian'] ?>"   class="anak_pengujian_<?php echo $id_group_pengujian ?>"/> <?php echo $da['nama_pengujian'] ?>
                                                                                    <input type="hidden" name="jenis_pengujian_<?php echo $no_pengujian ?>" value="<?php echo $da['jenis_pengujian'] ?>" />
                                                                                </li>
                                                                                <?php
                                                                                $no_pengujian++;
                                                                            }
                                                                            ?>
                                                                        </ol>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>


                                                <br />

                                                <div class="form-actions">
                                                    <input type="hidden" name="mode" value="pemeriksaan"/>
                                                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                    <input type="hidden" name="jumlah_data" value="<?php echo $no_pengujian ?>"/>
                                                    <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
                                                </div> <!-- /form-actions -->
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-tiga">
                                        SAMPLE PASIEN
                                    </a>
                                </div>
                                <div id="collapse-tiga" class="accordion-body collapse <?php if ($step == 3) echo 'in'; ?>">
                                    <div class="accordion-inner">
                                        <?php if (Yii::app()->user->hasFlash('success_sample')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_sample'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (Yii::app()->user->hasFlash('success_bahan')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_bahan'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (Yii::app()->user->hasFlash('success_pemeriksaan_sample')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_pemeriksaan_sample'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (Yii::app()->user->hasFlash('success_pemeriksaan')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_pemeriksaan'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <h2>Data Sample Pasien</h2>
                                        <a href="#modal-sample-pasien" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Sample</a>
                                        <div id="modal-sample-pasien" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-sample-pasienLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="modal-sample-pasienLabel">Form Sample Pasien</h3>
                                            </div>

                                            <form class="form-horizontal form-validation" method="post" style="">
                                                <fieldset>
                                                    <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="kode">Kode Sample</label>
                                                            <div class="controls">
                                                                <input type="text"  class="span3 " name="kode" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="waktu_masuk">Waktu Masuk Sample</label>
                                                            <div class="controls">
                                                                <div id="waktu_sample"  class="input-append">
                                                                    <input class="span3 m-wrap" name="waktu_masuk" type="text"  value="<?php echo date('Y-m-d H:i:s') ?>"  type="text"/>
                                                                    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="Pilih Jenis Sample">Jenis Sample</label>
                                                            <div class="controls">
                                                                <div style="">
                                                                    <select name="sample" class="chosen span5" tabindex="2">
                                                                        <?php
                                                                        foreach ($data_jenis_sample as $d):
                                                                            ?>
                                                                            <option value="<?php echo $d['id_sample'] ?>" ><?php echo $d['nama_sample'] ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="jumlah">Jumlah Sample</label>
                                                            <div class="controls">
                                                                <input type="text" class="span2 " name="jumlah" value="1">
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

                                                        <input type="hidden" name="mode" value="tambah-sample"/>
                                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                        <button type="submit" class="btn btn-primary">Tambah Sample</button>
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </div>


                                                    <br/>


                                                </fieldset>
                                            </form>

                                        </div>
                                        <table id="sample-pemeriksaan-table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Sample</th>
                                                    <th>Nama Sample</th>
                                                    <th>Jumlah Sample</th>
                                                    <th>Waktu Masuk</th>
                                                    <th>Keterangan Sample</th>
                                                    <th>-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data_sample_pasien as $dp) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $dp['kode_sample'] ?></td>
                                                        <td><?php echo $dp['nama_sample'] ?></td>
                                                        <td><?php echo $dp['jumlah_sample'] ?></td>
                                                        <td><?php echo $dp['waktu_masuk'] ?></td>
                                                        <td><?php echo $dp['keterangan_sample'] ?></td>
                                                        <td style="text-align: center">
                                                            <a class="btn sample-pemeriksaan-delete-button" title="Delete" id="<?php echo $dp['id_registrasi_pasien_sample'] ?>" ><i class="icon-remove"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <h2>Data Bahan Pasien</h2>
                                        <a href="#modal-bahan-pasien" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Bahan</a>
                                        <div id="modal-bahan-pasien" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-bahan-pasienLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="modal-bahan-pasienLabel">Form Bahan Pasien</h3>
                                            </div>
                                            <form class="form-horizontal form-validation" method="post" style="">
                                                <fieldset>
                                                    <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="bahan">Nama Bahan</label>
                                                            <div class="controls">
                                                                <div>
                                                                    <select name="bahan" id="bahan" class="chosen span5" tabindex="2">
                                                                        <?php
                                                                        foreach ($data_bahan as $d):
                                                                            ?>
                                                                            <option value="<?php echo $d['id_bahan_pengujian'] ?>" ><?php echo $d['nama_bahan'] ?> Rp.<?php echo number_format($d['harga_bahan']) ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="jumlah_bahan">Jumlah Bahan</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3 " id="jumlah_bahan" name="jumlah_bahan" value="1">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="harga_total_bahan">Harga Total</label>
                                                            <div class="controls">
                                                                <input type="hidden" id="tarif_bahan" class="span3 " name="tarif_bahan" >
                                                                <input type="text" id="harga_total_bahan" class="span3 " name="harga_total_bahan" value="0">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                    </div>
                                                    <div class="modal-footer">

                                                        <input type="hidden" name="mode" value="tambah-bahan"/>
                                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                        <button type="submit" class="btn btn-primary">Tambah Bahan</button>
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </div>


                                                    <br/>


                                                </fieldset>
                                            </form>

                                        </div>
                                        <table id="bahan-pemeriksaan-table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Bahan</th>
                                                    <th>Jumlah Bahan</th>
                                                    <th>Tarif Satuan</th>
                                                    <th>Harga Total</th>
                                                    <th>-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($data_bahan_pasien as $dp) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $dp['nama_bahan'] ?></td>
                                                        <td><?php echo $dp['jumlah_bahan'] ?></td>
                                                        <td style="text-align: right">Rp. <?php echo number_format($dp['harga_bahan']) ?></td>
                                                        <td style="text-align: right">Rp. <?php echo number_format($dp['harga_bahan'] * $dp['jumlah_bahan']) ?></td>
                                                        <td style="text-align: center">
                                                            <a class="btn bahan-pemeriksaan-delete-button" title="Delete" id="<?php echo $dp['id_bahan_pasien'] ?>" ><i class="icon-remove"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

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
                                    <div class="accordion-inner">
                                        <h2>Data Pemeriksaan</h2>

                                        <?php if (Yii::app()->user->hasFlash('success_update_pasien_pemeriksaan')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_update_pasien_pemeriksaan'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (Yii::app()->user->hasFlash('success_delete_pasien_pemeriksaan')): ?>
                                            <div class="alert alert-success">
                                                <?php echo Yii::app()->user->getFlash('success_delete_pasien_pemeriksaan'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <form class="form-horizontal form-validation" id="pasien-pemeriksaan-form" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
                                            <fieldset>
                                                <table id="pasien-pemeriksaan-table" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Pengujian</th>
                                                            <th>Tarif Pengujian</th>
                                                            <th>Sample & Bahan</th>
                                                            <th>Tgl Perkiraan Selesai</th>
                                                            <th>Besar Biaya</th>
                                                            <th>Total </th>
                                                            <th>-</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $no = 1;
                                                        $total_pasien_pemeriksaan = 0;
                                                        foreach ($data_pasien_pemeriksaan as $dpp) {
                                                            $total_tarif_pemeriksaan = 0;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $no ?></td>
                                                                <td>(<?php echo $dpp['kode_pengujian'] ?>) <?php echo $dpp['nama_pengujian'] ?></td>
                                                                <td style="text-align: right">
                                                                    <input type="text" style="width: 90%"  name="tp_pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['besar_tarif'] ?>"/>
                                                                    <br/>
                                                                    <b style="text-align: left">Potongan</b>
                                                                    <br/>
                                                                    <input type="text" style="width: 90%"  name="pot_pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['potongan'] ?>"/>
                                                                </td>
                                                                <td style="width: 200px">
                                                                    <div>
                                                                        <select name="sample<?php echo $no ?>[]" class="chosen" multiple="" data-placeholder="Pilih Sample" tabindex="2">
                                                                            <?php
                                                                            $jumlah_pemeriksaan_sample = 0;
                                                                            foreach ($dpp['data_sample'] as $d):
                                                                                if ($d['id_pemeriksaan_sample'] != '') {
                                                                                    $jumlah_pemeriksaan_sample = $jumlah_pemeriksaan_sample + 1 * $d['jumlah_sample'];
                                                                                }
                                                                                ?>
                                                                                <option value="<?php echo $d['id_registrasi_pasien_sample'] ?>" <?php if ($d['id_pemeriksaan_sample'] != '') echo "selected"; ?>><?php echo $d['nama_sample'] . ' ' . $d['jumlah_sample'] . ' ' . ($d['keterangan_sample'] != '' ? ' [' . $d['keterangan_sample'] . ']' : '') ?></option>
                                                                                <?php
                                                                            endforeach;
                                                                            if ($jumlah_pemeriksaan_sample == 0) {
                                                                                $jumlah_pemeriksaan_sample = 1;
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <input type="text" style="width: 90%"  class="tgl_selesai" name="tgl_selesai_pasien_pemeriksaan<?php echo $no ?>" value=""/>
                                                                </td>
                                                                <td style="text-align: right">
                                                                    <input type="text" style="text-align: right" readonly="" value="<?php echo number_format($dpp['besar_tarif'] * $jumlah_pemeriksaan_sample) ?>"/>
                                                                </td>
                                                                <td style="text-align: right">

                                                                </td>
                                                                <td style="text-align: center" rowspan="2">
                                                                    <a class="btn pasien-pemeriksaan-delete-button" title="Delete" id="<?php echo $dpp['id_pasien_pemeriksaan'] ?>" ><i class="icon-remove"></i></a>
                                                                    <input type="hidden" name="pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['id_pasien_pemeriksaan']; ?>"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" style="text-align: right">
                                                                    <b>Bahan Pengujian</b>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <select name="bahan<?php echo $no ?>[]" class="chosen" multiple="" data-placeholder="Pilih Bahan" tabindex="2">
                                                                            <?php
                                                                            $jumlah_pemeriksaan_bahan = 0;
                                                                            $jumlah_tarif_bahan = 0;
                                                                            foreach ($dpp['data_bahan'] as $d):
                                                                                if ($d['id_bahan_pengujian_pasien'] != '') {
                                                                                    $jumlah_pemeriksaan_bahan = $jumlah_pemeriksaan_bahan + 1 * $d['jumlah_bahan'];
                                                                                    $jumlah_tarif_bahan = $jumlah_tarif_bahan + $d['total_tarif'];
                                                                                }
                                                                                ?>
                                                                                <option value="<?php echo $d['id_bahan_pasien'] ?>" <?php if ($d['id_bahan_pengujian_pasien'] != '') echo "selected"; ?>><?php echo $d['nama_bahan'] . ($d['jumlah_bahan'] != '' ? ' [' . $d['jumlah_bahan'] . ']' : '') ?></option>
                                                                                <?php
                                                                            endforeach;
                                                                            if ($jumlah_pemeriksaan_bahan == 0) {
                                                                                $jumlah_pemeriksaan_bahan = 1;
                                                                            }
                                                                            $total_tarif_pemeriksaan = $dpp['besar_tarif'] * $jumlah_pemeriksaan_sample-$dpp['potongan'] + $jumlah_tarif_bahan;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td></td>
                                                                <td>
                                                                    <input type="text" style="text-align: right" readonly="" value="<?php echo number_format($jumlah_tarif_bahan) ?>"/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" style="text-align: right" readonly="" value="<?php echo number_format($total_tarif_pemeriksaan) ?>"/>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $no++;
                                                            $total_pasien_pemeriksaan += $total_tarif_pemeriksaan;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" style="text-align: center">
                                                                <b>TOTAL</b>
                                                            </td>
                                                            <td style="text-align: right">
                                                                <input type="text" style="text-align: right" style="width: 90%" readonly="" value="<?php echo number_format($total_pasien_pemeriksaan) ?>"/>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="form-actions">
                                                    <input type="hidden" name="mode" value="pasien_pemeriksaan"/>
                                                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                    <input type="hidden" name="jumlah_data" value="<?php echo $no ?>"/>
                                                    <button type="submit" class="btn btn-primary">Simpan Biaya Pemeriksaan</button>
                                                </div> <!-- /form-actions -->
                                            </fieldset>
                                        </form>
                                        <hr/>
                                        <h2>Data Biaya Tambahan</h2>
                                        <a href="#modal-biaya-tambahan-pasien" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Biaya Tambahan</a>
                                        <div id="modal-biaya-tambahan-pasien" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-biaya-tambahan-pasienLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="modal-biaya-tambahan-pasienLabel">Form Biaya Tambahan</h3>
                                            </div>
                                            <form class="form-horizontal form-validation" method="post" style="">
                                                <fieldset>
                                                    <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="nama_biaya">Nama Biaya</label>
                                                            <div class="controls">
                                                                <input type="text" class="span4 validate[required]" name="nama_biaya" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="besar_biaya">Besar Biaya</label>
                                                            <div class="controls">
                                                                <input type="text" class="span4 validate[required]" name="besar_biaya" value="">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
                                                    </div>
                                                    <div class="modal-footer">

                                                        <input type="hidden" name="mode" value="tambah-biaya-tambahan"/>
                                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </div>
                                                </fieldset>
                                            </form>

                                        </div>
                                        <table style="width: 60%" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Biaya</th>
                                                    <th>Besar Biaya</th>
                                                    <th>-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $total_biaya_tambahan = 0;
                                                foreach ($data_biaya_tambahan as $bt) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><?php echo $bt['nama_biaya'] ?></td>
                                                        <td style="text-align: right"><?php echo number_format($bt['besar_biaya']) ?></td>
                                                        <td style="text-align: center">
                                                            <form method="post">
                                                                <input type="hidden" name="id_pemeriksaan_biaya_tambahan" value="<?php echo $bt['id_pemeriksaan_biaya_tambahan'] ?>"/>
                                                                <input type="hidden" name="mode" value="hapus-biaya-tambahan"/>
                                                                <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                                <button type="submit" class="btn"><i class="icon-remove"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $no++;
                                                    $total_biaya_tambahan+=$bt['besar_biaya'];
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="2" style="text-align: center">
                                                        <b>TOTAL</b>
                                                    </td>
                                                    <td style="text-align: right"><?php echo number_format($total_biaya_tambahan) ?></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr/>
                                        <h2>Data Pembayaran</h2>
                                        <a href="#modal-pembayaran-pasien" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Pembayaran</a>
                                        <div id="modal-pembayaran-pasien" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-pembayaran-pasienLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="modal-pembayaran-pasienLabel">Form Pembayaran</h3>
                                            </div>
                                            <form class="form-horizontal form-validation" method="post" style="">
                                                <fieldset>
                                                    <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="waktu_pembayaran">Waktu Pembayaran</label>
                                                            <div class="controls">
                                                                <div id="waktu_pembayaran"  class="input-append">
                                                                    <input class="span3 m-wrap" name="waktu_pembayaran" type="text"  value="<?php echo date('Y-m-d H:i:s') ?>"  type="text"/>
                                                                    <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="total_biaya">Total Biaya</label>
                                                            <div class="controls">
                                                                <input type="text" id="total_biaya" class="span3 validate[required]" name="total_biaya" value="<?php echo $total_pasien_pemeriksaan + $total_biaya_tambahan ?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="potongan">Potongan/Diskon</label>
                                                            <div class="controls">
                                                                <input class="span3 validate[required]"  id="potongan"  name="potongan" type="text" value="0">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="total_dibayar">Total Dibayar</label>
                                                            <div class="controls">
                                                                <input type="text" id="total_dibayar" class="span3 validate[required]" name="total_dibayar" value="<?php echo $total_pasien_pemeriksaan + $total_biaya_tambahan ?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="status_pembayaran">Status Pembayaran</label>
                                                            <div class="controls">
                                                                <select name="status_pembayaran" class="span3">
                                                                    <option value="0">Belum Lunas</option>
                                                                    <option value="1">Lunas</option>
                                                                </select>
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
                                                                <textarea name="keterangan"  style="resize: none;height:80px" class="span3"></textarea>
                                                            </div> <!-- /controls -->
                                                        </div> <!-- /control-group -->
                                                    </div>
                                                    <div class="modal-footer">

                                                        <input type="hidden" name="mode" value="pembayaran"/>
                                                        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                                                        <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </div>
                                                </fieldset>
                                            </form>

                                        </div>
                                        <table id="pembayaran-pemeriksaan-table" class="table table-striped table-bordered">
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
                                                                <button class="btn btn-success">Lunas</button>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <button class="btn btn-danger">Belum Lunas</button>
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
                                                            } else if ($pem['via_pembayaran'] == '3') {
                                                                ?>
                                                                <button class="btn btn-default">Transfer Rekening Giro</button>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <a class="btn pembayaran-pemeriksaan-delete-button" title="Delete" id="<?php echo $pem['id_pembayaran_pemeriksaan'] ?>" ><i class="icon-remove"></i></a>
                                                            <?php
                                                            if (in_array($pem['status_pembayaran'], array(1))) {
                                                                ?>
                                                                <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/bayar_pemeriksaan?reg=' . $id_registrasi . '&id_pembayaran=' . $pem['id_pembayaran_pemeriksaan']); ?>" target="_blank" title="Cetak Bukti Bayar" ><i class="icon-print"></i></a>
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
                                                    <td colspan="5"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br/><br/>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/nota?reg=' . $id_registrasi); ?>" target="_blank" title="Cetak Nota" id="" ><i class="icon-print"></i> Cetak Nota</a>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/hasil_pemeriksaan?reg=' . $id_registrasi); ?>" target="_blank" title="Cetak Hasil Pemeriksaan" id=""><i class="icon-print"></i> Cetak Hasil Pemeriksaan</a>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/sertifikat_pengujian?reg=' . $id_registrasi); ?>" target="_blank" title="Cetak Hasil Pemeriksaan" id=""><i class="icon-print"></i> Cetak Sertifikat Pengujian</a>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/barcode_single?reg=' . $id_registrasi); ?>" target="_blank" title="Cetak Barcode Pemeriksaan" id=""><i class="icon-barcode"></i> Cetak Barcode</a>
                                        <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/hasil_pemeriksaan_new?reg=' . $id_registrasi); ?>" target="_blank" title="Cetak Hasil Pemeriksaan (Covid)" id=""><i class="icon-print"></i> Cetak Hasil Pemeriksaan (Covid)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /controls -->	
                </div> <!-- /control-group -->

            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>

<script type="text/javascript">
    $('#pasien-pemeriksaan-table tbody').on('click', '.pasien-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deletePasienPemeriksan/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#pasien-pemeriksaan-form').html(data);
                }
            });
    });

    $('#pembayaran-pemeriksaan-table tbody').on('click', '.pembayaran-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deletePembayaranPasienPemeriksaan/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#pembayaran-pemeriksaan-table').html(data);
                }
            });
    });

    $('#sample-pemeriksaan-table tbody').on('click', '.sample-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deleteSamplePasienPemeriksaan/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#sample-pemeriksaan-table').html(data);
                }
            });
    });

    $('#bahan-pemeriksaan-table tbody').on('click', '.bahan-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deleteBahanPasien/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#bahan-pemeriksaan-table').html(data);
                }
            });
    });
</script>
<script type="text/javascript">
    $.ajax({
        url: '<?php echo Yii::app()->createUrl('AjaxData/selectPasienAll/') ?>',
        data: 'id_pasien=0',
        type: 'post',
        success: function(data) {
            $('#pasien_wrap').html(data);
            $('#pasien').chosen();
        }
    });
    $('#instansi').change(function() {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getNoRegistrasiPemeriksaan/') ?>',
            data: 'id_instansi=' + $(this).val(),
            type: 'post',
            success: function(data) {
                var instansi = $.parseJSON(data);
                $('#no_registrasi').val(instansi.no_registrasi);
            }
        });

    });
    $('#potongan').keyup(function() {
        $('#total_dibayar').val($('#total_biaya').val() - $(this).val());
    });
    $('#tgl_jatuh_tempo, .tgl_selesai').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#waktu_registrasi, #waktu_pembayaran, #waktu_sample').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'pt-BR'
    });
    $('#tanggal_lahir').datetimepicker({
        format: 'yyyy-MM-dd',
        language: 'pt-BR'
    });
    $('#tanggal_lahir').datetimepicker().on('changeDate', function(ev) {
        $('#umur').val(getAge($('#tanggal_lahir_val').val()));
    });
    $('.group_pengujian').click(function() {
        id_group = $(this).attr('data-id');
        if ($(this).is(':checked')) {
            $('.anak_pengujian_' + id_group).attr('checked', true);
        } else {
            $('.anak_pengujian_' + id_group).attr('checked', false);
        }
    });
    $('#bahan').change(function() {
        var id_bahan_pengujian = $(this).val();
        var jumlah = $('#jumlah_bahan').val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBahanPengujian/') ?>',
            data: 'id_bahan_pengujian=' + id_bahan_pengujian,
            type: 'post',
            success: function(data) {
                var bahan_pengujian = $.parseJSON(data);
                $('#tarif_bahan').val(bahan_pengujian.harga_bahan);
                $('#harga_total_bahan').val(bahan_pengujian.harga_bahan * jumlah);
            }
        });

    });
    $('#jumlah_bahan').keyup(function() {
        var id_bahan_pengujian = $('#bahan').val();
        var jumlah = $(this).val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBahanPengujian/') ?>',
            data: 'id_bahan_pengujian=' + id_bahan_pengujian,
            type: 'post',
            success: function(data) {
                var bahan_pengujian = $.parseJSON(data);
                $('#tarif_bahan').val(bahan_pengujian.harga_bahan);
                $('#harga_total_bahan').val(bahan_pengujian.harga_bahan * jumlah);
            }
        });

    });
</script>
